<?php

namespace App\Http\Livewire;

use App\Models\Kid;
use App\Models\User;
use App\Models\City;
use App\Models\Gender;
use Livewire\Component;
use Illuminate\View\View;
use Livewire\WithPagination;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class UserKidsDetail extends Component
{
    use WithPagination;
    use AuthorizesRequests;

    public User $user;
    public Kid $kid;
    public $citiesForSelect = [];
    public $gendersForSelect = [];
    public $kidBirth;

    public $selected = [];
    public $editing = false;
    public $allSelected = false;
    public $showingModal = false;

    public $modalTitle = 'New Kid';

    protected $rules = [
        'kid.name' => ['required', 'max:255', 'string'],
        'kid.city_id' => ['required', 'exists:cities,id'],
        'kidBirth' => ['required', 'date'],
        'kid.gender_id' => ['required', 'exists:genders,id'],
        'kid.job' => ['required', 'max:255', 'string'],
        'kid.description' => ['required', 'max:255', 'string'],
    ];

    public function mount(User $user): void
    {
        $this->user = $user;
        $this->citiesForSelect = City::pluck('name', 'id');
        $this->gendersForSelect = Gender::pluck('name', 'id');
        $this->resetKidData();
    }

    public function resetKidData(): void
    {
        $this->kid = new Kid();

        $this->kidBirth = null;
        $this->kid->city_id = null;
        $this->kid->gender_id = null;

        $this->dispatchBrowserEvent('refresh');
    }

    public function newKid(): void
    {
        $this->editing = false;
        $this->modalTitle = trans('crud.user_kids.new_title');
        $this->resetKidData();

        $this->showModal();
    }

    public function editKid(Kid $kid): void
    {
        $this->editing = true;
        $this->modalTitle = trans('crud.user_kids.edit_title');
        $this->kid = $kid;

        $this->kidBirth = optional($this->kid->birth)->format('Y-m-d');

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

        if (!$this->kid->user_id) {
            $this->authorize('create', Kid::class);

            $this->kid->user_id = $this->user->id;
        } else {
            $this->authorize('update', $this->kid);
        }

        $this->kid->birth = \Carbon\Carbon::make($this->kidBirth);

        $this->kid->save();

        $this->hideModal();
    }

    public function destroySelected(): void
    {
        $this->authorize('delete-any', Kid::class);

        Kid::whereIn('id', $this->selected)->delete();

        $this->selected = [];
        $this->allSelected = false;

        $this->resetKidData();
    }

    public function toggleFullSelection(): void
    {
        if (!$this->allSelected) {
            $this->selected = [];
            return;
        }

        foreach ($this->user->kids as $kid) {
            array_push($this->selected, $kid->id);
        }
    }

    public function render(): View
    {
        return view('livewire.user-kids-detail', [
            'kids' => $this->user->kids()->paginate(20),
        ]);
    }
}
