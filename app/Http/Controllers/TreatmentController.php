<?php

namespace App\Http\Controllers;

use App\Models\Treatment;
use Illuminate\Http\Request;

class TreatmentController extends Controller
{

    protected function sanitize(Request $request){
        $result = $request->validate([
            'treatment_type' => ['required', 'max:255']
        ]);

        $result['treatment_type'] = strip_tags($result['treatment_type']);

        return $result;
    }

    public function updateTreatment(Treatment $treatment, Request $request){
        $incomingFields = $this->sanitize($request);

        $treatment->update($incomingFields);
        
        return redirect('/treatments');
    }

    public function deleteTreatment(Treatment $treatment)
    {
        try {
            $treatment->delete();
        } catch (\Illuminate\Database\QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == '1451') {
                return back()->with('error', 'This treatment is currently in use and cannot be deleted! Please remove all treatment records from this treatment before deleting it.');
            } else {
                return back()->with('error', $e->getMessage());
            }
        }

        return redirect('/treatments');
    }

    public function registerTreatment(Request $request)
    {
        $incomingFields = $this->sanitize($request);

        try{
            Treatment::create($incomingFields);
        } catch (\Illuminate\Database\QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == '1062') {
                return back()->with('error', 'This treatment already exists! Please enter a new treatment or contact an administrator if you believe this is a mistake.');
            } else {
                return back()->with('error', $e->getMessage());
            }
        }

        return redirect('/treatments');
    }

    public function showEditScreen(Treatment $treatment){

        return view('edit-treatment',['treatment'=> $treatment]);
    }
}
