<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Illuminate\View\View;
use Livewire\WithPagination;
use App\Models\Organization;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class UserOrganizationsDetail extends Component
{
    use WithPagination;
    use AuthorizesRequests;

    public User $user;
    public Organization $organization;
    public $organizationStart;
    public $organizationEnd;

    public $selected = [];
    public $editing = false;
    public $allSelected = false;
    public $showingModal = false;

    public $modalTitle = 'New Organization';

    protected $rules = [
        'organization.name' => ['required', 'max:255', 'string'],
        'organization.position' => ['required', 'max:255', 'string'],
        'organizationStart' => ['required', 'date'],
        'organizationEnd' => ['required', 'date'],
        'organization.description' => ['required', 'max:255', 'string'],
    ];

    public function mount(User $user): void
    {
        $this->user = $user;
        $this->resetOrganizationData();
    }

    public function resetOrganizationData(): void
    {
        $this->organization = new Organization();

        $this->organizationStart = null;
        $this->organizationEnd = null;

        $this->dispatchBrowserEvent('refresh');
    }

    public function newOrganization(): void
    {
        $this->editing = false;
        $this->modalTitle = trans('crud.user_organizations.new_title');
        $this->resetOrganizationData();

        $this->showModal();
    }

    public function editOrganization(Organization $organization): void
    {
        $this->editing = true;
        $this->modalTitle = trans('crud.user_organizations.edit_title');
        $this->organization = $organization;

        $this->organizationStart = optional($this->organization->start)->format(
            'Y-m-d'
        );
        $this->organizationEnd = optional($this->organization->end)->format(
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

        if (!$this->organization->user_id) {
            $this->authorize('create', Organization::class);

            $this->organization->user_id = $this->user->id;
        } else {
            $this->authorize('update', $this->organization);
        }

        $this->organization->start = \Carbon\Carbon::make(
            $this->organizationStart
        );
        $this->organization->end = \Carbon\Carbon::make($this->organizationEnd);

        $this->organization->save();

        $this->hideModal();
    }

    public function destroySelected(): void
    {
        $this->authorize('delete-any', Organization::class);

        Organization::whereIn('id', $this->selected)->delete();

        $this->selected = [];
        $this->allSelected = false;

        $this->resetOrganizationData();
    }

    public function toggleFullSelection(): void
    {
        if (!$this->allSelected) {
            $this->selected = [];
            return;
        }

        foreach ($this->user->organizations as $organization) {
            array_push($this->selected, $organization->id);
        }
    }

    public function render(): View
    {
        return view('livewire.user-organizations-detail', [
            'organizations' => $this->user->organizations()->paginate(20),
        ]);
    }
}
