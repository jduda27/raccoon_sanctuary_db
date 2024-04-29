<?php

namespace App\Http\Controllers;

use App\Models\Raccoon_Treatment_History;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RaccoonTreatmentHistoryController extends Controller
{

    protected function sanitize(Request $request){
        $incomingFields = $request->validate([
            'treatment_time' => ['required'],
            'treatment_id' => ['required'],
            'raccoon_id' => ['required']
        ]);

        $incomingFields['treatment_time'] = strip_tags($incomingFields['treatment_time']);
        $incomingFields['treatment_id'] = strip_tags($incomingFields['treatment_id']);
        $incomingFields['raccoon_id'] = strip_tags($incomingFields['raccoon_id']);

        return $incomingFields;
    }

    public function registerRaccoonTreatment(Request $request){

        $request['treatment_time'] = Carbon::now()->toDateTimeString();

        $incomingFields = $this->sanitize($request);

        try {
            Raccoon_Treatment_History::create($incomingFields);
        } catch (\Illuminate\Database\QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == '1062') {
                return back()->with('error', 'This treatment record already exists! Please enter a new treatment or contact an administrator if you believe this is a mistake.');
            } else {
                return back()->with('error', $e->getMessage());
            }
        }


        return redirect('/treatments');
    }
}
