<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $table = 'Product';
    public $timestamps = false;

    protected $fillable = [
        'ProductID',
        'Name',
        'Description',
        'Picture'
    ];
};