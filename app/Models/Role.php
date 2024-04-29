<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    public $timestamps = false;

    public $table = 'role';

    protected $fillable = [
        'role_name',
        'treatment_id',
        'enclosure_id'
    ];


}
