<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Address;

class EmployeeController extends Controller
{

    protected function sanitize(Request $request){
        $incomingFields = $request->validate([
            'first_name' => ['required', 'max:255'],
            'last_name' => ['required', 'max:255'],
            'phone_number' => ['required', 'min:10', 'max:12'],
            'email' => ['required', 'email', 'max:255'],
            'address_id' => ['required'],
            'role_id' => ['required'],
        ]);

        $incomingFields['first_name'] = strip_tags($incomingFields['first_name']);
        $incomingFields['last_name'] = strip_tags($incomingFields['last_name']);
        $incomingFields['phone_number'] = strip_tags($incomingFields['phone_number']);
        $incomingFields['email'] = strip_tags($incomingFields['email']);
        $incomingFields['address_id'] = strip_tags($incomingFields['address_id']);
        $incomingFields['role_id'] = strip_tags($incomingFields['role_id']);

        return $incomingFields;

    }

    public function showEmployeeEdit(Employee $employee){

        $roles = DB::table('role')->join('treatment', 'treatment.id', '=', 'role.treatment_id')->join('enclosure', 'enclosure.id', '=', 'role.enclosure_id')->select('*', 'role.id')->get()->sortBy('id');

        return view('edit-employee',['employee'=>$employee,'addresses' => Address::all()->sortBy('id'), 'roles' => $roles]);
    }

    public function updateEmployee(Employee $employee, Request $request)
    {
        $incomingFields = $this->sanitize($request);

        $employee->update($incomingFields);

        return redirect('/employees');
    }

    public function deleteEmployee(Employee $employee)
    {
        try{
            $employee->delete();
        } catch (\Illuminate\Database\QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == '1451') {
                return back()->with('error', 'This employee is currently assigned to a shift and cannot be deleted! Please remove the shift assignment before deleting this employee.');
            } else {
                return back()->with('error', $e->getMessage());
            }
        }

        return redirect('/employees');
    }

    public function registerEmployee(Request $request){
        $incomingFields = $this->sanitize($request);

        try {
            Employee::create($incomingFields);
        } catch (\Illuminate\Database\QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == '1062') {
                return back()->with('error', 'This employee cannot have the same email, phone_number, or address as a current employee! Please use different information or contact an administrator if you believe this is a mistake.');
            } else {
                return back()->with('error', $e->getMessage());
            }
        }


        return redirect('/employees');
    }
}
