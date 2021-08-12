<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;
use PhpParser\Node\Expr\FuncCall;

class User extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable, HasFactory;

    protected $table = 'users';
    public $timestamps = false;

    protected $fillable = [
        'name', 'password', 'email', 'picture', 'role', 'token'
    ];
    
    protected $hidden = [
        'password',
    ];

    public function getIsAdminAttribute()
    {
        return (bool) $this->role === 'Admin' || $this->role === 'SuperAdmin';
    }

    public function groups()
    {
        return $this->belongsToMany(Group::class, 'users_by_group');
    }

    public function groupsErrors()
    {
        return $this->belongsToMany(Group::class, 'users_by_group')->with('errors');
        
    }

    public function groupsIssues()
    {
        return $this->belongsToMany(Group::class, 'users_by_group')->with('issues');
        
    }
}
