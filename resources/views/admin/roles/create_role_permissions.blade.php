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
                            <div class="row">
                                <div class="col-6 offset-3">
                                    <div class="list-group" id="list-tab" role="tablist">
                                        <a class="list-group-item list-group-item-action active" id="list-profile-list" data-toggle="list" href="#" role="tab">   مجوزها برای نقش  {{$role->name}} </a>
                                        @foreach($permissions as $permission)
                                            <div class="form-check  d-flex align-items-center">
                                                <input @if($role->hasPermissionTo($permission->name)) checked  @endif type="checkbox" name="permissions[]" value="{{$permission->name}}" class="form-check-input" id="exampleCheck1">
                                                <a class="list-group-item list-group-item-action mt-2" for="exampleCheck1" data-toggle="list" href="#" role="tab">{{$permission->name}}</a>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
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
