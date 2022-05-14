@extends('admin.layouts.master')
@include('admin.partials.header',[$title='ویرایش مجوز'])
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
                    <h6 class="card-title">ویرایش مجوز</h6>
                    <form role="form" method="POST" action="{{route('permissions.update',$permission->id)}}"
                          enctype="multipart/form-data">
                        @csrf
                        @method('patch')
                        <div class="card-body">
                            <div class="form-group">
                                <label>عنوان مجوز</label>
                                <input type="text" class="form-control" name="name"  value="{{$permission->name}}" placeholder="عنوان مجوز را وارد کنید">
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
