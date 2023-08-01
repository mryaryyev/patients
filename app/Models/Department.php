<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Department extends Model
{
    protected $guarded = [
        'id',
    ];

    public $timestamps = false;


    public function rooms(): HasMany
    {
        return $this->hasMany(Room::class);
    }

    public function doctors(): HasMany
    {
        return $this->hasMany(Doctor::class);
    }

    public function treatments(): HasMany
    {
        return $this->hasMany(Treatment::class);
    }

}
