@extends('admin.layouts.master')
@include('admin.partials.header',[$title='اتصال نقش با مجوز'])
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
                    <h6 class="card-title">اتصال نقش با مجوز</h6>
                    <form role="form" method="POST" action="{{route('store.role.permission',$role->id)}}" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <label>{{$role->name}}</label>
                            @foreach($permissions as $permission)
                                <div class="form-check border">
                                    <input @if($role->hasPermissionTo($permission->name)) checked  @endif type="checkbox" name="permissions[]" value="{{$permission->name}}" class="form-check-input" id="exampleCheck1">
                                    <label class="form-check-label" for="exampleCheck1">{{$permission->name}}</label>
                                </div>
                            @endforeach
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">ثبت</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <!-- end::main content -->
@endsection
