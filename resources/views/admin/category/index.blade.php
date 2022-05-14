@extends('admin.layouts.master')
@include('admin.partials.header',[$title='لیست دسته بندی'])
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
                            <th class="text-primary text-center align-middle">عنوان دسته بندی</th>
                            <th class="text-primary text-center align-middle">عنوان اسلاگ</th>
                            <th class="text-primary text-center align-middle">دسته پدر</th>
                            <th class="text-primary text-center align-middle">تاریخ ایجاد</th>
                            <th class="text-primary text-center align-middle">ویرایش</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <td class="text-center align-middle">{{$i++}}</td>
                                <td class="text-center align-middle">{{$category->title}}</td>
                                <td class="text-center align-middle">{{$category->slug}}</td>
                                <td class="text-center align-middle">{{$category->parent->title}}</td>
                                <td class="text-center align-middle">{{\Hekmatinasser\Verta\Verta::instance($category->created_at)->format('%B %d، %Y')}}</td>
                                <td class="text-center align-middle">
                                    <a class="btn btn-outline-info" href="{{route('categories.edit',$category->id)}}">
                                         ویرایش
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                    <div style="margin: 40px !important;" class="pagination pagination-rounded pagination-sm d-flex justify-content-center">
                        {{$categories->appends(Request::except('page'))->links()}}
                    </div>
                </div>
            </div>
        </div>

    </main>
    <!-- end::main content -->
@endsection

