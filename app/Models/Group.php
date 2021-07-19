<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $table = 'groups';
    public $timestamps = false;

    protected $fillable = [
        'name', 'description', 'picture'
    ];

    public function file()
    {
        return $this->hasOne(File::class, "id", "picture");
    }

    public function members()
    {
        return $this->hasMany(Member::class, "group_id", "id")->with('user');
    }
}
