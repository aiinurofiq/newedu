<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Social;
use Livewire\Component;
use Illuminate\View\View;
use Livewire\WithPagination;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class UserSocialsDetail extends Component
{
    use WithPagination;
    use AuthorizesRequests;

    public User $user;
    public Social $social;

    public $selected = [];
    public $editing = false;
    public $allSelected = false;
    public $showingModal = false;

    public $modalTitle = 'New Social';

    protected $rules = [
        'social.category' => ['required', 'in:1,2,3,4,5'],
        'social.name' => ['required', 'max:255', 'string'],
    ];

    public function mount(User $user): void
    {
        $this->user = $user;
        $this->resetSocialData();
    }

    public function resetSocialData(): void
    {
        $this->social = new Social();

        $this->social->category = '1';

        $this->dispatchBrowserEvent('refresh');
    }

    public function newSocial(): void
    {
        $this->editing = false;
        $this->modalTitle = trans('crud.user_socials.new_title');
        $this->resetSocialData();

        $this->showModal();
    }

    public function editSocial(Social $social): void
    {
        $this->editing = true;
        $this->modalTitle = trans('crud.user_socials.edit_title');
        $this->social = $social;

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

        if (!$this->social->user_id) {
            $this->authorize('create', Social::class);

            $this->social->user_id = $this->user->id;
        } else {
            $this->authorize('update', $this->social);
        }

        $this->social->save();

        $this->hideModal();
    }

    public function destroySelected(): void
    {
        $this->authorize('delete-any', Social::class);

        Social::whereIn('id', $this->selected)->delete();

        $this->selected = [];
        $this->allSelected = false;

        $this->resetSocialData();
    }

    public function toggleFullSelection(): void
    {
        if (!$this->allSelected) {
            $this->selected = [];
            return;
        }

        foreach ($this->user->socials as $social) {
            array_push($this->selected, $social->id);
        }
    }

    public function render(): View
    {
        return view('livewire.user-socials-detail', [
            'socials' => $this->user->socials()->paginate(20),
        ]);
    }
}
