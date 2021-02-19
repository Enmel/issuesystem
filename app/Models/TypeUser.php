<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TypeUser extends Model
{

    protected $table = 'TypeUsers';
    public $timestamps = false;

    protected $fillable = [
        'TypeUsersID', 
        'Name',
    ];
};