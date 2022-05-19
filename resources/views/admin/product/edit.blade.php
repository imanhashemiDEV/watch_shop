@extends('admin.layouts.master')
@include('admin.partials.header',[$title='ویرایش محصول'])
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
                <h6 class="card-title">ویرایش محصول</h6>
                <div class="row">
                    <div class="col-md-9">
                        <form method="post" action="{{route('products.update', $product->id)}}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('patch')
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">عنوان محصول</label>
                                <div class="col-sm-9">
                                    <input type="text" class="text-left form-control" dir="rtl" name="title"
                                        value="{{$product->title}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">عنوان انگلیسی</label>
                                <div class="col-sm-9">
                                    <input type="text" class="text-left form-control" dir="rtl" name="title_en"
                                        value="{{$product->title_en}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label"> قیمت محصول بر حسب تومان</label>
                                <div class="col-sm-9">
                                    <input type="number" class="text-left form-control" dir="rtl" name="price"
                                        value="{{$product->price}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label"> درصد تخفیف</label>
                                <div class="col-sm-9">
                                    <input type="number" class="text-left form-control" dir="rtl" name="discount"
                                        value="{{$product->discount}}">
                                </div>
                            </div>
                            <div class="form-group row" data-select2-id="23">
                                <label class="col-sm-3 col-form-label">انتخاب رنگ</label>
                                <div class="col-sm-9">
                                    <select class="form-select" multiple="" name="colors[]" style="width: 100%;text-align: right"
                                        style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                        @foreach($colors as $key=>$value)
                                            @if(in_array($key,$product->colors()->pluck('id')->toArray()))
                                                <option selected value="{{$key}}">{{$value}}</option>
                                            @else
                                                <option value="{{$key}}">{{$value}}</option>
                                            @endif

                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label"> گارانتی محصول</label>
                                <div class="col-sm-9">
                                    <input type="text" class="text-left form-control" dir="rtl" name="guaranty"
                                        value="{{$product->guaranty}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label"> تعداد محصول</label>
                                <div class="col-sm-9">
                                    <input type="number" class="text-left form-control" dir="rtl" name="product_count"
                                        value="{{$product->product_count}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label"> توضیحات محصول</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" name="description" cols="30" rows="10">
                                            {{$product->description}}
                                        </textarea>
                                </div>
                            </div>
                            <div class="form-group row" data-select2-id="24">
                                <label class="col-sm-3 col-form-label">انتخاب برند</label>
                                <div class="col-sm-9">
                                    <select class="form-select" name="brand_id" style="width: 100%;text-align: right"
                                        style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                        @foreach($brands as $key=>$value)
                                        @if($product->brand_id==$key)
                                        <option selected="selected" value="{{$key}}">{{$value}}</option>
                                        @else
                                        <option value="{{$key}}">{{$value}}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row" data-select2-id="23">
                                <label class="col-sm-3 col-form-label">دسته پدر</label>
                                <div class="col-sm-9">
                                    <select class="form-select" name="category_id" style="width: 100%;"
                                        data-select2-id="1" tabindex="-1" aria-hidden="true">
                                        @foreach($categories as $key=>$value)
                                        @if($product->category_id==$key)
                                        <option selected="selected" value="{{$key}}">{{$value}}</option>
                                        @else
                                        <option value="{{$key}}">{{$value}}</option>
                                        @endif
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
                                    <button type="submit" class="btn btn-primary">ویرایش</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="overflow-hidden rounded col-md-3">
                        <img src="{{ $product->image ?  url('images/product/big').'/'. $product->image : "
                            http://www.placehold.it/400" }}" class="rounded img-fluid">
                    </div>
                </div>
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
