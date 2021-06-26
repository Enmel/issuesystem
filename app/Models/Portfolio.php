<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{

    protected $table = 'Portfolio';
    public $timestamps = false;

    protected $fillable = [
        'PortfolioID',
        'Name' 
    ];

    function Items () {
        return $this->hasMany(PortfolioItem::class, 'PortfolioID', 'PortfolioID');
    }

    function ItemsByQuery($q) {
        return $this->hasOne(PortfolioItem::class, 'PortfolioID', 'PortfolioID')->ofMany([], function ($query) {
            $query->where([]);
        });
    }

};