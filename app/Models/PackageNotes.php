<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PackageNotes extends Model
{

    protected $table = 'PackagesNotes';

    protected $fillable = [
        'PackageNoteID', 
        'NewStatus',
        'Note',
        'LogDate',
        'PackageID',
    ];

}
