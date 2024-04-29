<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{

    protected function sanitize(Request $request){
        $incomingFields = $request->validate([
            'street_address' => ['required', 'max:120'],
            'city' => ['required', 'min:3', 'max:60'],
            'state' => ['required', 'min:4', 'max:30'],
            'zipcode' => ['required', 'min:5', 'max:5']
        ]);

        $incomingFields['street_address'] = strip_tags($incomingFields['street_address']);
        $incomingFields['city'] = strip_tags($incomingFields['city']);
        $incomingFields['state'] = strip_tags($incomingFields['state']);
        $incomingFields['zipcode'] = strip_tags($incomingFields['zipcode']);

        return $incomingFields;
    }

    public function showAddressEdit(Address $address){
        return view('edit-address',['address'=>$address]);
    }

    public function updateAddress(Address $address, Request $request)
    {
        $incomingFields = $this->sanitize($request);

        $address->update($incomingFields);

        return redirect('/employees');
    }

    public function deleteAddress(Address $address){
        try {
            $address->delete();
        } catch (\Illuminate\Database\QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == '1451') {
                return back()->with('error', 'This entry cannot be deleted! Please remove dependencies or contact an administrator if you believe this is a mistake.');
            } else {
                return back()->with('error', $e->getMessage());
            }
        }
        return redirect('/employees');
    }

    public function registerAddress(Request $request){
        $incomingFields = $this->sanitize($request);

        try {
            Address::create($incomingFields);
        } catch (\Illuminate\Database\QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == '1062') {
                return back()->with('error', 'This address already exists! Please enter a new address or contact an administrator if you believe this is a mistake.');
            } else {
                return back()->with('error', $e->getMessage());
            }
        }



        return redirect('/employees');
    }
}
