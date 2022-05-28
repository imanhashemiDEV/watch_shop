<div class="table-responsive" tabindex="8">
    <div class="form-group row">
        <label  class="col-sm-2 col-form-label">عنوان جستجو</label>
        <div class="col-sm-10">
            <input type="text" class="form-control text-left"  dir="rtl" wire:model="search" >
        </div>
    </div>
    <table class="table table-striped table-hover overflow-auto">
        <thead class="thead-light">
        <tr>
            <th class="text-center align-middle text-primary">ردیف</th>
            <th class="text-center align-middle text-primary">نام محصول</th>
            <th class="text-center align-middle text-primary"> قیمت بدون تخفیف </th>
            <th class="text-center align-middle text-primary"> قیمت با تخفیف</th>
            <th class="text-center align-middle text-primary"> تعداد</th>
            <th class="text-center align-middle text-primary"> وضعیت تحویل</th>
            <th class="text-center align-middle text-primary">تاریخ تراکنش</th>
        </tr>
        </thead>
        <tbody>
        @foreach($orderDetails as $index => $order)
            <tr>
                <td class="text-center align-middle">{{ $index + 1}}</td>
                <td class="text-center align-middle">{{$order->product->title}}</td>
                <td class="text-center align-middle">{{number_format($order->price)}} تومان</td>
                <td class="text-center align-middle">{{number_format($order->discount_price)}} تومان</td>
                <td class="text-center align-middle">{{$order->count}}</td>
                <td class="text-center align-middle" wire:click="changeStatus({{ $order->id }})">
                    @if ($order->status ===\App\Enums\OrderStatus::Cancelled->value)
                        <span class="cursor-pointer badge badge-danger">مرجوع شده</span>
                    @elseif ($order->status ==\App\Enums\OrderStatus::Received->value)
                        <span class="cursor-pointer badge badge-success">تحویل شده</span>
                    @else
                        <span class="cursor-pointer badge badge-info">در حال پردازش</span>
                    @endif
                </td>
                <td class="text-center align-middle">{{\Hekmatinasser\Verta\Verta::instance($order->created_at)->format('%B %d، %Y')}}</td>
            </tr>
        @endforeach
        <tr>
            <td colspan="2" class="text-center align-middle "> جمع کل خرید</td>
            <td colspan="5" class="text-center align-middle"> {{number_format($total)}} تومان</td>
        </tr>
    </table>
</div>
