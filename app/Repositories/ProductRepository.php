<?php


namespace  App\Repositories;

use App\Models\Product;
use App\Http\Resources\ProductListResource;

class ProductRepository{

    // get all products paginated
    public static function getAllProducts(){

        $products= Product::query()->paginate(12);

        return ProductListResource::collection($products);
    }

    // get products by category paginated
    public static function getProductsByCategory($id){

        $products= Product::query()->where('category_id',$id)->paginate(12);

        return ProductListResource::collection($products);
    }

    // get products by brand paginated
    public static function getProductsByBrand($id){

        $products= Product::query()->where('brand_id',$id)->paginate(12);

        return ProductListResource::collection($products);
    }

    // get amazing producte order by discount paginated
    public static function getAmazingProducts(){

        $products= Product::query()->where('is_amazing',true)
        ->orderBy('discount','DESC')->paginate(12);

        return ProductListResource::collection($products);
    }

    // get searched products paginated
    public static function getSearchedProducts($search){

        $products = Product::query()->where('title','like','%'.$search.'%')
        ->orWhere('title_en','like','%'.$search.'%')
        ->orWhere('description','like','%'.$search.'%')
        ->paginate(12);

        return ProductListResource::collection($products);
    }

    // get newest products paginated
    public static function getNewestProducts(){

        $products= Product::query()->latest()->paginate(12);

        return ProductListResource::collection($products);
    }

    // get most expensive products paginated
    public static function getMostExpensiveProducts(){

        $products= Product::query()->orderBy('price','DESC')->paginate(12);

        return ProductListResource::collection($products);
    }

    // get cheapest products paginated
    public static function getCheapestProducts(){

        $products= Product::query()->orderBy('price','ASC')->paginate(12);

        return ProductListResource::collection($products);
    }

    //get six amazing products for home page
    public static function getSixAmazingProducts(){

        $products= Product::query()->where('is_amazing',true)
        ->orderBy('discount','DESC')->take(6)->get();

        return ProductListResource::collection($products);
    }

    // get six newest products for home page
    public static function getSixNewestProducts(){

        $products= Product::query()->latest()->take(6)->get();

        return ProductListResource::collection($products);
    }


}
