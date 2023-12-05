<?php

namespace App\Http\Livewire;

use App\Models\Quiz;
use Livewire\Component;
use App\Models\Section;
use Illuminate\View\View;
use Livewire\WithPagination;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class SectionQuizzesDetail extends Component
{
    use WithPagination;
    use AuthorizesRequests;

    public Section $section;
    public Quiz $quiz;

    public $selected = [];
    public $editing = false;
    public $allSelected = false;
    public $showingModal = false;

    public $modalTitle = 'New Quiz';

    protected $rules = [
        'quiz.category' => ['required', 'in:0,1,2,3'],
        'quiz.passinggrade' => ['required', 'numeric'],
        'quiz.sumvalue' => ['required', 'numeric'],
        'quiz.description' => ['required', 'max:255', 'string'],
    ];

    public function mount(Section $section): void
    {
        $this->section = $section;
        $this->resetQuizData();
    }

    public function resetQuizData(): void
    {
        $this->quiz = new Quiz();

        $this->quiz->category = '0';

        $this->dispatchBrowserEvent('refresh');
    }

    public function newQuiz(): void
    {
        $this->editing = false;
        $this->modalTitle = trans('crud.section_quizzes.new_title');
        $this->resetQuizData();

        $this->showModal();
    }

    public function editQuiz(Quiz $quiz): void
    {
        $this->editing = true;
        $this->modalTitle = trans('crud.section_quizzes.edit_title');
        $this->quiz = $quiz;

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

        if (!$this->quiz->section_id) {
            $this->authorize('create', Quiz::class);

            $this->quiz->section_id = $this->section->id;
        } else {
            $this->authorize('update', $this->quiz);
        }

        $this->quiz->save();

        $this->hideModal();
    }

    public function destroySelected(): void
    {
        $this->authorize('delete-any', Quiz::class);

        Quiz::whereIn('id', $this->selected)->delete();

        $this->selected = [];
        $this->allSelected = false;

        $this->resetQuizData();
    }

    public function toggleFullSelection(): void
    {
        if (!$this->allSelected) {
            $this->selected = [];
            return;
        }

        foreach ($this->section->quizzes as $quiz) {
            array_push($this->selected, $quiz->id);
        }
    }

    public function render(): View
    {
        return view('livewire.section-quizzes-detail', [
            'quizzes' => $this->section->quizzes()->paginate(20),
        ]);
    }
}
