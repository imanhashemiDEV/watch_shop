@extends('admin.layouts.master')
@include('admin.partials.header',[$title='ویرایش گروه بندی'])
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
                    <h6 class="card-title">گروه بندی</h6>
                    <form method="post" action="{{route('property_group.update', $property_group->id)}}" enctype="multipart/form-data">
                        @csrf
                        @method('patch')
                        <div class="form-group row">
                            <label  class="col-sm-2 col-form-label">نام گروه بندی</label>
                            <div class="col-sm-10">
                                <input type="text" class="text-left form-control" value="{{$property_group->title}}" dir="rtl" name="title">
                            </div>
                        </div>
                        {{-- <div class="form-group row" data-select2-id="23">
                            <label class="col-sm-2 col-form-label">عنوان دسته بندی</label>
                            <div class="col-sm-10">
                                <select class="form-select" name="category_id" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                    @foreach($categories as $key=>$value)
                                        @if($property_group->category_id==$key)
                                            <option selected="selected" value="{{$key}}">{{$value}}</option>
                                        @else
                                            <option value="{{$key}}">{{$value}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div> --}}
                        <div class="form-group row">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">ویرایش</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </main>
    <!-- end::main content -->
@endsection
@section('scripts')
    <script>

        $(document).ready(function () {

            $('#customFile').on('change', function () {
                //get the file name
                var fileName = $(this).val().replace('C:\\fakepath\\', " ")
                //replace the "Choose a file" label
                $(this).next('.custom-file-label').html(fileName);
            })

        });

        $('.form-select').select2();

    </script>
@endsection
