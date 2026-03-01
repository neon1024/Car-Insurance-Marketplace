<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = [
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    public function offers()
    {
        return $this->hasMany(Offer::class);
    }

    public function policies()
    {
        return $this->hasMany(Policy::class);
    }
}
