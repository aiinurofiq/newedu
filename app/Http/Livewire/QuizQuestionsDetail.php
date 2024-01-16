<?php

namespace App\Http\Livewire;

use App\Models\Quiz;
use Livewire\Component;
use App\Models\Question;
use Illuminate\View\View;
use Livewire\WithPagination;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class QuizQuestionsDetail extends Component
{
    use WithPagination;
    use AuthorizesRequests;

    public Quiz $quiz;
    public Question $question;

    public $selected = [];
    public $editing = false;
    public $allSelected = false;
    public $showingModal = false;

    public $modalTitle = 'New Question';

    protected $rules = [
        'question.qot' => ['required', 'max:255', 'string'],
    ];

    public function mount(Quiz $quiz): void
    {
        $this->quiz = $quiz;
        $this->resetQuestionData();
    }

    public function resetQuestionData(): void
    {
        $this->question = new Question();

        $this->dispatchBrowserEvent('refresh');
    }

    public function newQuestion(): void
    {
        $this->editing = false;
        $this->modalTitle = trans('crud.quiz_questions.new_title');
        $this->resetQuestionData();

        $this->showModal();
    }

    public function editQuestion(Question $question): void
    {
        $this->editing = true;
        $this->modalTitle = trans('crud.quiz_questions.edit_title');
        $this->question = $question;

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

        if (!$this->question->quiz_id) {
            $this->authorize('create', Question::class);

            $this->question->quiz_id = $this->quiz->id;
        } else {
            $this->authorize('update', $this->question);
        }

        $this->question->save();

        $this->hideModal();
    }

    public function destroySelected(): void
    {
        $this->authorize('delete-any', Question::class);

        Question::whereIn('id', $this->selected)->delete();

        $this->selected = [];
        $this->allSelected = false;

        $this->resetQuestionData();
    }

    public function toggleFullSelection(): void
    {
        if (!$this->allSelected) {
            $this->selected = [];
            return;
        }

        foreach ($this->quiz->questions as $question) {
            array_push($this->selected, $question->id);
        }
    }

    public function render(): View
    {
        return view('livewire.quiz-questions-detail', [
            'questions' => $this->quiz->questions()->paginate(20),
        ]);
    }
}
