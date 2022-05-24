<?php

namespace App\Http\Controllers\api\V1;

use App\Models\Brand;
use App\Models\Comment;
use App\Models\Product;
use App\Http\Services\Keys;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SearchRequest;
use App\Http\Resources\ProductResource;
use App\Repositories\ProductRepository;

class ProductPageApiController extends Controller
{
    /**
     * @OA\Get(
     ** path="/api/v1/all_products",
     *  tags={"Products Page"},
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
    public function allProducts()
    {
        return response()->json([
            'result' => true,
            'message' => "صفحه محصولات فروشگاه ساعت",
            'data' => [
                Keys::all_brands  => Brand::getAllBrands(),
                Keys::all_products  => ProductRepository::getAllProducts()->response()->getData(true),
            ],
        ], 200);
    }


     /**
     * @OA\Get(
     ** path="/api/v1/newest_products",
     *  tags={"Products Page"},
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
    public function newestProducts()
    {
        return response()->json([
            'result' => true,
            'message' => "صفحه محصولات فروشگاه ساعت",
            'data' => [
                Keys::all_brands  => Brand::getAllBrands(),
                Keys::all_products  => ProductRepository::getNewestProducts()->response()->getData(true),
            ],
        ], 200);
    }

     /**
     * @OA\Get(
     ** path="/api/v1/cheapest_products",
     *  tags={"Products Page"},
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
    public function cheapestProducts()
    {
        return response()->json([
            'result' => true,
            'message' => "صفحه محصولات فروشگاه ساعت",
            'data' => [
                Keys::all_brands  => Brand::getAllBrands(),
                Keys::all_products  => ProductRepository::getCheapestProducts()->response()->getData(true),
            ],
        ], 200);
    }


     /**
     * @OA\Get(
     ** path="/api/v1/most_expensive_products",
     *  tags={"Products Page"},
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
    public function mostExpensivexpensiveProducts()
    {
        return response()->json([
            'result' => true,
            'message' => "صفحه محصولات فروشگاه ساعت",
            'data' => [
                Keys::all_brands  => Brand::getAllBrands(),
                Keys::all_products  => ProductRepository::getMostExpensiveProducts()->response()->getData(true),
            ],
        ], 200);
    }


     /**
     * @OA\Get(
     ** path="/api/v1/most_viewed_products",
     *  tags={"Products Page"},
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
    public function mostViewedProducts()
    {
        return response()->json([
            'result' => true,
            'message' => "صفحه محصولات فروشگاه ساعت",
            'data' => [
                Keys::all_brands  => Brand::getAllBrands(),
                Keys::all_products  => ProductRepository::getAllProducts()->response()->getData(true),
            ],
        ], 200);
    }


    /**
     * @OA\Get(
     ** path="/api/v1/products_by_category/{id}",
     *  tags={"Products Page"},
     *  description="get products data by category id",
     * *     @OA\Parameter(
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *         ),
     *     ),
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
                Keys::products_by_category => ProductRepository::getProductsByCategory($id)->response()->getData(true),
            ],
        ], 200);
    }


    /**
     * @OA\Get(
     ** path="/api/v1/products_by_brand/{id}",
     *  tags={"Products Page"},
     *  description="get products data by brand id",
     *      @OA\Parameter(
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *         ),
     *     ),
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
                Keys::products_by_brands  => ProductRepository::getProductsByBrand($id)->response()->getData(true),
            ],
        ], 200);
    }


     /**
     * @OA\Post(
     ** path="/api/v1/search_product",
     *  tags={"Products Page"},
     *  description="search product",
     *    @OA\RequestBody(
     *    required=true,
     *          @OA\MediaType(
     *           mediaType="multipart/form-data",
     *           @OA\Schema(
     *           @OA\Property(
     *                  property="search",
     *                  type="string",
     *               ),
     *     )
     *   )
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
    public function searchProduct(SearchRequest $request)
    {
        $search = $request->search;

        return response()->json([
            'result' => true,
            'message' => " صفحه محصولات فروشگاه ساعت بر اساس برند",
            'data' => [
                Keys::all_brands  => Brand::getAllBrands(),
                Keys::products_by_brands  => ProductRepository::getSearchedProducts($search)->response()->getData(true),
            ],
        ], 200);
    }


    /**
     * @OA\Get(
     ** path="/api/v1/product_details/{id}",
     *  tags={"Product Details"},
     *  description="get product details data by product id",
     *     @OA\Parameter(
     *         description="product id",
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         ),
     *     ),
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
        $product->increment('review');

        return response()->json([
            'result' => true,
            'message' => " صفحه جزئیات محصول فروشگاه ساعت   ",
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
     *   security={{"sanctum":{}}},
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
        $product =  Product::query()->find($request->product_id);

        $comment = new Comment;
        $comment->body = $request->body;
        $comment->user_id = auth()->user()->id;

        $product->comments()->save($comment);

        return response()->json([
            'result' => true,
            'message' => " نظر ثبت شد و پس از تایید نمایش داده خواهد شد",
            'data' => [],
        ], 200);
    }


}
