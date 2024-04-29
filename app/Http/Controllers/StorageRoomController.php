<?php

namespace App\Http\Controllers;

use App\Models\Enclosure;
use App\Models\Storage_Room;
use Illuminate\Http\Request;

class StorageRoomController extends Controller
{

    protected function sanitize(Request $request)
    {
        $incomingFields = $request->validate([
            'location_name' => ['required'],
            'enclosure_id' => ['required']
        ]);

        $incomingFields['location_name'] = strip_tags($incomingFields['location_name']);
        $incomingFields['enclosure_id'] = strip_tags($incomingFields['enclosure_id']);

        return $incomingFields; 
    }

    public function showStorageRoomEdit(Storage_Room $storage_room)
    {
        return view('edit-storage-room', ['storage_room' => $storage_room, 'enclosures' => Enclosure::all()->sortBy('id')]);
    }

    public function updateStorageRoom(Storage_Room $storage_room, Request $request)
    {
        $incomingFields = $this->sanitize($request);

        $storage_room->update($incomingFields);

        return redirect('/enclosures');
    }

    public function deleteStorageRoom(Storage_Room $storage_room)
    {
        try{
            $storage_room->delete();
        } catch (\Illuminate\Database\QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == '1451') {
                return back()->with('error', 'This storage room is currently in use and cannot be deleted! Please remove all supplies from this storage room before deleting it.');
            } else {
                return back()->with('error', $e->getMessage());
            }
        }

        return redirect('/enclosures');
    }

    public function registerStorageRoom(Request $request)
    {
        $incomingFields = $this->sanitize($request);

        try {
            Storage_Room::create($incomingFields);
        } catch (\Illuminate\Database\QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == '1062') {
                return back()->with('error', 'A storage room with this name already exists! Please enter a new storage room or contact an administrator if you believe this is a mistake.');
            } else {
                return back()->with('error', $e->getMessage());
            }
        }


        return redirect('/enclosures');
    }
}
