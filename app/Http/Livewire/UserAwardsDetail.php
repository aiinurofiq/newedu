<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Award;
use Livewire\Component;
use Illuminate\View\View;
use Livewire\WithPagination;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class UserAwardsDetail extends Component
{
    use WithPagination;
    use AuthorizesRequests;

    public User $user;
    public Award $award;

    public $selected = [];
    public $editing = false;
    public $allSelected = false;
    public $showingModal = false;

    public $modalTitle = 'New Award';

    protected $rules = [
        'award.name' => ['required', 'max:255', 'string'],
        'award.from' => ['required', 'max:255', 'string'],
        'award.year' => ['required', 'numeric'],
        'award.scale' => ['required', 'in:1,2,3,4'],
    ];

    public function mount(User $user): void
    {
        $this->user = $user;
        $this->resetAwardData();
    }

    public function resetAwardData(): void
    {
        $this->award = new Award();

        $this->award->scale = '1';

        $this->dispatchBrowserEvent('refresh');
    }

    public function newAward(): void
    {
        $this->editing = false;
        $this->modalTitle = trans('crud.user_awards.new_title');
        $this->resetAwardData();

        $this->showModal();
    }

    public function editAward(Award $award): void
    {
        $this->editing = true;
        $this->modalTitle = trans('crud.user_awards.edit_title');
        $this->award = $award;

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

        if (!$this->award->user_id) {
            $this->authorize('create', Award::class);

            $this->award->user_id = $this->user->id;
        } else {
            $this->authorize('update', $this->award);
        }

        $this->award->save();

        $this->hideModal();
    }

    public function destroySelected(): void
    {
        $this->authorize('delete-any', Award::class);

        Award::whereIn('id', $this->selected)->delete();

        $this->selected = [];
        $this->allSelected = false;

        $this->resetAwardData();
    }

    public function toggleFullSelection(): void
    {
        if (!$this->allSelected) {
            $this->selected = [];
            return;
        }

        foreach ($this->user->awards as $award) {
            array_push($this->selected, $award->id);
        }
    }

    public function render(): View
    {
        return view('livewire.user-awards-detail', [
            'awards' => $this->user->awards()->paginate(20),
        ]);
    }
}
