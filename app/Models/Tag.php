<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
    ];

    public function articles()
    {
        return $this->morphedByMany(Article::class, 'taggable');
    }

    public function companies()
    {
        return $this->morphedByMany(Company::class, 'taggable');
    }

    public function files()
    {
        return $this->morphedByMany(File::class, 'taggable');
    }
}
