<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\View\View;
use App\Models\Knowledge;
use App\Models\Explanation;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class KnowledgeExplanationsDetail extends Component
{
    use WithPagination;
    use WithFileUploads;
    use AuthorizesRequests;

    public Knowledge $knowledge;
    public Explanation $explanation;
    public $explanationFile;
    public $uploadIteration = 0;

    public $selected = [];
    public $editing = false;
    public $allSelected = false;
    public $showingModal = false;

    public $modalTitle = 'New Explanation';

    protected $rules = [
        'explanationFile' => ['nullable', 'file'],
    ];

    public function mount(Knowledge $knowledge): void
    {
        $this->knowledge = $knowledge;
        $this->resetExplanationData();
    }

    public function resetExplanationData(): void
    {
        $this->explanation = new Explanation();

        $this->explanationFile = null;

        $this->dispatchBrowserEvent('refresh');
    }

    public function newExplanation(): void
    {
        $this->editing = false;
        $this->modalTitle = trans('crud.knowledge_explanations.new_title');
        $this->resetExplanationData();

        $this->showModal();
    }

    public function editExplanation(Explanation $explanation): void
    {
        $this->editing = true;
        $this->modalTitle = trans('crud.knowledge_explanations.edit_title');
        $this->explanation = $explanation;

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

        if (!$this->explanation->knowledge_id) {
            $this->authorize('create', Explanation::class);

            $this->explanation->knowledge_id = $this->knowledge->id;
        } else {
            $this->authorize('update', $this->explanation);
        }

        if ($this->explanationFile) {
            $this->explanation->file = $this->explanationFile->store('public');
        }

        $this->explanation->save();

        $this->uploadIteration++;

        $this->hideModal();
    }

    public function destroySelected(): void
    {
        $this->authorize('delete-any', Explanation::class);

        collect($this->selected)->each(function (string $id) {
            $explanation = Explanation::findOrFail($id);

            if ($explanation->file) {
                Storage::delete($explanation->file);
            }

            $explanation->delete();
        });

        $this->selected = [];
        $this->allSelected = false;

        $this->resetExplanationData();
    }

    public function toggleFullSelection(): void
    {
        if (!$this->allSelected) {
            $this->selected = [];
            return;
        }

        foreach ($this->knowledge->explanations as $explanation) {
            array_push($this->selected, $explanation->id);
        }
    }

    public function render(): View
    {
        return view('livewire.knowledge-explanations-detail', [
            'explanations' => $this->knowledge->explanations()->paginate(20),
        ]);
    }
}
