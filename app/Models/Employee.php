<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    public $timestamps = false;

    public $table = 'employee';

    protected $fillable = [
        'first_name',
        'last_name',
        'phone_number',
        'email',
        'address_id',
        'role_id'
    ];
}
