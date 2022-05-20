<?php

namespace App\Http\Controllers\api\V1;

use App\Models\Brand;
use App\Models\Comment;
use App\Models\Product;
use App\Http\Services\Keys;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;

class ProductPageApiController extends Controller
{
    public function productsPage(){
        return response()->json([
            'result' => true,
            'message' => "صفحه محصولات فروشگاه ساعت",
            'data' => [
                Keys::all_brands  => Brand::getAllBrands(),
                Keys::all_products  => Product::getAllProducts()->response()->getData(true),
            ],
        ], 200);
    }


    public function productsByCategory($id){
        return response()->json([
            'result' => true,
            'message' => "صفحه محصولات فروشگاه ساعت بر اساس دسته بندی",
            'data' => [
                Keys::all_brands  => Brand::getAllBrands(),
                Keys::products_by_category => Product::getProductsByCategory($id)->response()->getData(true),
            ],
        ], 200);
    }


    public function productsByBrand($id){
        return response()->json([
            'result' => true,
            'message' => " صفحه محصولات فروشگاه ساعت بر اساس برند",
            'data' => [
                Keys::all_brands  => Brand::getAllBrands(),
                Keys::products_by_brands  => Product::getProductsByBrand($id)->response()->getData(true),
            ],
        ], 200);
    }


    public function productDetail($id){

        $product =  Product::query()->find($id);

        return response()->json([
            'result' => true,
            'message' => " صفحه محصولات فروشگاه ساعت بر اساس برند",
            'data' => [
                 new ProductResource($product)
            ],
        ], 200);
    }


    public function saveComment(Request $request){

        $product =  Product::query()->find($request->product_id);

        $comment = new Comment;
        $comment->body=$request->body;
        $comment->user_id=auth()->user()->id;

        $product->comments()->save($comment);

        return response()->json([
            'result' => true,
            'message' => " نظر ثبت شد و پس از تایید نمایش داده خواهد شد",
            'data' => [],
        ], 200);
    }


}
