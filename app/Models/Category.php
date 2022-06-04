<?php

namespace App\Models;

use App\Http\Resources\CategoryResource;
use Intervention\Image\Facades\Image;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'parent_id',
        'image'
    ];

    public function parent()
    {
      return $this->belongsTo(Category::class,'parent_id','id')->withDefault(['title'=>'----']);
    }

    public function child()
    {
        return $this->hasMany(Category::class,'parent_id','id');
    }

    public static function saveImage($file): string
    {
        $name = time() .'.'. $file->extension();
        $smallImage = Image::make($file->getRealPath());
        $bigImage = Image::make($file->getRealPath());

        $smallImage->resize(256, 256, function ($constraint) {
            $constraint->aspectRatio();
        });

        Storage::disk('local')->put('category/small/' . $name, (string)$smallImage->encode('png', 90));
        Storage::disk('local')->put('category/big/' . $name, (string)$bigImage->encode('png', 90));

        //$file->storeAs('category/small/', $name,'local');

        return $name;
    }

    public static function getAllCategories(){
        $categories = Category::query()->get();
        return  CategoryResource::collection($categories);
    }

}
