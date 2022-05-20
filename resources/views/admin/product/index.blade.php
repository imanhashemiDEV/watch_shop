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
                            <th class="text-center align-middle text-primary">ردیف</th>
                            <th class="text-center align-middle text-primary">عکس</th>
                            <th class="text-center align-middle text-primary">عنوان</th>
                            <th class="text-center align-middle text-primary"> قیمت</th>
                            <th class="text-center align-middle text-primary"> تعداد محصول</th>
                            <th class="text-center align-middle text-primary">دسته بندی</th>
                            <th class="text-center align-middle text-primary">برند </th>
                            <th class="text-center align-middle text-primary">ویژگی ها</th>
                            <th class="text-center align-middle text-primary">گالری</th>
                            <th class="text-center align-middle text-primary">تاریخ ایجاد</th>
                            <th class="text-center align-middle text-primary">ویرایش</th>
                            <th class="text-center align-middle text-primary">حذف</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $index => $product)
                            <tr>
                                <td class="text-center align-middle">{{$products->firstItem() + $index}}</td>
                                <td class="text-center align-middle">
                                    <figure class="avatar avatar-sm">
                                        <img src="{{ url('images/product/small/' . $product->image) }}"
                                            class="rounded-circle" alt="image">
                                    </figure>
                                </td>
                                <td class="text-center align-middle">{{$product->title}}</td>
                                <td class="text-center align-middle">{{number_format($product->price)}}</td>
                                <td class="text-center align-middle">{{$product->product_count}}</td>
                                <td class="text-center align-middle">{{$product->category->title}}</td>
                                <td class="text-center align-middle">{{$product->brand->title}}</td>
                                <td class="text-center align-middle">
                                    <a class="btn btn-outline-info" href="{{route('create.product.properties',$product->id)}}">
                                        ویژگی ها
                                   </a>
                                </td>
                                <td class="text-center align-middle">
                                    <a class="btn btn-outline-info" href="{{route('create.product.gallery',$product->id)}}">
                                        گالری
                                   </a>
                                </td>
                                <td class="text-center align-middle">{{\Hekmatinasser\Verta\Verta::instance($product->created_at)->format('%B %d، %Y')}}</td>
                                <td class="text-center align-middle">
                                    <a class="btn btn-outline-info" href="{{route('products.edit',$product->id)}}">
                                         ویرایش
                                    </a>
                                </td>
                                <td class="text-center align-middle">
                                    <form action="{{ route('products.destroy', $product->id) }}" method="post" >
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
                        {{$products->appends(Request::except('page'))->links()}}
                    </div>
                </div>
            </div>
        </div>

    </main>
    <!-- end::main content -->
@endsection

