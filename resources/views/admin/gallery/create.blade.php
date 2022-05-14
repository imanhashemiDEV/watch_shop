@extends('admin.layouts.master')
@include('admin.partials.header',[$title='ایجاد لیست تصاویر'])
@section('content')
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 offset-3">

                    @if(Session::has('message'))
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                           {{session('message')}}
                        </div>
                    @endif

                    @include('admin.partials.errors')

                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">ایجاد  لیست تصاویر</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" class="dropzone border border-primary " method="POST" action="{{route('galleries.store')}}">
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
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection
