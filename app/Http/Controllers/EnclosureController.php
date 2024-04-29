<?php

namespace App\Http\Controllers;

use App\Models\Enclosure;
use Illuminate\Http\Request;

class EnclosureController extends Controller
{
    protected function sanitize(Request $request)
    {
        $incomingFields = $request->validate([
            'enclosure_name' => ['required', 'max:255']
        ]);

        $incomingFields['enclosure_name'] = strip_tags($incomingFields['enclosure_name']);

        return $incomingFields;
    }

    public function showEnclosureEdit(Enclosure $enclosure)
    {
        return view('edit-enclosure', ['enclosure' => $enclosure]);
    }

    public function updateEnclosure(Enclosure $enclosure, Request $request)
    {
        $incomingFields = $this->sanitize($request);

        $enclosure->update($incomingFields);

        return redirect('/enclosures');
    }

    public function deleteEnclosure(Enclosure $enclosure)
    {
        try{
            $enclosure->delete();
        } catch (\Illuminate\Database\QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == '1451') {
                return back()->with('error', 'This enclosure is currently in use and cannot be deleted! Please remove all animals and storage rooms from this enclosure before deleting it.');
            } else {
                return back()->with('error', $e->getMessage());
            }
        }

        return redirect('/enclosures');
    }

    public function registerEnclosure(Request $request)
    {
        $incomingFields = $this->sanitize($request);

        try {
            Enclosure::create($incomingFields);
        } catch (\Illuminate\Database\QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == '1062') {
                return back()->with('error', 'This enclosure cannot have the same name as an existing enclosure! Please use different name or contact an administrator if you believe this is a mistake.');
            } else {
                return back()->with('error', $e->getMessage());
            }
        }

        return redirect('/enclosures');
    }
}
