@extends('admin.layouts.master')
@include('admin.partials.header',[$title='ویرایش اسلایدر'])
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
                    <h6 class="card-title">اسلایدر </h6>
                    <form method="post" action="{{route('sliders.update', $slider->id)}}" enctype="multipart/form-data">
                        @csrf
                        @method('patch')
                        <div class="form-group row">
                            <label  class="col-sm-2 col-form-label"> عنوان اسلایدر</label>
                            <div class="col-sm-10">
                                <input type="text" class="text-left form-control" value="{{$slider->title}}" placeholder="نام دسته بندی" dir="rtl" name="title">
                            </div>
                        </div>
                        <div class="form-group row custom-file col-sm-10 offset-2">
                            <label class="custom-file-label" for="customFile">انتخاب عکس</label>
                            <input type="file" class="custom-file-input" id="customFile" name='image'>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">ویرایش</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </main>
    <!-- end::main content -->
@endsection
