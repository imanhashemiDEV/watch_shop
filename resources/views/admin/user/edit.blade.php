@extends('admin.layouts.master')
@include('admin.partials.header',[$title='ویرایش کاربر'])
@section('content')
    <!-- begin::main content -->
    <main class="main-content">
        @if(Session::has('message'))
            <div class="alert alert-info">
                <div>{{session('message')}}</div>
            </div>
        @endif
        @include('admin.partials.errors')
        <div class="card">
            <div class="card-body">
                <div class="container">
                    <h4 class="card-title">ویرایش کاربر</h4>
                    <div class="row">
                        <div class="col-md-9">
                            <form role="form" method="POST" action="{{route('users.update', $user->id)}}" enctype="multipart/form-data">
                                @csrf
                                @method('patch')
                                <div class="form-group row">
                                    <label  class="col-sm-2 col-form-label">نام و نام خانوادگی</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control text-left" placeholder="نام و نام خانوادگی" dir="rtl" name="name" value="{{$user->name}}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label  class="col-sm-2 col-form-label">ایمیل</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control text-left" placeholder="ایمیل" dir="rtl" name="email" value="{{$user->email}}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label  class="col-sm-2 col-form-label">موبایل</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control text-left" placeholder="موبایل" dir="rtl" name="mobile" value="{{$user->mobile}}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label  class="col-sm-2 col-form-label">پسورد</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control text-left" placeholder="پسورد" dir="rtl" name="password">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label  class="col-sm-2 col-form-label">واتس اپ</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control text-left"  dir="rtl" name="whatsapp" value="{{$user->whatsapp}}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label  class="col-sm-2 col-form-label">تلگرام</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control text-left"  dir="rtl" name="telegram" value="{{$user->telegram}}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label  class="col-sm-2 col-form-label">اینستاگرام</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control text-left"  dir="rtl" name="instagram" value="{{$user->instagram}}">
                                    </div>
                                </div>
                                <div class="form-group row custom-file col-sm-10 offset-2">
                                    <label class="custom-file-label" for="customFile">انتخاب عکس  </label>
                                    <input type="file" class="custom-file-input" id="customFile" name='image'>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-primary">ویرایش</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="overflow-hidden rounded col-md-3">
                            <img src="{{url('images/user_profile/big').'/'. $user->profile_photo_path}}" class="rounded img-fluid">
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>
    <!-- end::main content -->
@endsection
