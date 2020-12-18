<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Townships extends Model
{

    protected $table = 'Townships';

    protected $fillable = [
        'TownshipID', 
        'Name',
        'DepartmentID',
        'Code'
    ];
};