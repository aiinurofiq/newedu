<?php

namespace App\Http\Livewire;

use App\Models\Detail_senda;
use App\Models\Learning;
use App\Models\Section;
use App\Models\Senda;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Quiz extends Component
{
    public $learnings, $section;
    public $tempa;
    public $action = 'R';
    public $learning_id = '';
    public function mount()
    {
    }
    public function render()
    {
        $this->tempa = Detail_senda::where('senda_id',19)->get();
        if(request()->filled('q')){
            $decrypt = decrypt(request()->q);
            $this->learning_id = $decrypt;
            $this->action = 'D';
        }
        $this->learnings = Learning::where('user_id', Auth::user()->id)->get();
        $this->section = $this->data_section();
        return view('livewire.quizlivewire')->layout('livewire.quiz');
    }
    public function update_learning_id($id)
    {
        $this->learning_id = $id;
        $this->action = 'D';
    }
    public function data_section()
    {
        return Section::where('learning_id', $this->learning_id)->first();
    }
    public function result($id)
    {
        // $temp = Senda::leftJoin('answers', 'sendas.answer_id', '=', 'answers.id')
        // ->where('sendas.quiz_id', $id)
        // ->where('sendas.user_id', Auth::user()->id)
        // ->get();
        $temp = Detail_senda::leftJoin('answers', 'detail_sendas.answer_id', '=', 'answers.id')
        ->leftJoin('sendas', 'detail_sendas.senda_id', '=', 'sendas.id')
        ->where('sendas.quiz_id', $id)
        ->where('sendas.user_id', Auth::user()->id)
        ->get();
        $total_benar = 0;
        foreach ($temp as $item) {
            if ($item['istrue'] == 1) {
                $total_benar++;
            }
        }
        // return $temp;
        if ($temp->count() > 0) {
            return $total_benar / $temp->count();
        }
        return 0;
    }
}
