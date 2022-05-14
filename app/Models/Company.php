<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'manager',
        'mobile',
        'phone',
        'fax',
        'email',
        'description',
        'address',
        'website',
        'whatsapp',
        'facebook',
        'linkedin',
        'instagram',
        'telegram',
        'viewed',
        'marked',
        'profile_photo_path',
        'status',
        'category_id',
        'city_id',
        'province_id',
    ];

    public function category()
    {
       return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

}
