<?php

namespace App\Http\Livewire;

use App\Models\Category;
use Livewire\Component;

class KnowAll extends Component
{
    public $categories;
    public function mount(){
        $this->categories = Category::get();
    }
    public function render()
    {
        return view('livewire.know-all');
    }
}
