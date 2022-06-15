<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Services\Keys;
use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;

class HomePageApiController extends Controller
{
    /**
     * @OA\Get(
     ** path="/api/v1/home",
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
    public function home()
    {
        return response()->json([
            'result' => true,
            'message' => 'صفحه اصلی فروشگاه ساعت',
            'data' => [
                Keys::sliders  => Slider::getSliders(),
                Keys::categories  => Category::getAllCategories(),
                Keys::amazing_products  => ProductRepository::getSixAmazingProducts(),
                Keys::newest_products  => ProductRepository::getSixNewestProducts(),
            ],
        ], 200);
    }
}
