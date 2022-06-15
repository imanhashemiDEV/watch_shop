<?php

namespace App\Http\Livewire\Admin;

use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;

class Orders extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search = '';

    protected $queryString = [
        'search' => ['except' => ''],
    ];

    protected $listeners = [
        'refreshComponent' => '$refresh',
        'destroyOrder',
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function destroyOrder($id)
    {
        Order::destroy($id);
        $this->emit('refreshComponent');
    }

    public function deleteOrder($id)
    {
        $this->dispatchBrowserEvent('deleteOrder', ['id'=>$id]);
    }

    public function render()
    {
        $orders = Order::query()->orderBy('id', 'DESC')
            ->where('code', 'like', '%'.$this->search.'%')
            ->orWhereHas('user', function ($q) {
                return $q->where('name', 'like', '%'.$this->search.'%')
                          ->where('mobile', 'like', '%'.$this->search.'%');
            })->paginate(30);

        return view('livewire.admin.orders', compact('orders'));
    }
}
