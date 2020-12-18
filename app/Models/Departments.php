<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Departments extends Model
{

    protected $table = 'Departments';
    public $timestamps = false;

    protected $fillable = [
        'DepartmentID', 
        'Name',
        'Code'
    ];
}