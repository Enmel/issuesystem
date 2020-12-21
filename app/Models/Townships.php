<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Townships extends Model
{

    protected $table = 'Townships';
    public $timestamps = false;

    protected $fillable = [
        'TownshipID', 
        'Name',
        'DepartmentID',
        'Code'
    ];

    function Department()
    {
        return $this->belongsTo(Departments::class, 'DepartmentID', 'DepartmentID');
    }
};