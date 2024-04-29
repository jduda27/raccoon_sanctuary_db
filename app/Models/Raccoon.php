<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Raccoon extends Model
{
    use HasFactory;

    public $timestamps = false;

    public $table = 'raccoon';

    protected $fillable = [
        'raccoon_name',
        'age',
        'sex',
        'length',
        'weight',
        'enclosure_id'
    ];

}
