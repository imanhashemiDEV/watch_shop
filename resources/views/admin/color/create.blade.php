@extends('admin.layouts.master')
@include('admin.partials.header',[$title='ایجاد تگ'])
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
                    <h6 class="card-title">ایجاد رنگ</h6>
                    <form method="post" action="{{route('colors.store')}}">
                        @csrf
                        <div class="form-group row">
                            <label  class="col-sm-2 col-form-label">نام رنگ</label>
                            <div class="col-sm-10">
                                <input type="text" class="text-left form-control" dir="ltr" name="title" value="{{old('title')}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">کد رنگ</label>
                            <div class="col-sm-10 input-group sample-selector colorpicker-element">
                                <input type="text" value="red" name="code" class="text-left form-control" dir="ltr">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i style="background-color: rgb(255, 0, 0);"></i></span>
                                </div>
                            </div>
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
