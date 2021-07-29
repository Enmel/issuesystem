<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Issue extends Model
{
    protected $table = 'issues';
    public $timestamps = false;

    protected $fillable = [
        'title',
        'error_code',
        'status',
        'group',
        'contact',
        'reporter',
        'spotted_at',
    ];

    public function owner() {
        return $this->hasOne(User::class, "id", "reporter");
    }

    public function project() {
        return $this->hasOne(Group::class, "id", "group");
    }

    public function comments() {
        return $this->hasMany(IssueComment::class, "issue", "id")->with("ownerData");
    }
}
