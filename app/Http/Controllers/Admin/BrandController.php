<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BrandRequest;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index()
    {
        return  view('admin.brand.index');
    }

    public function create()
    {
        return view('admin.brand.create');
    }

    public function store(BrandRequest $request)
    {
        $image = Brand::saveImage($request->image);

        $Brand = Brand::query()->create([
            'title' => $request->input('title'),
            'image' => $image,
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
        $brand = Brand::query()->find($id);

        if ($request->image) {
            $image = Brand::saveImage($request->image);
        } else {
            $image = $brand->image;
        }

        $brand->update([
            'title' => $request->input('title'),
            'image' => $image,
        ]);

        return redirect()->route('brands.index')->with('message', 'برند با موفقیت ویرایش شد');
    }

    public function destroy($id)
    {
        Brand::destroy($id);

        return redirect()->back();
    }
}
