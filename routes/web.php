<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EnclosureController;
use App\Http\Controllers\RaccoonController;
use App\Http\Controllers\RaccoonTreatmentHistoryController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SanctuaryController;
use App\Http\Controllers\ShiftController;
use App\Http\Controllers\StorageRoomController;
use App\Http\Controllers\SupplyController;
use App\Http\Controllers\TreatmentController;

use App\Models\Address;
use App\Models\Employee;
use App\Models\Enclosure;
use App\Models\Raccoon;
use App\Models\Raccoon_Treatment_History;
use App\Models\Role;
use App\Models\Sanctuary;
use App\Models\Storage_Room;
use App\Models\Treatment;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $shifts = DB::table('shift')->join('schedule', 'shift.schedule_id', '=', 'schedule.id')->join('sanctuary', 'schedule.sanctuary_id', '=', 'sanctuary.id')->join('employee', 'shift.employee_id', '=', 'employee.id')->select('*','shift.id')->get();

    $schedules = DB::table('schedule')->join('sanctuary', 'schedule.sanctuary_id', '=', 'sanctuary.id')->select('*', 'schedule.id')->get()->sortBy('schedule.id');

    $employees = DB::table('employee')->join('address', 'address.id', '=', 'employee.address_id')->join('role', 'role.id', '=', 'employee.role_id')->select('*', 'employee.id')->get()->sortBy('id');

    return view('sanctuaries', ['addresses' => Address::all()->sortBy('id'), 'sanctuaries' => Sanctuary::all()->sortBy('id'), 'shifts' => $shifts, 'schedules' => $schedules, 'employees' => $employees]);
});

Route::get('/employees', function () {
    $employees = DB::table('employee')->join('address', 'address.id', '=', 'employee.address_id')->join('role', 'role.id', '=', 'employee.role_id')->select('*','employee.id')->get()->sortBy('id');

    $roles = DB::table('role')->join('treatment', 'treatment.id', '=', 'role.treatment_id')->join('enclosure', 'enclosure.id', '=', 'role.enclosure_id')->select('*', 'role.id')->get()->sortBy('id');

    return view('employees', ['addresses' => Address::all()->sortBy('id'), 'enclosures' => Enclosure::all()->sortBy('id'), 'treatments' => Treatment::all()->sortBy('id'), 'employees' => $employees, 'roles' => $roles]);
});

Route::get('/raccoons', function () {
    return view('raccoons', ['raccoons' => Raccoon::all()->sortBy('id'), 'enclosures' => Enclosure::all()->sortBy('id')]);
});

Route::get('/treatments', function () {
    $historyDisplay = DB::table('raccoon_treatment_history')->join('treatment', 'raccoon_treatment_history.treatment_id', '=', 'treatment.id')->join('raccoon', 'raccoon_treatment_history.raccoon_id', '=', 'raccoon.id')->select('*')->get()->sortBy('id');

    return view('treatments', ['treatments' => Treatment::all()->sortBy('id'), 'raccoons' => Raccoon::all()->sortBy('id'), 'history' => Raccoon_Treatment_History::all()->sortBy('treatment_time'), 'historyDisplay' => $historyDisplay]);
});

Route::get('/enclosures', function () {
    $supplies = DB::table('supply')->join('storage_room', 'storage_room.id', '=', 'supply.storage_id')->select('*','supply.id')->get()->sortBy('id');

    return view('enclosures', ['enclosures' => Enclosure::all()->sortBy('id'), 'storageRooms' => Storage_Room::all()->sortBy('id'), 'supplies' => $supplies]);
});

Route::get('/register', function () {
    return view('register', ['addresses' => Address::all()->sortBy('id'), 'employees' => Employee::all()->sortBy('id'), 'raccoons' => Raccoon::all()->sortBy('id'), 'roles' => Role::all()->sortBy('id'), 'treatments' => Treatment::all()->sortBy('id'), 'treatmentHistories' => Raccoon_Treatment_History::all()->sortBy('treatment_time')]);
});

