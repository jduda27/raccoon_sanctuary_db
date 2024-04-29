<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Schedule;

class ScheduleController extends Controller
{

    public function updateSchedule(Schedule $schedule, Request $request){
        $incomingFields = $request->validate([
            'sanctuary_id' => 'required'
        ]);
        $incomingFields['sanctuary_id'] = strip_tags($incomingFields['sanctuary_id']);

        $schedule->update($incomingFields);

        return redirect('/');


    }

    public function registerSchedule(Request $request)
    {
        try {
            Schedule::create($request);
        } catch (\Illuminate\Database\QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == '1062') {
                return back()->with('error', 'A role with this name already exists! Please enter a new role or contact an administrator if you believe this is a mistake.');
            } else {
                return back()->with('error', $e->getMessage());
            }
        }

        $schedule_id = DB::table('schedule')->select('id')->latest('created_at')->get();


        return $schedule_id;
    }
}
