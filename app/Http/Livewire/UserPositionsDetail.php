<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use App\Models\Position;
use App\Models\Division;
use Illuminate\View\View;
use Livewire\WithPagination;
use App\Models\Fieldofposition;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class UserPositionsDetail extends Component
{
    use WithPagination;
    use AuthorizesRequests;

    public User $user;
    public Position $position;
    public $fieldofpositionsForSelect = [];
    public $divisionsForSelect = [];
    public $positionStart;
    public $positionEnd;

    public $selected = [];
    public $editing = false;
    public $allSelected = false;
    public $showingModal = false;

    public $modalTitle = 'New Position';

    protected $rules = [
        'position.name' => ['required', 'max:255', 'string'],
        'positionStart' => ['required', 'date'],
        'positionEnd' => ['required', 'date'],
        'position.fieldofposition_id' => [
            'required',
            'exists:fieldofpositions,id',
        ],
        'position.division_id' => ['required', 'exists:divisions,id'],
    ];

    public function mount(User $user): void
    {
        $this->user = $user;
        $this->fieldofpositionsForSelect = Fieldofposition::pluck('name', 'id');
        $this->divisionsForSelect = Division::pluck('name', 'id');
        $this->resetPositionData();
    }

    public function resetPositionData(): void
    {
        $this->position = new Position();

        $this->positionStart = null;
        $this->positionEnd = null;
        $this->position->fieldofposition_id = null;

        $this->dispatchBrowserEvent('refresh');
    }

    public function newPosition(): void
    {
        $this->editing = false;
        $this->modalTitle = trans('crud.user_positions.new_title');
        $this->resetPositionData();

        $this->showModal();
    }

    public function editPosition(Position $position): void
    {
        $this->editing = true;
        $this->modalTitle = trans('crud.user_positions.edit_title');
        $this->position = $position;

        $this->positionStart = optional($this->position->start)->format(
            'Y-m-d'
        );
        $this->positionEnd = optional($this->position->end)->format('Y-m-d');

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

        if (!$this->position->user_id) {
            $this->authorize('create', Position::class);

            $this->position->user_id = $this->user->id;
        } else {
            $this->authorize('update', $this->position);
        }

        $this->position->start = \Carbon\Carbon::make($this->positionStart);
        $this->position->end = \Carbon\Carbon::make($this->positionEnd);

        $this->position->save();

        $this->hideModal();
    }

    public function destroySelected(): void
    {
        $this->authorize('delete-any', Position::class);

        Position::whereIn('id', $this->selected)->delete();

        $this->selected = [];
        $this->allSelected = false;

        $this->resetPositionData();
    }

    public function toggleFullSelection(): void
    {
        if (!$this->allSelected) {
            $this->selected = [];
            return;
        }

        foreach ($this->user->positions as $position) {
            array_push($this->selected, $position->id);
        }
    }

    public function render(): View
    {
        return view('livewire.user-positions-detail', [
            'positions' => $this->user->positions()->paginate(20),
        ]);
    }
}
