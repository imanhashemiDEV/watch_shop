<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class City extends Model
{
    protected $hidden = ['created_at', 'updated_at'];

    public function province(): BelongsTo
    {
        return $this->belongsTo(Province::class);
    }
}

