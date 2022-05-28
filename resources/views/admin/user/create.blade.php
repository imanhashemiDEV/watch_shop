@extends('admin.layouts.master')
@include('admin.partials.header',[$title='ایجاد کاربر'])
@section('content')
    <!-- begin::main content -->
    <main class="main-content">
        <div class="row">
            @if(Session::has('message'))
                <div class="alert alert-info">
                    <div>{{session('message')}}</div>
                </div>
            @endif
        </div>
        @include('admin.partials.errors')
        <div class="card">
            <div class="card-body">
                <div class="container">
                    <h6 class="card-title">ایجاد کاربر</h6>
                    <form method="post" action="{{route('users.store')}}">
                        @csrf
                        <div class="form-group row">
                            <label  class="col-sm-2 col-form-label">نام و نام خانوادگی</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control text-left" placeholder="نام و نام خانوادگی" dir="rtl" name="name" value="{{old('name')}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label  class="col-sm-2 col-form-label">ایمیل</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control text-left" placeholder="ایمیل" dir="rtl" name="email" value="{{old('email')}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label  class="col-sm-2 col-form-label">موبایل</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control text-left" placeholder="موبایل" dir="rtl" name="mobile" value="{{old('mobile')}}">
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
                                <input type="text" class="form-control text-left"  dir="rtl" name="whatsapp" value="{{old('whatsapp')}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label  class="col-sm-2 col-form-label">تلگرام</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control text-left"  dir="rtl" name="telegram" value="{{old('telegram')}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label  class="col-sm-2 col-form-label">اینستاگرام</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control text-left"  dir="rtl" name="instagram" value="{{old('instagram')}}">
                            </div>
                        </div>
                        <div class="form-group row custom-file col-sm-10 offset-2">
                            <label class="custom-file-label" for="customFile">انتخاب عکس  </label>
                            <input type="file" class="custom-file-input" id="customFile" name='image'>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">ثبت</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <!-- end::main content -->
@endsection
