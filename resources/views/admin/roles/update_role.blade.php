@extends('admin.layouts.master')
@include('admin.partials.header',[$title='ایجاد نقش'])
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
                    <form role="form" method="POST" action="{{route('roles.update',$role->id)}}"
                          enctype="multipart/form-data">
                        @csrf
                        @method('patch')
                        <div class="card-body">
                            <div class="form-group">
                                <label>عنوان نقش</label>
                                <input type="text" class="form-control" name="name"  value="{{$role->name}}" placeholder="عنوان نقش را وارد کنید">
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">ویرایش</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <!-- end::main content -->
@endsection
