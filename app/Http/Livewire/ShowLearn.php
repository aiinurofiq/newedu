<?php

namespace App\Http\Livewire;

use App\Models\Learning;
use Livewire\Component;
use App\Http\Livewire\get;


class ShowLearn extends Component
{
    public $learns;
    protected $listeners = ['reloadLearn'];
    public function mount()
    {
        $this->learns = Learning::get();
    }
    public function render()
    {
        return view('livewire.show-learn');
    }

    public function reloadLearn($category, $query)
{
    $this->learns = Learning::query();

    if ($category) {
        $this->learns->whereHas('categorylearn', function ($query) use ($category) {
            $query->where('name', $category);
        });
    }
    if ($query) {
        $this->learns = $this->learns->where('title', 'like', '%' . $query . '%');
    }

    $this->learns = $this->learns->get();
}

}
