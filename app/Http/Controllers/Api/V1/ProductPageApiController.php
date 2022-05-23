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
    /**
     * @OA\Get(
     ** path="/api/v1/product_page",
     *  tags={"Product Page"},
     *  description="get products page data",
     *   @OA\Response(
     *      response=200,
     *      description="Its Ok",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   )
     *)
     **/
    public function productsPage()
    {
        return response()->json([
            'result' => true,
            'message' => "صفحه محصولات فروشگاه ساعت",
            'data' => [
                Keys::all_brands  => Brand::getAllBrands(),
                Keys::all_products  => Product::getAllProducts()->response()->getData(true),
            ],
        ], 200);
    }


    /**
     * @OA\Get(
     ** path="/api/v1/products_by_category/{id}",
     *  tags={"Product Page"},
     *  description="get products data by category id",
     *   @OA\Response(
     *      response=200,
     *      description="Its Ok",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   )
     *)
     **/
    public function productsByCategory($id)
    {
        return response()->json([
            'result' => true,
            'message' => "صفحه محصولات فروشگاه ساعت بر اساس دسته بندی",
            'data' => [
                Keys::all_brands  => Brand::getAllBrands(),
                Keys::products_by_category => Product::getProductsByCategory($id)->response()->getData(true),
            ],
        ], 200);
    }


    /**
     * @OA\Get(
     ** path="/api/v1/products_by_brand/{id}",
     *  tags={"Product Page"},
     *  description="get products data by brand id",
     *   @OA\Response(
     *      response=200,
     *      description="Its Ok",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   )
     *)
     **/
    public function productsByBrand($id)
    {
        return response()->json([
            'result' => true,
            'message' => " صفحه محصولات فروشگاه ساعت بر اساس برند",
            'data' => [
                Keys::all_brands  => Brand::getAllBrands(),
                Keys::products_by_brands  => Product::getProductsByBrand($id)->response()->getData(true),
            ],
        ], 200);
    }


    /**
     * @OA\Get(
     ** path="/api/v1/product_details/{id}",
     *  tags={"Product Details"},
     *  description="get product details data by product id",
     *   @OA\Response(
     *      response=200,
     *      description="Its Ok",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   )
     *)
     **/
    public function productDetail($id)
    {

        $product =  Product::query()->find($id);

        return response()->json([
            'result' => true,
            'message' => " صفحه محصولات فروشگاه ساعت بر اساس برند",
            'data' => [
                new ProductResource($product)
            ],
        ], 200);
    }


    /**
     * @OA\Post(
     ** path="/api/v1/save_product_comment",
     *  tags={"Product Details"},
     *  description="save user comment for product",
     *   security={ * {"sanctum": {}}, * },
     *   @OA\RequestBody(
     *    required=true,
     *    @OA\JsonContent(
     *       required={"mobile","code"},
     *       @OA\Property(property="mobile", type="string", format="mobile", example="09167014556"),
     *       @OA\Property(property="code", type="string", format="text", example="9986"),
     *    ),
     * ),
     *   @OA\Response(
     *      response=200,
     *      description="Its Ok",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   )
     *)
     **/
    public function saveComment(Request $request)
    {
        $user = auth()->user();

        var_dump($user->id);
        // $product =  Product::query()->find($request->product_id);

        // $comment = new Comment;
        // $comment->body = $request->body;
        // $comment->user_id = auth()->user()->id;

        // $product->comments()->save($comment);

        // return response()->json([
        //     'result' => true,
        //     'message' => " نظر ثبت شد و پس از تایید نمایش داده خواهد شد",
        //     'data' => [],
        // ], 200);
    }
}
