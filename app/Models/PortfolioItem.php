<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PortfolioItem extends Model
{

    protected $table = 'PortfolioItem';
    public $timestamps = false;

    protected $fillable = [
        'PortfolioItemID',
        'Type',
        'Size',
        'Age',
        'Weight',
        'Needs',
        'ProductID'
    ];

    function Product() {
        return $this->hasOne(Product::class, 'ProductID', 'ProductID');
    }
};