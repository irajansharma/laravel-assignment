<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Child extends Model
{
    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'age',
        'gender',
        'different_address',
        'address',
        'city',
        'state',
        'country',
        'zip_code',
    ];
}
