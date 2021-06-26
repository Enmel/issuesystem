<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{

    protected $table = 'Country';
    public $timestamps = false;

    protected $fillable = [
        'CountryID',
        'Abbreviation',
        'Name'
    ];
};