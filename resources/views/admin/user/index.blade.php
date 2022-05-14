@extends('admin.layouts.master')
@include('admin.partials.header',[$title='لیست کاربران'])
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
        <?php $i=(isset($_GET['page']))  ? (($_GET['page']-1)*20)+1 : 1; ?>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive" tabindex="8" style="overflow: hidden; outline: none;">
                    <table class="table table-striped table-bordered table-hover">
                        <thead class="thead-light">
                        <tr>
                            <th class="text-primary text-center align-middle">ردیف</th>
                            <th class="text-primary text-center align-middle">نام و نام خانوادگی</th>
                            <th class="text-primary text-center align-middle">ایمیل</th>
                            <th class="text-primary text-center align-middle">موبایل</th>
                            <th class="text-primary text-center align-middle">نقش های کاربر</th>
                            <th class="text-primary text-center align-middle">ویرایش</th>
                            <th class="text-primary text-center align-middle">تاریخ ایجاد</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td class="text-center align-middle">{{$i++}}</td>
                                <td class="text-center align-middle">{{$user->name}}</td>
                                <td class="text-center align-middle">{{$user->email}}</td>
                                <td class="text-center align-middle">{{$user->mobile}}</td>
                                <td class="text-center align-middle">
                                    <a class="btn btn-outline-info" href="{{route('create.user.roles',$user->id)}}">
                                        نقش های کاربر
                                    </a>
                                </td>
                                <td class="text-center align-middle">
                                    <a class="btn btn-outline-info" href="{{route('users.edit',$user->id)}}">
                                        ویرایش
                                    </a>
                                </td>
                                <td class="text-center align-middle">{{\Hekmatinasser\Verta\Verta::instance($user->created_at)->format('%B %d، %Y')}}</td>
                            </tr>
                        @endforeach
                    </table>
                    <div style="margin: 40px !important;" class="pagination pagination-rounded pagination-sm d-flex justify-content-center">
                        {{$users->appends(Request::except('page'))->links()}}
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- end::main content -->
@endsection

