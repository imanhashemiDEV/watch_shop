<?php

namespace App\Http\Livewire\Admin;

use App\Enums\OrderStatus;
use Livewire\Component;

class OrderDetail extends Component
{
    public $order_id;

    public function changeStatus($id)
    {
        $order = \App\Models\OrderDetail::query()->find($id);
        if ($order->status === OrderStatus::Processing->value) {
            $order->update([
                'status'=>OrderStatus::Received->value,
            ]);
        } elseif ($order->status === OrderStatus::Received->value) {
            $order->update([
                'status'=>OrderStatus::Cancelled->value,
            ]);
        } elseif ($order->status === OrderStatus::Cancelled->value) {
            $order->update([
                'status'=>OrderStatus::Processing->value,
            ]);
        }
    }

    public function render()
    {
        $orderDetails = \App\Models\OrderDetail::query()->where('order_id', $this->order_id)->get();
        $total = 0;
        foreach ($orderDetails as $order) {
            $total += $order->discount_price * $order->count;
        }

        return view('livewire.admin.order-detail', compact('orderDetails', 'total'));
    }
}
