<?php

namespace App\Http\Livewire\Admin;

use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;

class Orders extends Component
{
    use WithPagination;

    protected $paginationTheme='bootstrap';

    public function render()
    {
        $orders = Order::query()->paginate(20);
        return view('livewire.admin.orders', compact('orders'));
    }
}
