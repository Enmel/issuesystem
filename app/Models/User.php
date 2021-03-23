<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;

class User extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable, HasFactory;

    protected $table = 'UserAccount';

    protected $fillable = [
        'UserName', 'ApiToken', 'TypeUser'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'UserPassword',
    ];

    public function Type()
    {
        return $this->hasOne(TypeUser::class, 'TypeUsersID', 'TypeUser');
    }

    public function Role()
    {
        return $this->hasOne(RoleByUser::class, 'UserName', 'UserName');
    }

    public function Destination()
    {
        return $this->hasMany(UserByDestination::class, 'UserName', 'UserName')->with('Destination.Township.Department');
    }
}
