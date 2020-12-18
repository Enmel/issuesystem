<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{

    protected $table = 'Clients';

    protected $fillable = [
        'PackageID', 
        'GuideNumber',
        'Description',
        'Price',
        'Organize',
        'Size',
        'Weight',
        'ClientID',
        'Status',
        'AuditDate',
        'Username'
    ];

    public function Status()
    {
        return $this->belongsTo(Status::class, 'Status', 'StatusID');
    }

    public function Client()
    {
        return $this->belongsTo(Status::class, 'ClientID', 'ClientID');
    }
}
