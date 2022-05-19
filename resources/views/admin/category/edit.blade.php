@extends('admin.layouts.master')
@include('admin.partials.header',[$title='ویرایش دسته بندی'])
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
                    <h6 class="card-title">دسته بندی</h6>
                    <div class="row">
                        <div class="col-md-9">
                            <form method="post" action="{{route('categories.update', $category->id)}}" enctype="multipart/form-data">
                                @csrf
                                @method('patch')
                                <div class="form-group row">
                                    <label  class="col-sm-2 col-form-label">نام دسته بندی</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="text-left form-control" value="{{$category->title}}" placeholder="نام دسته بندی" dir="rtl" name="title">
                                    </div>
                                </div>
                                <div class="form-group row" data-select2-id="23">
                                    <label class="col-sm-2 col-form-label">دسته پدر</label>
                                    <div class="col-sm-10">
                                        <select class="js-example-basic-single select2-hidden-accessible" name="parent_id" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                            <option selected="selected" value="0">دسته اصلی</option>
                                            @foreach($categories as $key=>$value)
                                                @if($category->parent_id==$key)
                                                    <option selected="selected" value="{{$key}}">{{$value}}</option>
                                                @else
                                                    <option value="{{$key}}">{{$value}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row custom-file col-sm-10 offset-2">
                                    <label class="custom-file-label" for="customFile">انتخاب عکس دسته بندی</label>
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
                            <img src="{{ $category->image ?  url('images/category/big').'/'. $category->image : "
                                http://www.placehold.it/400" }}" class="rounded img-fluid">
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>
    <!-- end::main content -->
@endsection
