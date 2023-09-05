<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\City;
use Livewire\Component;
use Illuminate\View\View;
use App\Models\Education;
use App\Models\Eduhistory;
use App\Models\University;
use Livewire\WithPagination;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class UserEduhistoriesDetail extends Component
{
    use WithPagination;
    use AuthorizesRequests;

    public User $user;
    public Eduhistory $eduhistory;
    public $educationsForSelect = [];
    public $universitiesForSelect = [];
    public $citiesForSelect = [];

    public $selected = [];
    public $editing = false;
    public $allSelected = false;
    public $showingModal = false;

    public $modalTitle = 'New Eduhistory';

    protected $rules = [
        'eduhistory.education_id' => ['required', 'exists:educations,id'],
        'eduhistory.major' => ['required', 'max:255', 'string'],
        'eduhistory.university_id' => ['required', 'exists:universities,id'],
        'eduhistory.city_id' => ['required', 'exists:cities,id'],
        'eduhistory.year' => ['required', 'numeric'],
        'eduhistory.description' => ['required', 'max:255', 'string'],
    ];

    public function mount(User $user): void
    {
        $this->user = $user;
        $this->educationsForSelect = Education::pluck('name', 'id');
        $this->universitiesForSelect = University::pluck('name', 'id');
        $this->citiesForSelect = City::pluck('name', 'id');
        $this->resetEduhistoryData();
    }

    public function resetEduhistoryData(): void
    {
        $this->eduhistory = new Eduhistory();

        $this->eduhistory->education_id = null;
        $this->eduhistory->university_id = null;
        $this->eduhistory->city_id = null;

        $this->dispatchBrowserEvent('refresh');
    }

    public function newEduhistory(): void
    {
        $this->editing = false;
        $this->modalTitle = trans('crud.user_eduhistories.new_title');
        $this->resetEduhistoryData();

        $this->showModal();
    }

    public function editEduhistory(Eduhistory $eduhistory): void
    {
        $this->editing = true;
        $this->modalTitle = trans('crud.user_eduhistories.edit_title');
        $this->eduhistory = $eduhistory;

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

        if (!$this->eduhistory->user_id) {
            $this->authorize('create', Eduhistory::class);

            $this->eduhistory->user_id = $this->user->id;
        } else {
            $this->authorize('update', $this->eduhistory);
        }

        $this->eduhistory->save();

        $this->hideModal();
    }

    public function destroySelected(): void
    {
        $this->authorize('delete-any', Eduhistory::class);

        Eduhistory::whereIn('id', $this->selected)->delete();

        $this->selected = [];
        $this->allSelected = false;

        $this->resetEduhistoryData();
    }

    public function toggleFullSelection(): void
    {
        if (!$this->allSelected) {
            $this->selected = [];
            return;
        }

        foreach ($this->user->eduhistories as $eduhistory) {
            array_push($this->selected, $eduhistory->id);
        }
    }

    public function render(): View
    {
        return view('livewire.user-eduhistories-detail', [
            'eduhistories' => $this->user->eduhistories()->paginate(20),
        ]);
    }
}
