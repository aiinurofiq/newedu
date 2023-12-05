<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Knowledge;
use App\Models\Subdivisi;
use App\Models\Wilayahsungai;
use Livewire\Component;

class FilterKnow extends Component
{
    public $category = '', $ws = '', $divisi = '', $year = '';
    public $categories,$wsall,$divisiall,$yearall;
    public $query = '';
    public function mount(){
        $this->wsall = Wilayahsungai::get();
        $this->divisiall = Subdivisi::get();
        $this->categories = Category::get();
        $this->yearall = Knowledge::groupBy('year')->pluck('year');
    }
    public function render()
    {
        return view('livewire.filter-know', ['knows' => $this->data()]);
    }

    public function data()
    {
        $cari = $this->query;
        $category = $this->category;
        $ws = $this->ws;
        $divisi = $this->divisi;
        $year = $this->year;
        return Knowledge::where('status', 1)->where('ispublic', 1)->when($cari, function ($query) use ($cari) {
            return $query->where('title', 'like', '%' . $cari . '%');
        })->when($category, function ($query) use ($category) {
            return $query->where('category_id', $category);
        })->when($ws, function ($query) use ($ws) {
            return $query->where('wilayahsungai_id', $ws);
        })->when($divisi, function ($query) use ($divisi) {
            return $query->where('divisi_id', $divisi);
        })->when($year, function ($query) use ($year) {
            return $query->where('year', $year);
        })->get();
    }

    public function filter()
    {
        $this->emitTo('show-know', 'reloadKnow', $this->category, $this->query);
        // $knows = Knowledge::query();
        // $temp = $this->category;
        // $temp2 = $this->query;

        // if ($temp) {
        //     $knows->whereHas('category', function ($query) use ($temp) {
        //         $query->where('name', $temp);
        //     });
        // }

        // if ($temp2) {
        //     $knows->whereHas('title', function ($query) use ($temp2) {
        //         $query->where('title', 'like', '%' . $temp2 . '%');
        //     });
        //     // $knows->where('title', 'like', '%' . $temp2 . '%');
        // }

        // $knows = $knows->get();
    }
}
