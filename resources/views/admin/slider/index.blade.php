@extends('admin.layouts.master')
@include('admin.partials.header',[$title='اسلاید ها'])
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
                            <th class="text-center align-middle text-primary">ردیف</th>
                            <th class="text-center align-middle text-primary">عکس</th>
                            <th class="text-center align-middle text-primary">عنوان </th>
                            <th class="text-center align-middle text-primary">ویرایش</th>
                            <th class="text-center align-middle text-primary">حذف</th>
                            <th class="text-center align-middle text-primary">تاریخ ایجاد</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($sliders as $slider)
                            <tr>
                                <td class="text-center align-middle">{{$i++}}</td>
                                <td class="text-center align-middle">
                                    <figure class="avatar avatar-sm">
                                        <img src="{{ url('images/category/small/' . $slider->image) }}"
                                            class="rounded-circle" alt="image">
                                    </figure>
                                </td>
                                <td class="text-center align-middle">{{$slider->title}}</td>
                                <td class="text-center align-middle">
                                    <a class="btn btn-outline-info" href="{{route('sliders.edit',$slider->id)}}">
                                         ویرایش
                                    </a>
                                </td>
                                <td class="text-center align-middle">
                                    <a class="btn btn-outline-info" href="{{route('sliders.edit',$slider->id)}}">
                                         ویرایش
                                    </a>
                                </td>
                                <td class="text-center align-middle">{{\Hekmatinasser\Verta\Verta::instance($slider->created_at)->format('%B %d، %Y')}}</td>

                            </tr>
                        @endforeach
                    </table>
                    <div style="margin: 40px !important;" class="pagination pagination-rounded pagination-sm d-flex justify-content-center">
                        {{$sliders->appends(Request::except('page'))->links()}}
                    </div>
                </div>
            </div>
        </div>

    </main>
    <!-- end::main content -->
@endsection

