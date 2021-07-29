<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Error extends Model
{
    protected $table = 'errors';
    public $timestamps = false;

    protected $fillable = [
        'title',
        'type',
        'status',
        'group',
    ];

    public function project() {
        return $this->hasOne(Group::class, "id", "group");
    }

    public function comments() {
        return $this->hasMany(ErrorComment::class, "error", "id")->with("ownerData");
    }
}
