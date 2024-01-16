<?php

namespace App\Http\Livewire;

use App\Models\Module;
use Livewire\Component;
use App\Models\Section;
use Illuminate\View\View;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class SectionModulesDetail extends Component
{
    use WithPagination;
    use WithFileUploads;
    use AuthorizesRequests;

    public Section $section;
    public Module $module;
    public $moduleFile;
    public $uploadIteration = 0;

    public $selected = [];
    public $editing = false;
    public $allSelected = false;
    public $showingModal = false;

    public $modalTitle = 'New Module';

    protected $rules = [
        'module.title' => ['required', 'max:255', 'string'],
        'moduleFile' => ['nullable', 'file', 'max:102400'],
        'module.videoembed' => ['nullable', 'max:255', 'string'],
        'module.text' => ['required', 'max:255', 'string'],
        'module.description' => ['required', 'max:255', 'string'],
        'module.duration' => ['numeric'],
    ];

    public function mount(Section $section): void
    {
        $this->section = $section;
        $this->resetModuleData();
    }

    public function resetModuleData(): void
    {
        $this->module = new Module();

        $this->moduleFile = null;

        $this->dispatchBrowserEvent('refresh');
    }

    public function newModule(): void
    {
        $this->editing = false;
        $this->modalTitle = trans('crud.section_modules.new_title');
        $this->resetModuleData();

        $this->showModal();
    }

    public function editModule(Module $module): void
    {
        $this->editing = true;
        $this->modalTitle = trans('crud.section_modules.edit_title');
        $this->module = $module;

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

        if (!$this->module->section_id) {
            $this->authorize('create', Module::class);

            $this->module->section_id = $this->section->id;
        } else {
            $this->authorize('update', $this->module);
        }

        if ($this->moduleFile) {
            $this->module->file = $this->moduleFile->store('public');
        }

        $this->module->save();

        $this->uploadIteration++;

        $this->hideModal();
    }

    public function destroySelected(): void
    {
        $this->authorize('delete-any', Module::class);

        collect($this->selected)->each(function (string $id) {
            $module = Module::findOrFail($id);

            if ($module->file) {
                Storage::delete($module->file);
            }

            $module->delete();
        });

        $this->selected = [];
        $this->allSelected = false;

        $this->resetModuleData();
    }

    public function toggleFullSelection(): void
    {
        if (!$this->allSelected) {
            $this->selected = [];
            return;
        }

        foreach ($this->section->modules as $module) {
            array_push($this->selected, $module->id);
        }
    }

    public function render(): View
    {
        return view('livewire.section-modules-detail', [
            'modules' => $this->section->modules()->paginate(20),
        ]);
    }
}
