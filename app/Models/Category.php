<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'parent_id'
    ];

    public function parent()
    {
      return $this->belongsTo(Category::class,'parent_id','id')->withDefault(['title'=>'----']);
    }

    public function child()
    {
        return $this->hasMany(Category::class,'parent_id','id');
    }

    public function companies()
    {
        return $this->hasMany(Company::class);
    }

    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    public function files()
    {
        return $this->hasMany(File::class);
    }

    public function conferences()
    {
        return $this->hasMany(Article::class);
    }

}
