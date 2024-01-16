<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Section;
use App\Models\Learning;
use Illuminate\View\View;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class LearningSectionsDetail extends Component
{
    use WithPagination;
    use WithFileUploads;
    use AuthorizesRequests;

    public Learning $learning;
    public Section $section;
    public $sectionImage;
    public $uploadIteration = 0;

    public $selected = [];
    public $editing = false;
    public $allSelected = false;
    public $showingModal = false;

    public $modalTitle = 'New Section';

    protected $rules = [
        'section.title' => ['required', 'max:255', 'string'],
        'sectionImage' => ['nullable', 'image', 'max:1024'],
        'section.description' => ['required', 'max:255', 'string'],
        'section.hquiz' => ['required', 'in:0,1'],
    ];

    public function mount(Learning $learning): void
    {
        $this->learning = $learning;
        $this->resetSectionData();
    }

    public function resetSectionData(): void
    {
        $this->section = new Section();

        $this->sectionImage = null;
        $this->section->hquiz = '0';

        $this->dispatchBrowserEvent('refresh');
    }

    public function newSection(): void
    {
        $this->editing = false;
        $this->modalTitle = trans('crud.learning_sections.new_title');
        $this->resetSectionData();

        $this->showModal();
    }

    public function editSection(Section $section): void
    {
        $this->editing = true;
        $this->modalTitle = trans('crud.learning_sections.edit_title');
        $this->section = $section;

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

        if (!$this->section->learning_id) {
            $this->authorize('create', Section::class);

            $this->section->learning_id = $this->learning->id;
        } else {
            $this->authorize('update', $this->section);
        }

        if ($this->sectionImage) {
            $this->section->image = $this->sectionImage->store('public');
        }

        $this->section->save();

        $this->uploadIteration++;

        $this->hideModal();
    }

    public function destroySelected(): void
    {
        $this->authorize('delete-any', Section::class);

        collect($this->selected)->each(function (string $id) {
            $section = Section::findOrFail($id);

            if ($section->image) {
                Storage::delete($section->image);
            }

            $section->delete();
        });

        $this->selected = [];
        $this->allSelected = false;

        $this->resetSectionData();
    }

    public function toggleFullSelection(): void
    {
        if (!$this->allSelected) {
            $this->selected = [];
            return;
        }

        foreach ($this->learning->sections as $section) {
            array_push($this->selected, $section->id);
        }
    }

    public function render(): View
    {
        return view('livewire.learning-sections-detail', [
            'sections' => $this->learning->sections()->paginate(20),
        ]);
    }
}
