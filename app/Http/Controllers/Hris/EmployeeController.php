<?php

namespace App\Http\Controllers\Hris;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Hris\Department          as D;
use App\Models\Hris\Employee            as E;
use App\Models\Hris\Position            as P;
use App\Models\Hris\SubDepartment       as SD;
use App\Models\Hris\SalaryRule          as SR;
use Storage;
use Excel;
use PDF;

class EmployeeController extends Controller
{

    public function delete($id)
    {
        E::find($id)->delete();
        return 'employee success deleted';
    }

    public function getData($id = null)
    {
        return E::data($id);
    }

    public function nonActiveData()
    {
        return E::with(['subDep.dep', 'pos'])->where('non_active', '!=', null)->get();
    }

    private function data($id = null, $non = null)
    {
        return E::data($id, $non);
    }

    public function index(Request $r)
    {
        if(!$r->ajax())
            return redirect()->route('hris');
        // parent::check_authority('employee');
        $departments = D::orderBy('name', 'asc')->get();
        $positions = P::all();
        $oper = array(
            'data'		        => $this->data(),
            'positions'         => $positions,
        );
        return view('hris.employees.index', $oper);
    }

    private $rules = [
        'name'            => 'required',
        'gender'          => 'required',
        'born_in'         => 'required',
        'position'        => 'required',
        'father'          => 'required',
        'mother'          => 'required',
        'husband'         => 'required',
        'wife'            => 'required',
        'son'             => 'required',
        'daughter'        => 'required',
        'present_address' => 'required',
        'handphone'       => 'required',
        'joining_date'    => 'required',
        'elementary'      => 'required',
        'el_year'         => 'required|numeric',
        'type'            => 'required',
        'from'            => 'required',
        'department'      => 'required',
        'bri_account'     => 'required|numeric'
    ];

    private function storeData($r)
    {
        $storeData = [
            'nin'             => $r->nin,
            'name'            => $r->name,
            'gender'          => $r->gender,
            'born_in'         => $r->born_in,
            'birthdate'       => $r->birthdate,
            'position'        => $r->position,
            'father'          => $r->father,
            'mother'          => $r->mother,
            'husband'         => $r->husband,
            'wife'            => $r->wife,
            'son'             => $r->son,
            'daughter'        => $r->daughter,
            'elementary'      => $r->elementary,
            'el_year'         => $r->el_year,
            'junior'          => $r->junior,
            'jun_year'        => $r->jun_year,
            'senior'          => $r->senior,
            'sen_year'        => $r->sen_year,
            'university'      => $r->university,
            'u_year'          => $r->u_year,
            'type'            => $r->type,
            'e_from'          => $r->from,
            'present_address' => $r->present_address,
            'handphone'       => $r->handphone,
            'joining_date'    => $r->joining_date,
            'marital_status'  => $r->marital_status,
            'bri_account'     => $r->bri_account,
            'department_id'   => $r->department,
            'seguranca_social' => $r->seguranca_social,
        ];
        return $storeData;
    }

    public function fileRules($r)
    {
        $rules = [];
        if($r->file('cartao_rdtl')){
            $rules['cartao_rdtl'] = 'mimes:jpeg,jpg,png,bmp,pdf,doc,docx';
        }
        if($r->file('certidao_baptismo')){
            $rules['certidao_baptismo'] = 'mimes:jpeg,jpg,png,bmp,pdf,doc,docx';
        }
        if($r->file('elektoral')){
            $rules['elektoral'] = 'mimes:jpeg,jpg,png,bmp,pdf,doc,docx';
        }
        if($r->file('photo')){
            $rules['photo'] = 'mimes:jpeg,jpg,png|dimensions:min_width=300,max_width=300,min_height=400,max_height=400';
        }
        return $rules;
    }

    public function api(Request $r, $id = null)
    {
        if($id){
            return E::find($id);
        }
        return E::all();
    }

    public function handleUpload($r)
    {
        $a = ''; $a1 = ''; $b = ''; $b1 = ''; $c = ''; $c1 = '';
        if($r->file('cartao_rdtl')){
            $b1 = $r->file('cartao_rdtl')->getClientOriginalName();
            $b = $r->file('cartao_rdtl')->storeAs($r->nin.'/cartao_rdtl', $b1);
        }
        if($r->file('certidao_baptismo')){
            $c1 = $r->file('certidao_baptismo')->getClientOriginalName();
            $c = $r->file('certidao_baptismo')->storeAs($r->nin.'/certidao_baptismo', $c1);
        }
        if($r->file('elektoral')){
            $a1 = $r->file('elektoral')->getClientOriginalName();
            $a = $r->file('elektoral')->storeAs($r->nin.'/elektoral', $a1);
        }
        return ['a' => $a, 'a1' => $a1, 'b' => $b, 'b1' => $b1, 'c' => $c, 'c1' => $c1];
    }

