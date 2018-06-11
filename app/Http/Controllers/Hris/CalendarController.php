<?php

namespace App\Http\Controllers\Hris;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Hris\Calendar as C;

class CalendarController extends Controller
{

    public function getData()
    {
        return C::all();
    }

    public function remove(Request $r)
    {
        C::find($r->id)->delete();
        // parent::create_activity('Delete special day');
        return 'Special day has success deleted';
    }

    public function edit(Request $r)
    {
        return view('hris.calendars.edit', ['d'=>C::find($r->id)]);
    }

    private function data($id = null)
    {
        if($id==null)
            return C::all();
        else if(is_array($id))
            return C::where($id)->get();
        return C::find($id);
    }

    public function index(Request $r)
    {
        if(!$r->ajax())
            return redirect('hris');
        $oper = array(
            'data'          => $this->data(['month'=>(int) date('m')])
        );
        return view('hris.calendars.index', $oper);
    }

    public function add()
    {
        // parent::not_allowed('special_day');
        $oper = array(
          'title'   => 'Add Special Day'.title(),
          'data'    => $this->data(),
          'modul'   => 'calendar',
          'action'  => route('calendar.create'),
          'back'    => route('calendars'),
          'profile' => $this->profile()
      );
        return view('hris.calendars.view', $oper);
    }

    private $rules = [
        'date_event' => 'required|date_format:m-d',
        'event'      => 'required'
    ];

    public function store(Request $r)
    {
        $this->validate($r, $this->rules);
        $date = explode('-', $r->date_event);
        $data = [
            'date'  => $date[1],
            'month' => $date[0],
            'event' => $r->event
        ];
        C::create($data);
        // parent::create_activity('Added new special day');
        return 'new event success added';
    }

    public function getEventList()
    {
        $data = [];
        for($i=1945;$i<=date('Y')+50;$i++){
            foreach(C::all() as $d){
                $data[] = [
                    'title'           => $d->event,
                    'start'           => $i.'-'.$d->month.'-'.$d->date,
                    'allDay'          => true,
                    'backgroundColor' => "#f56954",
                    'borderColor'     => "#f56954"
                ];
            }
        }
    return $data;
    }

    public function update($id, Request $r)
    {
        $this->validate($r, $this->rules);
        C::find($id)->update([
            'event'     => $r->event,
            'month'     => substr($r->date_event, 0, 2),
            'date'      => substr($r->date_event, 3, 2)
        ]);
        // parent::create_activity('Updated special day');
        return 'Special day success updated';
    }
}
