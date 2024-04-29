<?php

namespace App\Http\Controllers;

use App\Models\Storage_Room;
use App\Models\Supply;
use Illuminate\Http\Request;

class SupplyController extends Controller
{

    protected function sanitize(Request $request)
    {
        $incomingFields = $request->validate([
            'supply_name' => ['required'],
            'price' => 'numeric',
            'quantity' => ['required'],
            'storage_id' => ['required']
        ]);

        $incomingFields['supply_name'] = strip_tags($incomingFields['supply_name']);
        $incomingFields['quantity'] = strip_tags($incomingFields['quantity']);
        $incomingFields['price'] = strip_tags($incomingFields['price']);
        $incomingFields['storage_id'] = strip_tags($incomingFields['storage_id']);

        return $incomingFields;
    }

    public function showSupplyEdit(Supply $supply)
    {
        return view('edit-supply', ['supply' => $supply, 'storageRooms' => Storage_Room::all()->sortBy('id')]);
    }

    public function updateSupply(Supply $supply, Request $request)
    {
        $incomingFields = $this->sanitize($request);

        $supply->update($incomingFields);

        return redirect('/enclosures');
    }

    public function deleteSupply(Supply $supply)
    {
        try{
            $supply->delete();
        } catch (\Illuminate\Database\QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == '1451') {
                return back()->with('error', 'This supply is currently in use and cannot be deleted! Please remove all animals and storage rooms from this supply before deleting it.');
            } else {
                return back()->with('error', $e->getMessage());
            }
        }

        return redirect('/enclosures');
    }


    public function registerSupply(Request $request)
    {
        $incomingFields = $this->sanitize($request);

        try {
            Supply::create($incomingFields);
        } catch (\Illuminate\Database\QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == '1062') {
                return back()->with('error', 'A supply with this name already exists in this storage room! Please enter a new storage room or update the quantity of the already existing item, contact an administrator if you believe this is a mistake.');
            } else {
                return back()->with('error', $e->getMessage());
            }
        }


        return redirect('/enclosures');
    }
}
