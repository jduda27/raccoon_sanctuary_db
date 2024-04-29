<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Sanctuary;
use App\Models\Schedule;
use App\Models\Address;

class SanctuaryController extends Controller
{

    public function showSanctuaryEdit(Sanctuary $sanctuary)
    {
        return view('edit-sanctuary', ['sanctuary' => $sanctuary,'addresses' => Address::all()->sortBy('id')]);
    }

    public function updateSanctuary(Sanctuary $sanctuary, Request $request)
    {
        $incomingFields = $request->validate([
            'sanctuary_name' => ['required', 'string', 'max:120'],
            'address_id' => ['required', 'integer']
        ]);

        $incomingFields['sanctuary_name'] = strip_tags($incomingFields['sanctuary_name']);
        $incomingFields['address_id'] = strip_tags($incomingFields['address_id']);

        $sanctuary->update($incomingFields);

        return redirect('/');
    }

    public function deleteSanctuary(Sanctuary $sanctuary)
    {
        try{

            $sanctuary->delete();
        } catch (\Illuminate\Database\QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == '1451') {
                return back()->with('error', 'This sanctuary is currently in use and cannot be deleted! Please remove all schedules from this sanctuary before deleting it.');
            } else {
                return back()->with('error', $e->getMessage());
            }
        }

        return redirect('/');
    }

    public function registerSanctuary(Request $request)
    {
        $incomingFields = $request->validate([
            'sanctuary_name' => ['required', 'string', 'max:120'],
            'address_id' => ['required', 'integer']
        ]);

        try {
            Schedule::create();
        } catch (\Illuminate\Database\QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == '1062') {
                return back()->with('error', 'A schedule with this name already exists! Please enter a new schedule name or contact an administrator if you believe this is a mistake.');
            } else {
                return back()->with('error', $e->getMessage());
            }
        }

        $schedule_id = DB::table('schedule')->select('id')->latest('created_at')->first();
        

        $incomingFields['schedule_id'] = $schedule_id->id;

        $incomingFields['sanctuary_name'] = strip_tags($incomingFields['sanctuary_name']);
        $incomingFields['address_id'] = strip_tags($incomingFields['address_id']);
        $incomingFields['schedule_id'] = strip_tags($incomingFields['schedule_id']);

        try {
            Sanctuary::create($incomingFields);
        } catch (\Illuminate\Database\QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == '1062') {
                return back()->with('error', 'A sanctuary with this name or address already exists! Please enter a new name or address or contact an administrator if you believe this is a mistake.');
            } else {
                return back()->with('error', $e->getMessage());
            }
        }

        //Call to update the Schedule with the new santuary_id
        $sanctuary_id = DB::table('sanctuary')->select('id')->orderByDesc('id')->first();

        Schedule::updateOrCreate(
            [
                'id' => $schedule_id->id,
            ],
            [
                'sanctuary_id' => $sanctuary_id->id,
            ]
        );

        return redirect('/');
    }
}
