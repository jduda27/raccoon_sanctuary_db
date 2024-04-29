<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Responsibility extends Model
{
    use HasFactory;

    public $timestamps = false;

    public $table = 'responsibility';

    protected $fillable = [
        'enclosure_id'
    ];


}
