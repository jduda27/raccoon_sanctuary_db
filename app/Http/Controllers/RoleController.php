<?php

namespace App\Http\Controllers;

use App\Models\Enclosure;
use App\Models\Role;
use App\Models\Treatment;
use Illuminate\Http\Request;

class RoleController extends Controller
{

    protected function sanitize(Request $request){
        $incomingFields = $request->validate([
            'role_name' => ['required','string', 'max:120'],
            'enclosure_id' => ['integer'],
            'treatment_id'=>['integer']
        ]);

        $incomingFields['role_name'] = strip_tags($incomingFields['role_name']);
        $incomingFields['enclosure_id'] = strip_tags($incomingFields['enclosure_id']);
        $incomingFields['treatment_id'] = strip_tags($incomingFields['treatment_id']);

        return $incomingFields;
    }

    public function showRoleEdit(Role $role){
        return view('edit-role',['role'=>$role,'enclosures' => Enclosure::all()->sortBy('id'), 'treatments' => Treatment::all()->sortBy('id')]);
    }

    public function updateRole(Role $role, Request $request)
    {
        $incomingFields = $this->sanitize($request);

        $role->update($incomingFields);

        return redirect('/employees');
    }

    public function deleteRole(Role $role)
    {
        try{
            $role->delete();
        } catch (\Illuminate\Database\QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == '1451') {
                return back()->with('error', 'This role is currently in use and cannot be deleted! Please remove all employees from this role before deleting it.');
            } else {
                return back()->with('error', $e->getMessage());
            }
        }

        return redirect('/employees');
    }

    public function registerRole(Request $request){
        $incomingFields = $this->sanitize($request);

        try {
            Role::create($incomingFields);
        } catch (\Illuminate\Database\QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == '1062') {
                return back()->with('error', 'A role with this name already exists! Please enter a new role or contact an administrator if you believe this is a mistake.');
            } else {
                return back()->with('error', $e->getMessage());
            }
        }


        return redirect('/employees');


    }
}
