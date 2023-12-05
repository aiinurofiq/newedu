<?php

namespace App\Http\Livewire;

use App\Models\Jurnal;
use Livewire\Component;
use Illuminate\View\View;
use App\Models\Knowledge;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class KnowledgeJurnalsDetail extends Component
{
    use WithPagination;
    use WithFileUploads;
    use AuthorizesRequests;

    public Knowledge $knowledge;
    public Jurnal $jurnal;
    public $jurnalFile;
    public $uploadIteration = 0;

    public $selected = [];
    public $editing = false;
    public $allSelected = false;
    public $showingModal = false;

    public $modalTitle = 'New Jurnal';

    protected $rules = [
        'jurnalFile' => ['nullable', 'file'],
    ];

    public function mount(Knowledge $knowledge): void
    {
        $this->knowledge = $knowledge;
        $this->resetJurnalData();
    }

    public function resetJurnalData(): void
    {
        $this->jurnal = new Jurnal();

        $this->jurnalFile = null;

        $this->dispatchBrowserEvent('refresh');
    }

    public function newJurnal(): void
    {
        $this->editing = false;
        $this->modalTitle = trans('crud.knowledge_jurnals.new_title');
        $this->resetJurnalData();

        $this->showModal();
    }

    public function editJurnal(Jurnal $jurnal): void
    {
        $this->editing = true;
        $this->modalTitle = trans('crud.knowledge_jurnals.edit_title');
        $this->jurnal = $jurnal;

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

        if (!$this->jurnal->knowledge_id) {
            $this->authorize('create', Jurnal::class);

            $this->jurnal->knowledge_id = $this->knowledge->id;
        } else {
            $this->authorize('update', $this->jurnal);
        }

        if ($this->jurnalFile) {
            $this->jurnal->file = $this->jurnalFile->store('public');
        }

        $this->jurnal->save();

        $this->uploadIteration++;

        $this->hideModal();
    }

    public function destroySelected(): void
    {
        $this->authorize('delete-any', Jurnal::class);

        collect($this->selected)->each(function (string $id) {
            $jurnal = Jurnal::findOrFail($id);

            if ($jurnal->file) {
                Storage::delete($jurnal->file);
            }

            $jurnal->delete();
        });

        $this->selected = [];
        $this->allSelected = false;

        $this->resetJurnalData();
    }

    public function toggleFullSelection(): void
    {
        if (!$this->allSelected) {
            $this->selected = [];
            return;
        }

        foreach ($this->knowledge->jurnals as $jurnal) {
            array_push($this->selected, $jurnal->id);
        }
    }

    public function render(): View
    {
        return view('livewire.knowledge-jurnals-detail', [
            'jurnals' => $this->knowledge->jurnals()->paginate(20),
        ]);
    }
}
