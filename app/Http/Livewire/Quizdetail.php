<?php

namespace App\Http\Livewire;

use App\Models\Detail_senda;
use App\Models\Quiz;
use App\Models\Section;
use App\Models\Senda;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Quizdetail extends Component
{
    public $quiz, $section, $question, $answer, $time;
    // public $time = '2023-10-02 11:20:41';
    public $senda_id;
    public $status = 0;
    public $qot = '';
    public $answers = [];
    public $question_id;
    public $jwb = [];
    protected $listeners = [
        'submit' => 'submit'
    ];
    public function mount($id)
    {
        $decrypt = decrypt($id);
        // $this->quiz = $decrypt;
        $this->quiz = Quiz::findOrFail($decrypt);
        $this->section = Section::findOrFail($this->quiz->section_id);
        // $this->session = Senda::where('sendas.quiz_id', $this->quiz->id)
        //     ->where('sendas.user_id', Auth::user()->id)
        //     ->where('sendas.status', 1)->first();
        // if ($this->session->count() > 0) {
        //     $this->resume($this->session->timeout);
        // } else {
        //     $this->status = 1;
        // }
        // $this->question = $this->quiz->questions;
        // for ($i = 0; $i < $this->question->count(); $i++) {
        //     $this->question[$i]->answers;
        // }
        // $this->qot(0);

    }
    public function render()
    {
        // $decrypt = decrypt($id);
        // session()->forget('answer');
        return view('livewire.quizdetail')->layout('livewire.quiz');
    }
    public function cek()
    {
        $senda = Senda::where('sendas.quiz_id', $this->quiz->id)
            ->where('sendas.user_id', Auth::user()->id)
            ->where('sendas.status', 1)->first();
        if ($senda) {
            $this->senda_id = $senda->id;
            $this->resume($senda->timeout);
        } else {
            $this->status = 1;
        }
    }
    public function start()
    {
        date_default_timezone_set("Asia/Jakarta");
        $this->question = $this->quiz->questions;
        for ($i = 0; $i < $this->question->count(); $i++) {
            $this->question[$i]->answers;
        }
        $this->time = date('Y-m-d H:i:s', strtotime(' + ' . ($this->question->count() * 3) . ' minutes'));
        $senda_id = Senda::create([
            'quiz_id' => $this->quiz->id,
            'user_id' => Auth::user()->id,
            'timeout' => $this->time,
            'status' => 1
        ]);
        $this->senda_id = $senda_id->id;
        $this->emit('time', $this->time);
        $this->qot(0);
    }
    public function resume($time)
    {
        date_default_timezone_set("Asia/Jakarta");
        $this->question = $this->quiz->questions;
        for ($i = 0; $i < $this->question->count(); $i++) {
            $this->question[$i]->answers;
        }
        if (session('answer')) {
            $this->jwb = session('answer');
        }
        $this->time = date('Y-m-d H:i:s', strtotime($time));
        $this->emit('time', $this->time);
        $this->qot(0);
    }

    public function submit()
    {
        // Senda::where('sendas.quiz_id', $this->quiz->id)
        //     ->where('sendas.user_id', Auth::user()->id)
        //     ->delete();
        $temp = array_values($this->jwb);
        foreach ($temp as $item) {
            if ($item) {
                Detail_senda::create([
                    'senda_id' => $this->senda_id,
                    'answer_id' => $item
                ]);
            }
        }
        $senda = Senda::find($this->senda_id);
        $senda->status = '0';
        $senda->save();
        session()->forget('answer');
        return redirect()->to('my-quiz?q=' . encrypt($this->section->learning_id));
    }

    public function qot($id)
    {
        $this->question_id = $id;
        if($this->question_id != $this->question->count() ){
            $this->qot = $this->question[$id]['qot'];
            $this->answers = $this->question[$id]['answers'];
            if (array_key_exists($this->question_id, $this->jwb)) {
                // if(($jwb[$question_id] == $items->id))
                $this->emit('change', $this->jwb[$this->question_id]);
            }
        }
    }
    public function updatedanswer()
    {
        $this->jwb[$this->question_id] = $this->answer;
        // Session::push('answer', $this->jwb);
        session(['answer' => $this->jwb]);
    }
    public function next()
    {
        $this->qot($this->question_id + 1);
    }
    public function back()
    {
        $this->qot($this->question_id - 1);
    }
}
