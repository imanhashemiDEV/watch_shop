<?php

namespace App\Http\Controllers\api\V1;

use App\Http\Services\Keys;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Product;

class ProductPageApiController extends Controller
{
    public function productsPage(){
        return response()->json([
            'result' => true,
            'message' => "صفحه محصولات فروشگاه ساعت",
            'data' => [
                Keys::all_brands  => Brand::getAllBrands(),
                Keys::all_products  => Product::getAllProducts(),
            ],
        ], 200);
    }
}
