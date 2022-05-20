@extends('admin.layouts.master')
@include('admin.partials.header',[$title='لیست گروه بندی'])
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

        <div class="card">
            <div class="card-body">
                <div class="table-responsive" tabindex="8" style="overflow: hidden; outline: none;">
                    <table class="table table-striped table-bordered table-hover">
                        <thead class="thead-light">
                        <tr>
                            <th class="text-center align-middle text-primary">ردیف</th>
                            <th class="text-center align-middle text-primary">عنوان گروه بندی</th>
                            {{-- <th class="text-center align-middle text-primary">دسته بندی</th> --}}
                            <th class="text-center align-middle text-primary">تاریخ ایجاد</th>
                            <th class="text-center align-middle text-primary">ویرایش</th>
                            <th class="text-center align-middle text-primary">حذف</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($property_groups as $index => $property_group)
                            <tr>
                                <td class="text-center align-middle">{{$property_groups->firstItem() + $index  }}</td>
                                <td class="text-center align-middle">{{$property_group->title}}</td>
                                {{-- <td class="text-center align-middle">{{$property_group->category->title}}</td> --}}
                                <td class="text-center align-middle">{{\Hekmatinasser\Verta\Verta::instance($property_group->created_at)->format('%B %d، %Y')}}</td>
                                <td class="text-center align-middle">
                                    <a class="btn btn-outline-info" href="{{route('property_group.edit',$property_group->id)}}">
                                         ویرایش
                                    </a>
                                </td>
                                <td class="text-center align-middle">
                                    <form action="{{ route('property_group.destroy', $property_group->id) }}" method="post" >
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-outline-danger">
                                            حذف
                                       </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                    <div style="margin: 40px !important;" class="pagination pagination-rounded pagination-sm d-flex justify-content-center">
                        {{$property_groups->appends(Request::except('page'))->links()}}
                    </div>
                </div>
            </div>
        </div>

    </main>
    <!-- end::main content -->
@endsection

