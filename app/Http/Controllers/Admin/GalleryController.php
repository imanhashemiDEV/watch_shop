<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{

    public function index()
    {
        $galleries = Gallery::query()->paginate(20);
        return view('admin.gallery.index', compact('galleries'));
    }


    public function create()
    {
        return view('admin.gallery.create');
    }


    public function store(Request $request)
    {
        if($request->hasFile('file')){
            $image = $request->file('file');
            $fileName = time().'-'.$image->getClientOriginalName();
            $image->move(public_path('images/gallery'), $fileName);
        }

        Gallery::query()->create([
            'url'=>$fileName,
        ]);

        return redirect()->back()->with('message','عکس با موفقیت ثبت شد');
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        $gallery = Gallery::query()->find($id);
        $path = public_path()."/images/gallery/".$gallery->url;
        unlink($path);
        $gallery->delete();

        return redirect()->back();
    }

}
