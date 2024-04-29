<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Raccoon_Treatment_History extends Model
{
    use HasFactory;

    public $timestamps = false;

    public $table = 'raccoon_treatment_history';

    protected $fillable = [
        'treatment_time',
        'treatment_id',
        'raccoon_id'
    ];
}
