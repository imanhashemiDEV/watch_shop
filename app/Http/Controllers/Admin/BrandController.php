<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::query()->paginate(10);
        return  view('admin.brand.index', compact('brands'));
    }

    public function create()
    {
        return view('admin.brand.create');
    }

    public function store(Request $request)
    {

        $image = Brand::saveImage($request->image);

        $Brand = Brand::query()->create([
            'title' => $request->input('title'),
            'image' => $image
        ]);

        return redirect()->back()->with('message', 'برند با موفقیت اضافه شد');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $brand = Brand::query()->find($id);
        return view('admin.brand.edit', compact('brand'));
    }

    public function update(Request $request, $id)
    {

        $image = Brand::saveImage($request->image);

        $brand = Brand::query()->find($id)->update([
            'title' => $request->input('title'),
            'image' => $image
        ]);

        return redirect()->route('brands.index')->with('message', 'برند با موفقیت ویرایش شد');
    }

    public function destroy($id)
    {
        Brand::destroy($id);
    }
}
