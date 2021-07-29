<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IssueComment extends Model
{
    protected $table = 'issues_notes';
    public $timestamps = false;

    protected $fillable = [
        'note',
        'issue',
        'owner',
    ];

    public function ownerData() {
        return $this->hasOne(User::class, "id", "owner");
    }

    public function project() {
        return $this->hasOne(Group::class, "id", "group");
    }
}
