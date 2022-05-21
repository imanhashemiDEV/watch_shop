@extends('admin.layouts.master')
@include('admin.partials.header',[$title=' ایجاد لیست تصاویر'])
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
                    <h6 class="card-title"> ایجاد لیست تصاویر </h6>
                    <div class="row">
                        <div class="col-12">
                            <div class="card card-primary">
                                <form role="form" class="border dropzone border-primary " method="POST" action="{{route('store.product.gallery',$product->id)}}">
                                    @csrf
                                    <div class="card-body">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="fallback">
                                                    <input type="file" name="file" multiple>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="mt-5 row">
                        @foreach($product->galleries as $gallery)
                            <div class="p-2 border col-md-4 d-flex justify-content-around align-items-center border-danger">
                                <img src="{{url('/images/products/'.$gallery->image)}}" style="width: 100px;" alt="">
                                <form action="{{route('delete.product.gallery',$gallery->id)}}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <div>
                                        <label>حذف عکس</label>
                                        <button type="submit" class="btn btn-info"><i class="fa fa-trash"></i></button>
                                    </div>
                                </form>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- end::main content -->
@endsection

