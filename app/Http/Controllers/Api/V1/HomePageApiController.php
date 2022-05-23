<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Slider;
use App\Models\Product;
use App\Models\Category;
use App\Http\Services\Keys;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomePageApiController extends Controller
{


    /**
     * @OA\Get(
     ** path="/api/v1/home_page",
     *  tags={"Home Page"},
     *  description="get home page data",
     *   @OA\Response(
     *      response=200,
     *      description="Its Ok",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   )
     *)
     **/
    public function homePage()
    {
        return response()->json([
            'result' => true,
            'message' => "صفحه اصلی فروشگاه ساعت",
            'data' => [
                Keys::sliders  => Slider::getSliders(),
                Keys::categories  => Category::getAllCategories(),
                Keys::amazing_products  => Product::getAmazingProducts(),
                Keys::newest_products  => Product::getNewestProducts(),
            ],
        ], 200);
    }
}
