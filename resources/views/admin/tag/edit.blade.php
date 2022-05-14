@extends('admin.layouts.master')
@include('admin.partials.header',[$title='ویرایش تگ'])
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
                    <h6 class="card-title">تگ ها</h6>
                    <form method="post" action="{{route('tags.update', $tag->id)}}">
                        @csrf
                        @method('patch')
                        <div class="form-group row">
                            <label  class="col-sm-2 col-form-label">نام تگ</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control text-left" value="{{$tag->title}}" placeholder="نام دسته بندی" dir="ltr" name="title">
                            </div>
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
