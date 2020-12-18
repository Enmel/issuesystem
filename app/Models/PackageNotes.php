<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PackageNotes extends Model
{

    protected $table = 'PackagesNotes';
    public $timestamps = false;

    protected $fillable = [
        'PackageNoteID', 
        'NewStatus',
        'Note',
        'LogDate',
        'PackageID',
    ];

}
