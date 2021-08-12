<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $table = 'users_by_group';
    public $timestamps = false;

    protected $fillable = [
        'group_id', 'user_id'
    ];

    public function groups()
    {
        return $this->belongsTo(Group::class, "group_id", "id");
    }

    public function user()
    {
        return $this->hasOne(User::class, "id", "user_id");
    }
}