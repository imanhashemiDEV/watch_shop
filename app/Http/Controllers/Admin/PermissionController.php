<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PermissionRequest;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index()
    {
        return  view('admin.permissions.permissions');
    }

    public function create()
    {
        return view('admin.permissions.create_permission');
    }

    public function store(PermissionRequest $request)
    {
        Permission::query()->create([
            'name' => $request->name,
        ]);

        return redirect()->back()->with('message', 'مجوز با موفقیت ثبت شد');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $permission = Permission::query()->find($id);

        return view('admin.permissions.update_permission', compact('permission'));
    }

    public function update(PermissionRequest $request, $id)
    {
        Permission::query()->find($id)->update([
            'name' => $request->name,
        ]);

        return redirect()->route('permissions.index')->with('message', 'مجوز با موفقیت ویرایش شد');
    }

    public function destroy($id)
    {
        Permission::destroy($id);

        return redirect()->back()->with('message', 'مجوز با موفقیت حذف شد');
    }
}
