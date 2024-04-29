<?php

namespace App\Http\Controllers;

use App\Models\Responsibility;
use Illuminate\Http\Request;

class ResponsibilityController extends Controller
{
    public function registerResponsibility(Request $request)
    {
        $incomingFields = $request->validate([
            'enclosure_id' => ['required']
        ]);
        $incomingFields['enclosure_id'] = strip_tags($incomingFields['enclosure_id']);

        try {
            Responsibility::create($incomingFields);
        } catch (\Illuminate\Database\QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == '1062') {
                return back()->with('error', 'A responsibility for this enclosure already exists! Please enter a new enclosure or contact an administrator if you believe this is a mistake.');
            } else {
                return back()->with('error', $e->getMessage());
            }
        }


        return redirect('/employees');
    }
}
