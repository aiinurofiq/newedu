<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Learning;
use Livewire\WithPagination;

class LearnAll extends Component
{
    use WithPagination;

    public $search = '';

    public function render()
    {
        return view('livewire.learn-all');
    }
}
