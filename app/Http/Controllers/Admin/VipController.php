<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class VipController extends Controller
{

    public function index()
    {
        $vips = Vip::query()->orderBy('id', 'DESC')->paginate(15);
        return view('admin.vip.index', compact('vips'));
    }


    public function create()
    {
        return view('admin.vip.create');
    }


    public function store(Request $request)
    {
        $vips = new Vip();

        $vips->title = $request->input('title');
        $vips->price = $request->input('price');
        $vips->days = $request->input('days');
        $vips->type = $request->input('type');
        $vips->visible = $request->input('visible');
        $vips->save();
        Session::flash('add_vips', ' عضویت ویژه با موفقیت اضافه شد');
        return redirect('/admin/vips');
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $vip = Vip::findOrFail($id);
        return view('admin.vip.edit', compact('vip'));
    }


    public function update(Request $request, $id)
    {
        $vips = Vip::findOrFail($id);

        $vips->title = $request->input('title');
        $vips->price = $request->input('price');
        $vips->pre_price = $request->input('pre_price');
        $vips->days = $request->input('days');
        $vips->visible = $request->input('visible');
        $vips->type = $request->input('type');
        $vips->save();

        Session::flash('update_vips', 'عضویت ویژه با موفقیت ویرایش شد');
        return redirect('/admin/vips');
    }


    public function destroy($id)
    {
//        $vip = Vip::destroy($id);
//        Session::flash('delete_vips', 'عضویت ویژه با موفقیت حذف شد');
//        return redirect('admin/vips');
    }


}
