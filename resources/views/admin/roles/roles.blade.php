@extends('admin.layouts.master')
@include('admin.partials.header',[$title='لیست نقش ها'])
<style>
    form {
        display: block;
        margin-top: 0;
        margin-block-end: 0;
    }
</style>
@section('content')
    <!-- begin::main content -->
    <main class="main-content">
        <div class="row">
            @if(Session::has('category'))
                <div class="alert alert-info">
                    <div>{{session('category')}}</div>
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
                            <th class="text-primary text-center align-middle">عنوان نقش</th>
                            <th class="text-primary text-center align-middle">مجوزها</th>
                            <th class="text-primary text-center align-middle">ویرایش</th>
                            <th class="text-primary text-center align-middle">حذف</th>
                            <th class="text-primary text-center align-middle">تاریخ ایجاد</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($roles as $role)
                            <tr>
                                <td class="text-center align-middle">{{$i++}}</td>
                                <td class="text-center align-middle">{{$role->name}}</td>
                                <td class="text-center align-middle">
                                    <a class="btn btn-outline-info" href="{{route('create.role.permission',$role->id)}}">
                                        مجوزها
                                    </a>
                                </td>
                                <td class="text-center align-middle">
                                    <a class="btn btn-outline-info" href="{{route('roles.edit',$role->id)}}">
                                        ویرایش
                                    </a>
                                </td>
                                <td class="text-center align-middle">
                                    <form  method="post" action="{{route('roles.destroy',$role->id)}}">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-outline-info" >حذف</button>
                                    </form>
                                </td>
                                <td class="text-center align-middle ">{{\Hekmatinasser\Verta\Verta::instance($role->created_at)->format('%B %d، %Y')}}</td>
                            </tr>
                        @endforeach
                    </table>
                    <div style="margin: 40px !important;" class="pagination pagination-rounded pagination-sm d-flex justify-content-center">
                        {{$roles->appends(Request::except('page'))->links()}}
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- end::main content -->
@endsection
