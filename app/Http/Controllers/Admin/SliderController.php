<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SliderRequest;
use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function index()
    {
        return  view('admin.slider.index');
    }

    public function create()
    {
        return view('admin.slider.create');
    }

    public function store(SliderRequest $request)
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
        $slider = Slider::query()->find($id);

        if($request->image){
            $image = Slider::saveImage($request->image);
        }else{
            $image = $slider->image;
        }

        $slider->update([
            'title' => $request->input('title'),
            'image' => $image
        ]);

        return redirect()->route('sliders.index')->with('message', 'اسلایدر با موفقیت ویرایش شد');
    }

    public function destroy($id)
    {
        Slider::destroy($id);

        return redirect()->back();
    }
}
