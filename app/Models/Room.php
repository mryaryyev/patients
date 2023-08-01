<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Room extends Model
{
    protected $guarded = [
        'id',
    ];

    public $timestamps = false;


    public function departments(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function treatments(): HasMany
    {
        return $this->hasMany(Treatment::class);
    }

}