<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Packages extends Model
{

    protected $table = 'Packages';

    protected $fillable = [
        'PackageID', 
        'GuideNumber',
        'Description',
        'Size',
        'Weight',
        'ClientID',
        'Organize',
        'DeliveryAddress',
        'DestinationID',
        'Price',
        'Status',
        'AuditDate',
        'Username'
    ];

    public function StatusData()
    {
        return $this->belongsTo(Status::class, 'Status', 'StatusID');
    }

    public function Client()
    {
        return $this->belongsTo(Client::class, 'ClientID', 'ClientID');
    }

    public function Notes()
    {
        return $this->hasMany(PackageNotes::class, 'PackageID', 'PackageID');
    }

    public function Destination()
    {
        return $this->hasOne(Destination::class, 'DestinationID', 'DestinationID');
    }
}
