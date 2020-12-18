<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{

    protected $table = 'Destinations';
    public $timestamps = false;

    protected $fillable = [
        'DestinationID', 
        'Name',
        'TownshipID',
        'CodeGuatex',
        'Coverage',
        'Zone',
        'Code'
    ];

    function Township()
    {
        return $this->belongsTo(Townships::class, 'TownshipID', 'TownshipID');
    }
}