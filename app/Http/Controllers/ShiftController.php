<?php

namespace App\Http\Controllers;

use App\Models\Sanctuary;
use App\Models\Shift;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShiftController extends Controller
{

    protected function sanitize(Request $request)
    {
        $incomingFields = $request->validate([
            'start_time' => ['required'],
            'end_time'  => ['required'],
            'employee_id'  => ['required'],
            'schedule_id'  => ['required'],
        ]);

        $incomingFields['start_time'] = strip_tags($incomingFields['start_time']);
        $incomingFields['end_time'] = strip_tags($incomingFields['end_time']);
        $incomingFields['employee_id'] = strip_tags($incomingFields['employee_id']);
        $incomingFields['schedule_id'] = strip_tags($incomingFields['schedule_id']);

        $date = $request['date'];
        $stime = $incomingFields['start_time'];
        $etime = $incomingFields['end_time'];

        $incomingFields['start_time'] = date('Y-m-d H:i:s', strtotime("$date $stime"));
        $incomingFields['end_time'] = date('Y-m-d H:i:s', strtotime("$date $etime"));

        return $incomingFields;
    }

    public function showShiftEdit(Shift $shift)
    {
        $schedules = DB::table('schedule')->join('sanctuary', 'schedule.sanctuary_id', '=', 'sanctuary.id')->select('*', 'schedule.id')->get()->sortBy('schedule.id');
        $employees = DB::table('employee')->join('address', 'address.id', '=', 'employee.address_id')->join('role', 'role.id', '=', 'employee.role_id')->select('*', 'employee.id')->get()->sortBy('id');

        return view('edit-shift', ['shift' => $shift, 'schedules' => $schedules, 'employees' => $employees]);
    }

    public function updateShift(Shift $shift, Request $request)
    {
        $incomingFields = $this->sanitize($request);

        $shift->update($incomingFields);

        return redirect('/');
    }

    public function deleteShift(Shift $shift)
    {
        try{
            $shift->delete();
        } catch (\Illuminate\Database\QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == '1451') {
                return back()->with('error', 'This shift is currently assigned to an employee and cannot be deleted! Please remove the employee assignment before deleting this shift.');
            } else {
                return back()->with('error', $e->getMessage());
            }
        }

        return redirect('/');
    }

    public function registerShift(Request $request)
    {
        $incomingFields = $this->sanitize($request);

        try {
            Shift::create($incomingFields);
        } catch (\Illuminate\Database\QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == '1062') {
                return back()->with('error', 'This shift conflicts with one that has already been created! Please use different information or contact an administrator if you believe this is a mistake.');
            } else {
                return back()->with('error', $e->getMessage());
            }
        }


        return redirect('/');
    }
}