    public function store(Request $r)
    {
        // parent::check_authority('employee');
        $rules = $this->rules;
        $rules['nin'] = 'required|numeric|unique:hris_employees';
        $rules['birthdate'] = 'required|before:'.date('Y-m-d', strtotime('-15 years'));
        $error = '';
        $sd = $this->storeData($r);
        $r->validate($this->fileRules($r));
        $r->validate($rules, [
            'birthdate.before' => 'Minimal 15 years old'
        ]);
        $upload = $this->handleUpload($r);
        $tambahan = [
            'elektoral_path' => $upload['a'],
            'cartao_rdtl_path' => $upload['b'],
            'certidao_baptismo_path' => $upload['c'],
            'elektoral' => $upload['a1'],
            'cartao_rdtl' => $upload['b1'],
            'certidao_baptismo' => $upload['c1'],
            'photo' => $r->file('photo') ? $r->file('photo')->storeAs($r->nin.'/photo', $r->file('photo')->getClientOriginalName()) : ''
        ];
        $data = $r->except([
            'elektoral',
            'cartao_rdtl',
            'certidao_baptismo',
            'photo',
        ]) + $tambahan;
        E::create($sd+$tambahan);
        // parent::create_activity('Added new employee');
        return 'New employee success added';
    }

    public function update($id, Request $r)
    {
        // parent::check_authority('employee');
        $rules = $this->rules;
        if($r->nin!=$r->old_nin)
            $rules['nin'] = 'required|unique:hris_employees|numeric';
        $this->validate($r, $rules);
        $upload = $this->handleUpload($r);
        $tambahan = [];
        if($upload['a']){
            $tambahan['elektoral_path'] = $upload['a'];
        }
        if($upload['b']){
            $tambahan['cartao_rdtl_path'] = $upload['b'];
        }
        if($upload['c']){
            $tambahan['certidao_baptismo_path'] = $upload['c'];
        }
        if($upload['a1']){
            $tambahan['elektoral'] = $upload['a1'];
        }
        if($upload['b1']){
            $tambahan['cartao_rdtl'] = $upload['b1'];
        }
        if($upload['c1']){
            $tambahan['certidao_baptismo'] = $upload['c1'];
        }
        if($r->file('photo')){
            $tambahan['photo'] = $r->file('photo')->storeAs($r->nin.'/photo', $r->file('photo')->getClientOriginalName());
        }
        $data = $r->except([
            'elektoral',
            'cartao_rdtl',
            'certidao_baptismo',
            'photo',
        ]) + $tambahan;
        $data['department_id'] = $r->department;
        E::find($id)->update($data);
        // parent::create_activity('Update employee');
        return 'employee success updated';
    }

    public function disable(Request $request)
    {
        // parent::check_authority('employee');
        E::destroy($request->id);

        return redirect()->route('employees')->with('success', 'Data has been disabled');
    }

    public function detail(Request $r)
    {
        // parent::check_authority('employee');
        $oper = [
            'data'      => $this->data($r->id)
        ];
        return view('hris.employees.detail', $oper);
    }

    public function check(Request $r)
    {
        $E = E::where('department', $r->id)->get();
        if($r->account){
            $employees = '';
            $accounts  = DB::table('users')->where('employee', '!=', null)->get();
            foreach($E as $e){
                $skip = false;
                foreach($accounts as $a){
                    if($e->id==$a->employee){
                        $skip = true;
                    }
                }
                if(!$skip){
                    $p          = P::find($e->position)->name;
                    $employees .= '<option value="'.$e->id.'">'.$e->name.' ('.$p.')</option>';
                }
            }
            return $employees;
        }
        $oper = '';
        foreach($E as $e){
            $p = P::find($e->position)->name;
            $oper .= '<option value="'.$e->id.'">'.$e->name.' ('.$p.')</option>';
        }
        return $oper;
    }

    #NON ACTIVE

