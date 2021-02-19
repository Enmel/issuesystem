<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoleByUser extends Model
{

    protected $table = 'UserByRole';
    public $timestamps = false;

    protected $fillable = [
        'UserByRoleID',
        'Username', 
        'RoleID',
    ];

    public function Role() {
        return $this->hasOne(Role::class, 'RoleID', 'RoleID');
    }
};