Route::post('/register-employee', [EmployeeController::class, 'registerEmployee']);
Route::get('/edit-employee/{employee}', [EmployeeController::class, 'showEmployeeEdit']);
Route::put('/edit-employee/{employee}', [EmployeeController::class, 'updateEmployee']);
Route::delete('/delete-employee/{employee}', [EmployeeController::class, 'deleteEmployee']);

Route::post('/register-enclosure', [EnclosureController::class, 'registerEnclosure']);
Route::get('/edit-enclosure/{enclosure}', [EnclosureController::class, 'showEnclosureEdit']);
Route::put('/edit-enclosure/{enclosure}', [EnclosureController::class, 'updateEnclosure']);
Route::delete('/delete-enclosure/{enclosure}', [EnclosureController::class, 'deleteEnclosure']);

Route::post('/register-role', [RoleController::class, 'registerRole']);
Route::get('/edit-role/{role}', [RoleController::class, 'showRoleEdit']);
Route::put('/edit-role/{role}', [RoleController::class, 'updateRole']);
Route::delete('/delete-role/{role}', [RoleController::class, 'deleteRole']);

Route::post('/register-treatments', [TreatmentController::class, 'registerTreatment']);
Route::get('/edit-treatment/{treatment}', [TreatmentController::class, 'showEditScreen']);
Route::put('/edit-treatment/{treatment}', [TreatmentController::class, 'updateTreatment']);
Route::delete('/delete-treatment/{treatment}', [TreatmentController::class, 'deleteTreatment']);

Route::post('/register-raccoon-treatment', [RaccoonTreatmentHistoryController::class, 'registerRaccoonTreatment']);

Route::post('/register-address', [AddressController::class, 'registerAddress']);
Route::get('/edit-address/{address}', [AddressController::class, 'showAddressEdit']);
Route::put('/edit-address/{address}', [AddressController::class, 'updateAddress']);
Route::delete('/delete-address/{address}', [AddressController::class, 'deleteAddress']);

Route::post('/register-raccoon', [RaccoonController::class, 'registerRaccoon']);
Route::get('/edit-raccoon/{raccoon}', [RaccoonController::class, 'showRaccoonEdit']);
Route::put('/edit-raccoon/{raccoon}', [RaccoonController::class, 'updateRaccoon']);
Route::delete('/delete-raccoon/{raccoon}', [RaccoonController::class, 'deleteRaccoon']);

Route::post('/register-sanctuary', [SanctuaryController::class, 'registerSanctuary']);
Route::get('/edit-sanctuary/{sanctuary}', [SanctuaryController::class, 'showSanctuaryEdit']);
Route::put('/edit-sanctuary/{sanctuary}', [SanctuaryController::class, 'updateSanctuary']);
Route::delete('/delete-sanctuary/{sanctuary}', [SanctuaryController::class, 'deleteSanctuary']);

Route::post('/register-storage-room', [StorageRoomController::class, 'registerStorageRoom']);
Route::get('/edit-storage-room/{storage_room}', [StorageRoomController::class, 'showStorageRoomEdit']);
Route::put('/edit-storage-room/{storage_room}', [StorageRoomController::class, 'updateStorageRoom']);
Route::delete('/delete-storage-room/{storage_room}', [StorageRoomController::class, 'deleteStorageRoom']);

Route::post('/register-supply', [SupplyController::class, 'registerSupply']);
Route::get('/edit-supply/{supply}', [SupplyController::class, 'showSupplyEdit']);
Route::put('/edit-supply/{supply}', [SupplyController::class, 'updateSupply']);
Route::delete('/delete-supply/{supply}', [SupplyController::class, 'deleteSupply']);

Route::post('/register-shift', [ShiftController::class, 'registerShift']);
Route::get('/edit-shift/{shift}', [ShiftController::class, 'showShiftEdit']);
Route::put('/edit-shift/{shift}', [ShiftController::class, 'updateShift']);
Route::delete('/delete-shift/{shift}', [ShiftController::class, 'deleteShift']);