    public function nonActivate($id, Request $r)
    {
        $E = E::find($id);
        if($E->non_active)
            return response('Employee already non active', 409);
        $E->update([
            'non_active'        => $r->reason,
            'non_active_at'     => now()
        ]);
        // parent::create_activity('Non Activate employee');
        return 'Non activate employee succeded';
    }

    public function activate($id)
    {
        E::find($id)->update([
            'non_active'        => null,
            'non_active_at'     => null
        ]);

        return 'Activate employee succeded';
    }

    public function non_active_to_print($data=null)
    {
        $oper  = [
            'data'      => $this->data(null, true)
        ];
        return view('hris.employees.non_active.print', $oper);
    }

    public function non_active_pdf()
    {
        $oper  = [
            'data'      => $this->data(null, true)
        ];
        $pdf = PDF::loadView('hris.employees.non_active.print', $oper);
        $pdf->setPaper('a4', 'landscape');
        return $pdf->download('non_active_employees ['.now().'].pdf');
    }

    public function non_active_excel()
    {
        Excel::create('lisun_hris_non_active_employees_'.date('Y_m_d_h_i_s'), function($excel){
            $excel->setTitle('Lisun HRIS Non Active Employees');
            $excel->setCreator('Lisun')->setCompany('Lisun');
            $excel->setDescription('Lisun HRIS Non Active Employees');
            $excel->sheet('data', function($sheet){
                $datas = [];
                foreach ($this->salary_rules_data() as $d) {
                    $arr                        = [
                        'NIN'                       => $d->nin,
                        'Name'                      => $d->name,
                        'Department/Sub Department' => $d->d_name.'/'.$d->sd_name,
                        'Position'                  => $d->p_name,
                        'Non Activate At'           => $d->non_active_at,
                        'Reason'                    => non_active($d->non_active)
                    ];
                    array_push($datas, $arr);
                }
                $sheet->with($datas);
                $sheet->row(1, function($row){
                    $row->setFontWeight('bold');
                });
            });
        })->export('xlsx');
    }

    public function identity_to_print($id)
    {
        $oper  = [
            'data'      => $this->data($id)
        ];
        return view('hris.employees.identity.print', $oper);
    }

    public function identity_pdf($id)
    {
        $oper  = [
            'data'      => $this->data($id)
        ];
        $pdf = PDF::loadView('hris.employees.identity.print', $oper);
        $pdf->setPaper('a4');
        return $pdf->download('lisun_hris_employee_identity_'.$oper['data']->nin.' ['.now().'].pdf');
    }

    private $excel_id;

    public function identity_excel($id)
    {
        $this->excel_id = $id;
        return Excel::create('identity_employee ['.now().']', function($excel) {
            $excel->setTitle('identity_employee ['.now().']');
            $excel->sheet('sheet1', function($sheet) {
                $oper  = [
                    'data'      => $this->data($this->excel_id),
                    'lisun'     => false
                ];
                $sheet->loadView('hris.employees.identity.excel', $oper);
                $sheet->setAutoSize(true);
            });
        })->export('xlsx');
    }

    public function certidao_baptismo_download($id)
    {
        if(Storage::exists(local_file('storage/'.E::find($id)->certidao_baptismo_path))){
            return response()->download(local_file('storage/'.E::find($id)->certidao_baptismo_path));
        }
        return 'file does not exist';
    }

    public function cartao_rdtl_download($id)
    {
        if(Storage::exists(local_file('storage/'.E::find($id)->cartao_rdtl_path))){
            return response()->download(local_file('storage/'.E::find($id)->cartao_rdtl_path));
        }
        return 'file does not exist';
    }

    public function elektoral_download($id)
    {
        $file = local_file('storage/'.E::find($id)->elektoral_path);
        if(Storage::exists($file)){
            return response()->download($file);
        }
        return 'file does not exist';
    }

    private function salary_rules_data()
    {
        return E::salary_rules_data();
    }

    public function salary_rules_dt()
    {
        $data = array();
        foreach ($this->salary_rules_data() as $d) {
            $data[] = [
                $d->nin,
                $d->name,
                $d->d_name.'/'.
                $d->sd_name,
                $d->p_name,
                $d->basic_salary,
                $d->eat_cost,
                $d->allowance,
                $d->incentive
            ];
        }
        return response(['data'=>$data], 200);
    }

    private $salary_form_rules = [
        'employee'     => 'required',
        'basic_salary' => 'required|numeric',
        'eat_cost'     => 'required|numeric',
        'allowance'    => 'required|numeric',
        'incentive'    => 'required|numeric'
    ];

