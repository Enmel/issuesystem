<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserByDestination extends Model
{

    protected $table = 'UserByDestination';
    public $timestamps = false;

    protected $fillable = [
        'UserByDestinationID',
        'Username', 
        'DestinationID',
        'Routes'
    ];
    
    public function Destination()
    {
        return $this->hasOne(Destination::class, 'DestinationID', 'DestinationID')->with('Township.Department');
    }
};