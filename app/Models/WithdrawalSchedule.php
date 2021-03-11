<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WithdrawalSchedule extends Model
{

    protected $table = 'WithdrawalSchedule';
    protected $primaryKey = 'WithdrawalScheduleID';
    public $timestamps = false;

    protected $fillable = [
        'WithdrawalScheduleID',
        'ClientID',
        'UserName',
        'DateWithdrawal',
        'TimeWithdrawal',
        'Status'
    ];

    public function scopeWaitingCollector($query, $username)
    {
        return $query->where('Username', $username)->where('Status', 'W-P')->with('Client');
    }

    public function Client ()
    {
        return $this->hasOne(Client::class, 'ClientID', 'ClientID');
    }

    public function Packages()
    {
        return $this->hasMany(WithdrawalSchedule::class, 'ClientID', 'ClientID');
    }

    public function getRouteKeyName()
    {
        return 'WithdrawalScheduleID';
    }
}
