@extends('admin.layouts.master')
@include('admin.partials.header',[$title='ایجاد محصول'])
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
                <h6 class="card-title">ایجاد محصول </h6>
                <form method="post" action="{{route('products.store')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">عنوان محصول</label>
                        <div class="col-sm-9">
                            <input type="text" class="text-left form-control" dir="rtl" name="title"
                                value="{{old('title')}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">عنوان انگلیسی</label>
                        <div class="col-sm-9">
                            <input type="text" class="text-left form-control" dir="rtl" name="title_en"
                                value="{{old('title_en')}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label"> قیمت محصول بر حسب تومان</label>
                        <div class="col-sm-9">
                            <input type="number" class="text-left form-control" dir="rtl" name="price"
                                value="{{old('price')}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label"> درصد تخفیف</label>
                        <div class="col-sm-9">
                            <input type="number" class="text-left form-control" dir="rtl" name="discount"
                                value="{{old('discount')}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-3">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="customCheck" name="is_special">
                                <label class="custom-control-label" for="customCheck"> فروش شگفت انگیز </label>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <label class="col-form-label"> تاریخ انقضای شگفت انگیز</label>
                        </div>
                        <div class="col-sm-6">
                            <input type="text" id="tarikh" class="text-left form-control" dir="rtl"
                                name="special_expiration">
                        </div>
                    </div>
                    <div class="form-group row" data-select2-id="23">
                        <label class="col-sm-3 col-form-label">انتخاب رنگ</label>
                        <div class="col-sm-9">
                            <select class="form-select" multiple="" name="colors[]"
                                style="width: 100%;text-align: right" style="width: 100%;" data-select2-id="1"
                                tabindex="-1" aria-hidden="true">
                                @foreach($colors as $key=>$value)
                                <option style="" value="{{$key}}">{{$value}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label"> گارانتی محصول</label>
                        <div class="col-sm-9">
                            <input type="text" class="text-left form-control" dir="rtl" name="guaranty"
                                value="{{old('guaranty')}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label"> تعداد محصول</label>
                        <div class="col-sm-9">
                            <input type="number" class="text-left form-control" dir="rtl" name="product_count"
                                value="{{old('product_count')}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label"> توضیحات محصول</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" id="description" name="description" cols="30" rows="10">
                                    {{old('description')}}
                                </textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">  نقد و بررسی</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" id="discussion" name="discussion" cols="30" rows="10">
                                    {{old('discussion')}}
                                </textarea>
                        </div>
                    </div>
                    <div class="form-group row" data-select2-id="24">
                        <label class="col-sm-3 col-form-label">انتخاب برند</label>
                        <div class="col-sm-9">
                            <select class="form-select" name="brand_id" style="width: 100%;text-align: right"
                                style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                @foreach($brands as $key=>$value)
                                <option value="{{$key}}">{{$value}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row" data-select2-id="23">
                        <label class="col-sm-3 col-form-label">دسته پدر</label>
                        <div class="col-sm-9">
                            <select class="form-select" name="category_id" style="width: 100%;" data-select2-id="1"
                                tabindex="-1" aria-hidden="true">
                                @foreach($categories as $key=>$value)
                                <option value="{{$key}}">{{$value}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row custom-file col-sm-9 offset-3">
                        <label class="custom-file-label" for="customFile">انتخاب عکس </label>
                        <input type="file" class="custom-file-input" id="customFile" name='image'>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-9">
                            <button type="submit" class="btn btn-primary">ثبت</button>
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


            var customOptions = {
                placeholder: "روز / ماه / سال"
                , twodigit: false
                , closeAfterSelect: true
                , nextButtonIcon: "fa fa-arrow-circle-right"
                , previousButtonIcon: "fa fa-arrow-circle-left"
                , buttonsColor: "#5867dd"
                , markToday: true
                , markHolidays: true
                , highlightSelectedDay: true
                , sync: true
                , gotoToday: true
            }
            kamaDatepicker('tarikh', customOptions);

            $('#customFile').on('change', function () {
                //get the file name
                var fileName = $(this).val().replace('C:\\fakepath\\', " ")
                //replace the "Choose a file" label
                $(this).next('.custom-file-label').html(fileName);
            })

        });

        $('.form-select').select2();

    ClassicEditor.create( document.querySelector( '#description' ), {
            language:'fa'
        } );
    ClassicEditor.create( document.querySelector( '#discussion' ), {
        language:'fa'
    } );

</script>
@endsection
