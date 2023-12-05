<?php

namespace App\Http\Livewire;

use App\Models\Answer;
use Livewire\Component;
use App\Models\Question;
use Illuminate\View\View;
use Livewire\WithPagination;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class QuestionAnswersDetail extends Component
{
    use WithPagination;
    use AuthorizesRequests;

    public Question $question;
    public Answer $answer;

    public $selected = [];
    public $editing = false;
    public $allSelected = false;
    public $showingModal = false;

    public $modalTitle = 'New Answer';

    protected $rules = [
        'answer.answer' => ['required', 'max:255', 'string'],
        'answer.istrue' => ['required', 'boolean'],
    ];

    public function mount(Question $question): void
    {
        $this->question = $question;
        $this->resetAnswerData();
    }

    public function resetAnswerData(): void
    {
        $this->answer = new Answer();

        $this->answer->istrue = '0';

        $this->dispatchBrowserEvent('refresh');
    }

    public function newAnswer(): void
    {
        $this->editing = false;
        $this->modalTitle = trans('crud.question_answers.new_title');
        $this->resetAnswerData();

        $this->showModal();
    }

    public function editAnswer(Answer $answer): void
    {
        $this->editing = true;
        $this->modalTitle = trans('crud.question_answers.edit_title');
        $this->answer = $answer;

        $this->dispatchBrowserEvent('refresh');

        $this->showModal();
    }

    public function showModal(): void
    {
        $this->resetErrorBag();
        $this->showingModal = true;
    }

    public function hideModal(): void
    {
        $this->showingModal = false;
    }

    public function save(): void
    {
        $this->validate();

        if (!$this->answer->question_id) {
            $this->authorize('create', Answer::class);

            $this->answer->question_id = $this->question->id;
        } else {
            $this->authorize('update', $this->answer);
        }

        $this->answer->save();

        $this->hideModal();
    }

    public function destroySelected(): void
    {
        $this->authorize('delete-any', Answer::class);

        Answer::whereIn('id', $this->selected)->delete();

        $this->selected = [];
        $this->allSelected = false;

        $this->resetAnswerData();
    }

    public function toggleFullSelection(): void
    {
        if (!$this->allSelected) {
            $this->selected = [];
            return;
        }

        foreach ($this->question->answers as $answer) {
            array_push($this->selected, $answer->id);
        }
    }

    public function render(): View
    {
        return view('livewire.question-answers-detail', [
            'answers' => $this->question->answers()->paginate(20),
        ]);
    }
}
