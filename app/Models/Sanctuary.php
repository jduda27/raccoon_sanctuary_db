<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sanctuary extends Model
{
    use HasFactory;

    public $timestamps = false;

    public $table = 'sanctuary';

    protected $fillable = [
        'sanctuary_name',
        'address_id'
    ];

}
