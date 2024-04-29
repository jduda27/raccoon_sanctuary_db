<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Treatment extends Model
{
    use HasFactory;

    public $timestamps = false;

    public $table = 'treatment';

    protected $fillable = [
        'treatment_type'
    ];

}
