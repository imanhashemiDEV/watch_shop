<?php

namespace App\Http\Livewire\Admin;

use App\Models\Brand;
use App\Models\Slider;
use Livewire\Component;
use Livewire\WithPagination;

class Sliders extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search = '';

    protected $queryString = [
        'search' => ['except' => ''],
    ];

    protected $listeners = [
        'refreshComponent' => '$refresh',
        'destroySlider',
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function destroySlider($id)
    {
        Slider::destroy($id);
        $this->emit('refreshComponent');
    }

    public function deleteSlider($id)
    {
        $this->dispatchBrowserEvent('deleteSlider', ['id'=>$id]);
    }

    public function render()
    {
        $sliders = Slider::query()->orderBy('id', 'DESC')->
        where('title', 'like', '%'.$this->search.'%')->paginate(30);

        return view('livewire.admin.sliders', compact('sliders'));
    }
}
