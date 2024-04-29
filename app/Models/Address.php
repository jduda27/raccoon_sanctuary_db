<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    public $timestamps = false;

    public $table = 'address';

    protected $fillable = [
        'street_address',
        'city',
        'state',
        'zipcode'
    ];
}
