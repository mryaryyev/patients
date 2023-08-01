<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
    ];

    public $timestamps = false;


    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }


    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }


    public function doctor(): BelongsTo
    {
        return $this->belongsTo(Doctor::class);
    }


    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }

}