<?php

namespace App\Models;

use App\Http\Resources\BrandResource;
use Intervention\Image\Facades\Image;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Brand extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'image'
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public static function saveImage($file): string
    {
        $name = time() .'.'. $file->extension();
        $smallImage = Image::make($file->getRealPath());
        $bigImage = Image::make($file->getRealPath());

        $smallImage->resize(256, 256, function ($constraint) {
            $constraint->aspectRatio();
        });

        Storage::disk('local')->put('brands/small/' . $name, (string)$smallImage->encode('png', 90));
        Storage::disk('local')->put('brands/big/' . $name, (string)$bigImage->encode('png', 90));

        return $name;
    }

    public static function getAllBrands(){
        $brands= Brand::query()->get();
        return BrandResource::collection($brands);
    }
}