    public function salary_rules_create(Request $r)
    {
        $this->validate($r, $this->salary_form_rules);
        $data = array_add($r->all(), 'status', 1);
        array_pull($data, '_token');
        SR::where('employee', $r->employee)->update(['status'=>0]);
        $SR = SR::firstOrCreate($data);
        E::find($r->employee)->update(['salary_rule'=>$SR->id]);
        // parent::create_activity('Created salary rule');
        // parent::created();
    }

    public function salary_rules_check(Request $r)
    {
        $data = SR::where(['employee'=>$r->employee, 'status'=>1])->first();
        if($data==null){
            $oper = [
                'basic_salary' => 0,
                'eat_cost'     => 0,
                'allowance'    => 0,
                'incentive'    => 0
            ];  
        }else{
            $oper = [
                'basic_salary' => $data->basic_salary,
                'eat_cost'     => $data->eat_cost,
                'allowance'    => $data->allowance,
                'incentive'    => $data->incentive
            ];  
        }
        return view('hris.employees.salary_rules.check', $oper);
    }

    public function salary_rules_to_print($data=null)
    {
        $oper  = [
            'data'      => $this->salary_rules_data()
        ];
        return view('hris.employees.salary_rules.print', $oper);
    }

    public function salary_rules_pdf()
    {
        $oper  = [
            'data'      => $this->salary_rules_data()
        ];
        $pdf = PDF::loadView('hris.employees.salary_rules.print', $oper);
        $pdf->setPaper('a4', 'landscape');
        return $pdf->download('salary_rules_employees ['.now().'].pdf');
    }

    public function salary_rules_excel()
    {
        Excel::create('lisun_hris_salary_rules_'.date('Y_m_d_h_i_s'), function($excel){
            $excel->setTitle('Lisun HRIS Salary Rules');
            $excel->setCreator('Lisun')->setCompany('Lisun');
            $excel->setDescription('Lisun HRIS Salary Rules');
            $excel->sheet('data', function($sheet){
                $datas = [];
                foreach ($this->salary_rules_data() as $d) {
                    $arr                        = [
                        'NIN'                       => $d->nin,
                        'Name'                      => $d->name,
                        'Department/Sub Department' => $d->d_name.'/'.$d->sd_name,
                        'Position'                  => $d->p_name,
                        'Basic Salary'              => $d->basic_salary,
                        'Eat Cost'                  => $d->eat_cost,
                        'Allowance'                 => $d->allowance,
                        'Incentive'                 => $d->incentive
                    ];
                    array_push($datas, $arr);
                }
                $sheet->with($datas);
                $sheet->row(1, function($row){
                    $row->setFontWeight('bold');
                });
            });
        })->export('xlsx');
    }

        #EXPORT

    public function toPrint()
    {
        // parent::check_authority('employee');
        return view('hris.employees.export.print', [
            'data' => $this->getData()
        ]);
    }

    public function pdf()
    {
        // parent::check_authority('employee');
        return PDF::loadView('hris.employees.export.print', [
            'data' =>$this->getData()
        ])
        ->setPaper('A4', 'landscape')->download('lisun-hris-employees ['.now().'].pdf');
    }

    public function excel()
    {
        // parent::check_authority('employee');
        $data = $this->data();
        Excel::create('lisun-hris-employees ['.now().']', function($excel) use ($data) {
            $excel->setTitle('Lisun HRIS Employees');
            $excel->setCreator('Lisun')->setCompany('Lisun');
            $excel->setDescription('Lisun HRIS Employees');
            $excel->sheet('data', function($sheet) use ($data) {
                $sheet->fromArray(E::excel());
                $sheet->row(1, function($row){
                    $row->setFontWeight('bold');
                });
                $sheet->prependRow(['Employees']);
                $sheet->mergeCells('A1:Y1');
                $sheet->cell('A1', function($cell){
                    $cell->setFontSize(16);
                    $cell->setAlignment('center');
                });
            });
        })->export('xlsx');
    }

    public function selectMode()
    {
        return E::selectMode();
    }

    public function active(Request $r)
    {
        $with = $r->query('with');
        if($with){
            $with = explode(',', $with);
            $employees = E::with($with)->whereNull('non_active')->get();
        }else{
            $employees = DB::table('hris_employees')->whereNull('non_active')->get();
        }
        return $employees;
    }
}
