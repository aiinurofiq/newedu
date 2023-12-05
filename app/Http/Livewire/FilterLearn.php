<?php

namespace App\Http\Livewire;

use App\Models\Categorylearn;
use Livewire\Component;

class FilterLearn extends Component
{
    public $category = '';
    public $query = '';
    public function render()
    {
        $categorylearns = Categorylearn::get();
        return view('livewire.filter-learn',['categorylearns' => $categorylearns]);
    }

    public function filter(){
        $this->emitTo('show-learn', 'reloadLearn', $this->category, $this->query);
    }
}
