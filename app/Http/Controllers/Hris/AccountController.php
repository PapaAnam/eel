<?php

namespace App\Http\Controllers\Hris;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\User as U;
use App\Models\Hris\SubDepartment       as SD;
use App\Models\Hris\Employee            as E;
use App\Models\Hris\Authority           as A;
use App\Models\Hris\Activity            as Ac;
use Excel;

class AccountController extends Controller
{
    public function getData($id = null)
    {
        if($id)
            return U::with('auth')->where('id', $id)->first();
        return U::all();
    }

    private function data($id=null)
    {
        return U::data($id);
    }

    private function storeData($r)
    {
        $store['department']      =  $r->department!=null ? $r->department : 0;
        $store['job_title']       =  $r->job_title!=null ? $r->job_title : 0;
        $store['employee']        =  $r->employee_menu!=null ? $r->employee_menu : 0;
        $store['calendar']        =  $r->calendar!=null ? $r->calendar : 0;
        $store['special_day']     =  $r->special_day!=null ? $r->special_day : 0;
        $store['attendance']      =  $r->attendance!=null ? $r->attendance : 0;
        $store['over_time']       =  $r->over_time!=null ? $r->over_time : 0;
        $store['official_travel'] =  $r->official_travel!=null ? $r->official_travel : 0;
        $store['payroll']         =  $r->payroll!=null ? $r->payroll : 0;
        $store['announcement']    =  $r->announcement!=null ? $r->announcement : 0;
        $store['salary_rule']     =  $r->salary_rule!=null ? $r->salary_rule : 0;
        $store['account']         =  $r->account!=null ? $r->account : 0;
        $store['mutation']        =  $r->mutation!=null ? $r->mutation : 0;
        $store['leave_period']    =  $r->leave_period!=null ? $r->leave_period : 0;
        $store['attendance_edit']    =  $r->attendance_edit!=null ? $r->attendance_edit : 0;
        return $store;
    }

    public function store(Request $r)
    {
        $rules = [
            'username'      => 'required|unique:hris_users|min:6|max:20|alpha',
            'password'      => 'required|min:6|max:20|alpha_num|confirmed',
            'level'         => 'required',
        ];
        $this->validate($r, $rules);
        $error = true;
        if($r->department || $r->job_title || $r->employee_menu || $r->calendar || $r->special_day || $r->attendance || $r->over_time || $r->official_travel || $r->payroll || $r->announcement || $r->salary_rule || $r->account || $r->mutation || $r->leave_period)
            $error = false;
        if($error)
            return response('authority required. please check authority', 409);
        $U = U::firstOrCreate([
            'username' => $r->username,
            'password' => bcrypt($r->password),
            'level'    => $r->level,
        ]);
        $store             = $this->storeData($r);
        $store['user']     = $U->id;
        A::create($store);
        // parent::create_activity('Added new user account');
        return 'new account success created';
    }

    public function edit(Request $r)
    {
        $data = $this->data($r->id);
        $oper = array(
            'data'          => $data
        );
        return view('hris.accounts.edit', $oper);
    }

    public function update(Request $r)
    {
        $rules = [
            'level'         => 'required',
        ];
        if($r->old_username!=$r->username)
            $rules['username'] = 'required|unique:hris_users|min:6|max:20|alpha';
        if($r->password!=null)
            $rules['password']      = 'required|min:6|max:20|alpha_num|confirmed';
        $this->validate($r, $rules);
        $error = true;
        if($r->department || $r->job_title || $r->employee_menu || $r->calendar || $r->special_day || $r->attendance || $r->over_time || $r->official_travel || $r->payroll || $r->announcement || $r->salary_rule || $r->account || $r->mutation || $r->leave_period)
            $error = false;
        if($error)
            return response('authority required. please check authority', 409);
        $storeData = [
            'username'      => $r->username,
            'level'         => $r->level
        ];
        if($r->password!=null)
            $storeData['password'] = bcrypt($r->password);
        U::find($r->id)->update($storeData);
        $store = $this->storeData($r);
        $store['user'] = $r->id;
        A::where('user', $r->id)->update($store);
        // parent::create_activity('Updated user account');
        return 'account success updated';
    }

    public function detail(Request $req)
    {
        $data = A::join('hris_users', 'hris_users.id', '=', 'hris_user_menus.user')
        ->where('hris_users.id', $req->id)
        ->select('hris_user_menus.*')
        ->first();
        $oper = [
            'data'      => $data
        ];
        return view('hris.accounts.detail', $oper);
    }

    public function delete($id)
    {
        $user = U::find($id);
        E::where('login', $user->id)->update(['login'=>null]);
        A::where('user', $id)->delete();
        Ac::where('user', $id)->delete();
        $user->delete();
        // parent::create_activity('Deleted user account');
        return 'account success deleted';
    }

    public function check(Request $r)
    {
        $return = '';
        foreach(E::where(['department'=>$r->id, 'login'=>null])->get() as $e){
            $return .= '<option value="'.$e->id.'">'.$e->name.' ('.parent::position_name($e->position).')</option>';
        }
        return $return;
    }

    #EXPORT

    public function toPrint($data=null)
    {
        // parent::check_authority('account');
        return view('hris.accounts.export.print', ['data'=>$this->data()]);
    }

    public function pdf()
    {
        // parent::check_authority('account');
        // return parent::pdfs('hris.accounts.export', $this->data(), true);
    }

    public function excel()
    {
        // parent::check_authority('account');
        Excel::create('lisun_hris_accounts_'.date('Y_m_d_h_i_s'), function($excel){
            $excel->setTitle('Lisun HRIS Accounts');
            $excel->setCreator('Lisun')->setCompany('Lisun');
            $excel->setDescription('Lisun HRIS Accounts');
            $excel->sheet('data', function($sheet){
                $datas = [];
                foreach ($this->data() as $d) {
                    $arr                        = [
                        'Username'                  => $d->username,
                        'Level'                     => level($d->level),
                        'Employee'                  => '('.$d->nin.') '.$d->e_name,
                        'Department/Sub Department' => $d->d_name.'/'.$d->sd_name,
                        'Position'                  => $d->p_name,
                    ];
                    array_push($datas, $arr);
                }
                $sheet->with($datas);
                // $sheet->row(1, ['#', 'name', 'department']);
                $sheet->row(1, function($row){
                    $row->setFontWeight('bold');
                });
            });
        })->export('xlsx');
    }

}

