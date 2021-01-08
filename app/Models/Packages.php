<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Packages extends Model
{

    protected $table = 'Packages';
    protected $primaryKey = 'PackageID';
    public $timestamps = false;

    protected $fillable = [
        'PackageID', 
        'GuideNumber',
        'Description',
        'Size',
        'Weight',
        'ClientID',
        'Organize',
        'ReceiverName',
        'DeliveryAddress',
        'DestinationID',
        'Price',
        'Status',
        'AuditDate',
        'DeliveryDate',
        'Username',
        'Observations'
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
        return $this->hasOne(Destination::class, 'DestinationID', 'DestinationID')->with('Township.Department');
    }
}
