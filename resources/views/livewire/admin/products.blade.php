<div class="table-responsive" tabindex="8">
    <div class="form-group row">
        <label  class="col-sm-2 col-form-label">عنوان جستجو</label>
        <div class="col-sm-10">
            <input type="text" class="form-control text-left"  dir="rtl" wire:model="search" >
        </div>
    </div>
    <table class="table table-striped table-hover table-responsive overflow-auto">
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
            <th class="text-center align-middle text-primary"> شگفت انگیز</th>
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
                <td class="text-center align-middle">
                    @if ($product->is_special)
                            <span class="badge badge-danger">شگفت انگیز</span>
                        @else
                            <span
                                class="badge badge-success">عادی</span>
                        @endif
                </td>
                <td class="text-center align-middle">
                    <a class="btn btn-outline-info" href="{{route('products.edit',$product->id)}}">
                         ویرایش
                    </a>
                </td>
                <td class="text-center align-middle">
                    <a class="btn btn-outline-danger" wire:click="deleteProduct({{$product->id}})">
                        حذف
                    </a>
                </td>
            </tr>
        @endforeach
    </table>
    <div style="margin: 40px !important;" class="pagination pagination-rounded pagination-sm d-flex justify-content-center">
        {{$products->appends(Request::except('page'))->links()}}
    </div>
</div>
