<?php

namespace App\Models;

use App\Http\Resources\ProductListResource;
use App\Http\Resources\ProductResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'image',
        'price',
        'description',
        'discussion',
        'category_id',
        'brand_id',
        'title_en',
        'guaranty',
        'discount',
        'sell',
        'product_count',
        'is_special',
        'special_expiration',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function galleries()
    {
        return $this->hasMany(Gallery::class);
    }

    public function colors()
    {
        return $this->belongsToMany(Color::class, 'color_product');
    }

    public function properties()
    {
        return $this->belongsToMany(Property::class, 'product_property')
            ->withPivot(['value']);
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public static function saveImage($file): string
    {
        $name = time().'.'.$file->extension();
        $smallImage = Image::make($file->getRealPath());
        $bigImage = Image::make($file->getRealPath());

        $smallImage->resize(256, 256, function ($constraint) {
            $constraint->aspectRatio();
        });

        Storage::disk('local')->put('product/small/'.$name, (string) $smallImage->encode('png', 90));
        Storage::disk('local')->put('product/big/'.$name, (string) $bigImage->encode('png', 90));

        return $name;
    }
}
