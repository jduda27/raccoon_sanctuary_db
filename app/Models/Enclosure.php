<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enclosure extends Model
{
    use HasFactory;

    public $timestamps = false;

    public $table = 'enclosure';

    protected $fillable = [
        'enclosure_name'
    ];
}
