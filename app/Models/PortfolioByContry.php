<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PortfolioByContry extends Model
{

    protected $table = 'PortfolioByContry';
    public $timestamps = false;

    protected $fillable = [
        'PortfolioByContriesID',
        'PortfolioID',
        'CountryID'
    ];

    function Portfolio () {
        return $this->hasOne(Portfolio::class, 'PortfolioID', 'PortfolioID');
    }
};