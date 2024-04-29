<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    use HasFactory;

    public $timestamps = false;

    public $table = 'shift';

    protected $fillable = [
        'start_time',
        'end_time',
        'employee_id',
        'schedule_id',
    ];

}
