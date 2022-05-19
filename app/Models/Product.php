<?php

namespace App\Models;

use App\Http\Resources\ProductResource;
use Intervention\Image\Facades\Image;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable=[
        'title',
        'slug',
        'image',
        'price',
        'description',
        'category_id',
        'brand_id',
        'title_en',
        'guaranty',
        'discount',
        'sell',
        'product_count'
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
        return $this->belongsToMany(Color::class,'color_product');
    }

    public function properties()
    {
        return $this->belongsToMany(Property::class,'product_property')
            ->withPivot(['value']);
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable')->where('status','1');
    }

    public static function saveImage($file): string
    {
        $name = time() .'.'. $file->extension();
        $smallImage = Image::make($file->getRealPath());
        $bigImage = Image::make($file->getRealPath());

        $smallImage->resize(256, 256, function ($constraint) {
            $constraint->aspectRatio();
        });

        Storage::disk('local')->put('product/small/' . $name, (string)$smallImage->encode('jpg', 90));
        Storage::disk('local')->put('product/big/' . $name, (string)$bigImage->encode('jpg', 90));

        return $name;
    }

    public static function getAllProducts(){

        $product= Product::query()->paginate(12);

        return ProductResource::collection($product);
    }
}
