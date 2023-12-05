<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\City;
use App\Models\Wifhus;
use App\Models\Gender;
use Livewire\Component;
use Illuminate\View\View;
use Livewire\WithPagination;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class UserWifhusesDetail extends Component
{
    use WithPagination;
    use AuthorizesRequests;

    public User $user;
    public Wifhus $wifhus;
    public $citiesForSelect = [];
    public $gendersForSelect = [];
    public $wifhusBirth;
    public $wifhusMaritaldate;

    public $selected = [];
    public $editing = false;
    public $allSelected = false;
    public $showingModal = false;

    public $modalTitle = 'New Wifhus';

    protected $rules = [
        'wifhus.name' => ['required', 'max:255', 'string'],
        'wifhus.city_id' => ['required', 'exists:cities,id'],
        'wifhusBirth' => ['required', 'date'],
        'wifhus.gender_id' => ['required', 'exists:genders,id'],
        'wifhus.as' => ['required', 'in:1,2'],
        'wifhus.job' => ['required', 'max:255', 'string'],
        'wifhus.description' => ['required', 'max:255', 'string'],
        'wifhusMaritaldate' => ['required', 'date'],
    ];

    public function mount(User $user): void
    {
        $this->user = $user;
        $this->citiesForSelect = City::pluck('name', 'id');
        $this->gendersForSelect = Gender::pluck('name', 'id');
        $this->resetWifhusData();
    }

    public function resetWifhusData(): void
    {
        $this->wifhus = new Wifhus();

        $this->wifhusBirth = null;
        $this->wifhusMaritaldate = null;
        $this->wifhus->city_id = null;
        $this->wifhus->gender_id = null;
        $this->wifhus->as = '1';

        $this->dispatchBrowserEvent('refresh');
    }

    public function newWifhus(): void
    {
        $this->editing = false;
        $this->modalTitle = trans('crud.user_wifhuses.new_title');
        $this->resetWifhusData();

        $this->showModal();
    }

    public function editWifhus(Wifhus $wifhus): void
    {
        $this->editing = true;
        $this->modalTitle = trans('crud.user_wifhuses.edit_title');
        $this->wifhus = $wifhus;

        $this->wifhusBirth = optional($this->wifhus->birth)->format('Y-m-d');
        $this->wifhusMaritaldate = optional($this->wifhus->maritaldate)->format(
            'Y-m-d'
        );

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

        if (!$this->wifhus->user_id) {
            $this->authorize('create', Wifhus::class);

            $this->wifhus->user_id = $this->user->id;
        } else {
            $this->authorize('update', $this->wifhus);
        }

        $this->wifhus->birth = \Carbon\Carbon::make($this->wifhusBirth);
        $this->wifhus->maritaldate = \Carbon\Carbon::make(
            $this->wifhusMaritaldate
        );

        $this->wifhus->save();

        $this->hideModal();
    }

    public function destroySelected(): void
    {
        $this->authorize('delete-any', Wifhus::class);

        Wifhus::whereIn('id', $this->selected)->delete();

        $this->selected = [];
        $this->allSelected = false;

        $this->resetWifhusData();
    }

    public function toggleFullSelection(): void
    {
        if (!$this->allSelected) {
            $this->selected = [];
            return;
        }

        foreach ($this->user->wifhuses as $wifhus) {
            array_push($this->selected, $wifhus->id);
        }
    }

    public function render(): View
    {
        return view('livewire.user-wifhuses-detail', [
            'wifhuses' => $this->user->wifhuses()->paginate(20),
        ]);
    }
}
