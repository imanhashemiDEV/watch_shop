<div class="table-responsive" tabindex="8" style="overflow: hidden; outline: none;">
    <table class="table table-striped table-bordered table-hover">
        <thead class="thead-light">
            <tr>
                <th class="text-center align-middle text-primary">ردیف</th>
                <th class="text-center align-middle text-primary">خریدار</th>
                <th class="text-center align-middle text-primary"> قیمت کل</th>
                <th class="text-center align-middle text-primary"> لیست محصولات</th>
                <th class="text-center align-middle text-primary"> کد پیگیری</th>
                <th class="text-center align-middle text-primary"> وضعیت پرداخت </th>
                <th class="text-center align-middle text-primary">تاریخ تراکنش</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $index => $order)
            <tr>
                <td class="text-center align-middle">{{$orders->firstItem() + $index}}</td>
                <td class="text-center align-middle">{{$order->user->name}}</td>
                <td class="text-center align-middle">{{number_format($order->total_price)}} تومان</td>
                <td class="text-center align-middle">
                    <a class="btn btn-outline-info" href="{{route('order.details',$order->id)}}">
                        لیست محصولات
                    </a>
                </td>
                <td class="text-center align-middle">{{$order->code}}</td>
                <td class="text-center align-middle">
                    @if ($order->status =='failed')
                    <span class="cursor-pointer badge badge-danger">ناموفق</span>
                    @elseif ($order->status =='success')
                    <span class="cursor-pointer badge badge-success">موفق</span>
                    @else
                    <span class="cursor-pointer badge badge-info">ارجاع به بانک</span>
                    @endif
                </td>
                <td class="text-center align-middle">
                    {{\Hekmatinasser\Verta\Verta::instance($order->created_at)->format('%B %d، %Y')}}</td>
            </tr>
            @endforeach
    </table>
    <div style="margin: 40px !important;"
        class="pagination pagination-rounded pagination-sm d-flex justify-content-center">
        {{$orders->appends(Request::except('page'))->links()}}
    </div>
</div>
