<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use App\Models\Color;
use App\Helpers\Helper;
use App\Models\Product;
use App\Models\Category;
use App\Helpers\DateShamsi;
use Illuminate\Http\Request;
use App\Models\PropertyGroup;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\EditProductRequest;

class ProductController extends Controller
{

    public function index()
    {

        return view('admin.product.index');
    }

    public function create()
    {
        $colors = Color::query()->pluck('title', 'id');
        $categories = Category::query()->pluck('title', 'id');
        $brands = Brand::query()->pluck('title', 'id');;
        return view('admin.product.create', compact('categories', 'brands', 'colors'));
    }


    public function store(ProductRequest $request)
    {

        $image = Product::saveImage($request->image);

        $product = Product::query()->create([
            'title' => $request->input('title'),
            'slug' => Helper::make_slug($request->input('title')),
            'price' => $request->input('price'),
            'discount' => $request->input('discount'),
            'description' => $request->input('description'),
            'discussion' => $request->input('discussion'),
            'title_en' => $request->input('title_en'),
            'guaranty' => $request->input('guaranty'),
            'product_count' => $request->input('product_count'),
            'is_special' => $request->input('is_special') ==="on",
            'special_expiration' => ($request->input('special_expiration') !== null) ? DateShamsi::shamsi_to_miladi($request->input('special_expiration')) : now(),
            'image' => $image,
            'category_id' => $request->input('category_id'),
            'brand_id' => $request->input('brand_id')
        ]);

        $colors = $request->colors;
        $product->colors()->attach($colors);

        return redirect()->back()->with('message', 'محصول با موفقیت ثبت شد');
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $colors = Color::query()->pluck('title', 'id');
        $product = Product::query()->find($id);
        $categories = Category::query()->pluck('title', 'id');
        $brands = Brand::query()->pluck('title', 'id');;
        return view('admin.product.edit', compact('categories', 'brands', 'product', 'colors'));
    }


    public function update(EditProductRequest $request, $id)
    {
        $product = Product::query()->find($id);

        if($request->image){
            $image = Product::saveImage($request->image);
        }else{
            $image = $product->image;
        }

        $product = Product::query()->find($id);
        $product->update([
            'title' => $request->input('title'),
            'slug' => Helper::make_slug($request->input('title')),
            'price' => $request->input('price'),
            'discount' => $request->input('discount'),
            'description' => $request->input('description'),
            'discussion' => $request->input('discussion'),
            'title_en' => $request->input('title_en'),
            'guaranty' => $request->input('guaranty'),
            'product_count' => $request->input('product_count'),
            'is_special' => $request->input('is_special') ==="on",
            'special_expiration' => ($request->input('special_expiration') !== null) ? DateShamsi::shamsi_to_miladi($request->input('special_expiration')) : now(),
            'image' => $image,
            'category_id' => $request->input('category_id'),
            'brand_id' => $request->input('brand_id')
        ]);

        $colors = $request->colors;
        $product->colors()->sync($colors);

        return redirect()->route('products.index')->with('message', 'محصول با موفقیت ویرایش شد');
    }

    public function destroy($id)
    {
        $product = Product::query()->find($id);
        $path = public_path() . "/images/product/big/" . $product->image;
        unlink($path);
        $product->delete();
        return redirect()->back();
    }

    public function createProductProperties($id)
    {
        $product = Product::query()->find($id);
        $property_groups =PropertyGroup::query()->get();
        return view('admin.product.add_properties',compact('product','property_groups'));
    }

    public function storeProductProperties(Request $request,$id)
    {
        $product =Product::query()->find($id);
        $product->properties()->sync($request->properties);

        return redirect()->back()->with('message', 'ویژگی های محصول با موفقیت ثبت شد');
    }
}
