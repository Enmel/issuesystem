<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ErrorComment extends Model
{
    protected $table = 'errors_notes';
    public $timestamps = false;

    protected $fillable = [
        'note',
        'error',
        'user',
    ];

    public function ownerData() {
        return $this->hasOne(User::class, "id", "user");
    }
}
