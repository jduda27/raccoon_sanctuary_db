<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Storage_Room extends Model
{
    use HasFactory;

    public $timestamps = false;

    public $table = 'storage_room';

    protected $fillable = [
        'location_name',
        'enclosure_id'
    ];

}
