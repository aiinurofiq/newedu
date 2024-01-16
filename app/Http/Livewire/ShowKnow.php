<?php

namespace App\Http\Livewire;

use App\Models\Knowledge;
use Livewire\Component;

class ShowKnow extends Component
{
    public $knows;
    protected $listeners = ['reloadKnow'];
    public function mount()
    {
        $this->knows = Knowledge::where('status',1)->where('ispublic',1)->get();
    }

    public function render()
    {
        return view('livewire.show-know');
    }

    public function reloadKnow($category, $query)
{
    $this->knows = Knowledge::query();

    if ($category) {
        $this->knows->whereHas('category', function ($query) use ($category) {
            $query->where('name', $category);
        });
    }
    
    if ($query) {
        $this->knows->where('title', 'like', '%' . $query . '%');
    }

    $this->knows = $this->knows->get();
}
    
}
