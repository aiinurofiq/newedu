<?php

namespace App\Http\Livewire;

use App\Models\Exsum;
use Livewire\Component;
use Illuminate\View\View;
use App\Models\Knowledge;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class KnowledgeExsumsDetail extends Component
{
    use WithPagination;
    use WithFileUploads;
    use AuthorizesRequests;

    public Knowledge $knowledge;
    public Exsum $exsum;
    public $exsumFile;
    public $uploadIteration = 0;

    public $selected = [];
    public $editing = false;
    public $allSelected = false;
    public $showingModal = false;

    public $modalTitle = 'New Exsum';

    protected $rules = [
        'exsumFile' => ['nullable', 'file'],
    ];

    public function mount(Knowledge $knowledge): void
    {
        $this->knowledge = $knowledge;
        $this->resetExsumData();
    }

    public function resetExsumData(): void
    {
        $this->exsum = new Exsum();

        $this->exsumFile = null;

        $this->dispatchBrowserEvent('refresh');
    }

    public function newExsum(): void
    {
        $this->editing = false;
        $this->modalTitle = trans('crud.knowledge_exsums.new_title');
        $this->resetExsumData();

        $this->showModal();
    }

    public function editExsum(Exsum $exsum): void
    {
        $this->editing = true;
        $this->modalTitle = trans('crud.knowledge_exsums.edit_title');
        $this->exsum = $exsum;

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

        if (!$this->exsum->knowledge_id) {
            $this->authorize('create', Exsum::class);

            $this->exsum->knowledge_id = $this->knowledge->id;
        } else {
            $this->authorize('update', $this->exsum);
        }

        if ($this->exsumFile) {
            $this->exsum->file = $this->exsumFile->store('public');
        }

        $this->exsum->save();

        $this->uploadIteration++;

        $this->hideModal();
    }

    public function destroySelected(): void
    {
        $this->authorize('delete-any', Exsum::class);

        collect($this->selected)->each(function (string $id) {
            $exsum = Exsum::findOrFail($id);

            if ($exsum->file) {
                Storage::delete($exsum->file);
            }

            $exsum->delete();
        });

        $this->selected = [];
        $this->allSelected = false;

        $this->resetExsumData();
    }

    public function toggleFullSelection(): void
    {
        if (!$this->allSelected) {
            $this->selected = [];
            return;
        }

        foreach ($this->knowledge->exsums as $exsum) {
            array_push($this->selected, $exsum->id);
        }
    }

    public function render(): View
    {
        return view('livewire.knowledge-exsums-detail', [
            'exsums' => $this->knowledge->exsums()->paginate(20),
        ]);
    }
}
