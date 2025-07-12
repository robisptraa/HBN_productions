<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $fillable = [
        'title', 'description', 'expiration_time', 'background_color', 'price'
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_packages')
                    ->withPivot(['start_date', 'end_date'])
                    ->withTimestamps();
    }

    public function userPackages()
    {
        return $this->hasMany(UserPackage::class);
    }

}
