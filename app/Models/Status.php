<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{

    protected $table = 'Status';
    public $timestamps = false;

    protected $fillable = [
        'StatusID', 
        'Name',
        'Description',
    ];
};