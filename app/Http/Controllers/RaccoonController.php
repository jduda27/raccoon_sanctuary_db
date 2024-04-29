<?php

namespace App\Http\Controllers;

use App\Models\Raccoon;
use Illuminate\Http\Request;
use App\Models\Enclosure;

class RaccoonController extends Controller
{

    protected function sanitize(Request $request){
        $incomingFields = $request->validate([
            'raccoon_name' => ['required', 'max:255'],
            'age' => ['required', 'max:50'],
            'sex' => ['required', 'max:1'],
            'length' => ['required'],
            'weight' => ['required'],
            'enclosure_id' => ['required']

        ]);

        $incomingFields['raccoon_name'] = strip_tags($incomingFields['raccoon_name']);
        $incomingFields['age'] = strip_tags($incomingFields['age']);
        $incomingFields['sex'] = strip_tags($incomingFields['sex']);
        $incomingFields['length'] = strip_tags($incomingFields['length']);
        $incomingFields['weight'] = strip_tags($incomingFields['weight']);
        $incomingFields['enclosure_id'] = strip_tags($incomingFields['enclosure_id']);

        return $incomingFields;

    }

    public function showRaccoonEdit(Raccoon $raccoon){ 
         return view('edit-raccoon',['raccoon'=>$raccoon, 'enclosures' => Enclosure::all()->sortBy('id')]);
    }

    public function updateRaccoon(Raccoon $raccoon, Request $request)
    {
        $incomingFields = $this->sanitize($request);

        $raccoon->update($incomingFields);

        return redirect('/raccoons');
    }

    public function deleteRaccoon(Raccoon $raccoon)
    {
        try{
            $raccoon->delete();
        } catch (\Illuminate\Database\QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == '1451') {
                return back()->with('error', 'This raccoon is currently in our care and cannot be deleted! Please remove all animals and storage rooms from this raccoon before deleting it.');
            } else {
                return back()->with('error', $e->getMessage());
            }
        }

        return redirect('/raccoons');
    }

    public function registerRaccoon(Request $request) {
        $incomingFields = $this->sanitize($request);

        try {
            Raccoon::create($incomingFields);
        } catch (\Illuminate\Database\QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == '1062') {
                return back()->with('error', 'This raccoon name exists! Please pick a different name or contact an administrator if you believe this is a mistake.');
            } else {
                return back()->with('error', $e->getMessage());
            }
        }


        return redirect('/raccoons');
    }
}
