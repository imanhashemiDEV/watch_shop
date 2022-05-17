<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::query()->paginate(10);
        return  view('admin.slider.index', compact('sliders'));
    }

    public function create()
    {
        return view('admin.slider.create');
    }

    public function store(Request $request)
    {

        $image = Slider::saveImage($request->image);

        $slider = Slider::query()->create([
            'title' => $request->input('title'),
            'image' => $image
        ]);

        return redirect()->back()->with('message', 'اسلایدر با موفقیت اضافه شد');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $slider = Slider::query()->find($id);
        return view('admin.slider.edit', compact('slider'));
    }

    public function update(Request $request, $id)
    {

        $image = Slider::saveImage($request->image);

        $slider = Slider::query()->find($id)->update([
            'title' => $request->input('title'),
            'image' => $image
        ]);

        return redirect()->route('sliders.index')->with('message', 'اسلایدر با موفقیت ویرایش شد');
    }

    public function destroy($id)
    {
        Slider::destroy($id);
    }
}
