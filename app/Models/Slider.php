<?php

namespace App\Models;

use App\Http\Resources\SliderResource;
use Intervention\Image\Facades\Image;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Slider extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'title'
    ];

    public static function saveImage($file): string
    {
        $name = time() .'.'. $file->extension();
        $smallImage = Image::make($file->getRealPath());
        $bigImage = Image::make($file->getRealPath());

        $smallImage->resize(256, 256, function ($constraint) {
            $constraint->aspectRatio();
        });

        Storage::disk('local')->put('sliders/small/' . $name, (string)$smallImage->encode('jpg', 90));
        Storage::disk('local')->put('sliders/big/' . $name, (string)$bigImage->encode('jpg', 90));

        return $name;
    }

    public static function getSliders(){

        $sliders= Slider::query()->get();

        return SliderResource::collection($sliders);
    }
}
