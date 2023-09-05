<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use App\Models\Speaker;
use Illuminate\View\View;
use Livewire\WithPagination;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class UserSpeakersDetail extends Component
{
    use WithPagination;
    use AuthorizesRequests;

    public User $user;
    public Speaker $speaker;

    public $selected = [];
    public $editing = false;
    public $allSelected = false;
    public $showingModal = false;

    public $modalTitle = 'New Speaker';

    protected $rules = [
        'speaker.name' => ['required', 'max:255', 'string'],
        'speaker.organizer' => ['required', 'max:255', 'string'],
        'speaker.year' => ['required', 'numeric'],
        'speaker.address' => ['required', 'max:255', 'string'],
        'speaker.description' => ['required', 'max:255', 'string'],
    ];

    public function mount(User $user): void
    {
        $this->user = $user;
        $this->resetSpeakerData();
    }

    public function resetSpeakerData(): void
    {
        $this->speaker = new Speaker();

        $this->dispatchBrowserEvent('refresh');
    }

    public function newSpeaker(): void
    {
        $this->editing = false;
        $this->modalTitle = trans('crud.user_speakers.new_title');
        $this->resetSpeakerData();

        $this->showModal();
    }

    public function editSpeaker(Speaker $speaker): void
    {
        $this->editing = true;
        $this->modalTitle = trans('crud.user_speakers.edit_title');
        $this->speaker = $speaker;

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

        if (!$this->speaker->user_id) {
            $this->authorize('create', Speaker::class);

            $this->speaker->user_id = $this->user->id;
        } else {
            $this->authorize('update', $this->speaker);
        }

        $this->speaker->save();

        $this->hideModal();
    }

    public function destroySelected(): void
    {
        $this->authorize('delete-any', Speaker::class);

        Speaker::whereIn('id', $this->selected)->delete();

        $this->selected = [];
        $this->allSelected = false;

        $this->resetSpeakerData();
    }

    public function toggleFullSelection(): void
    {
        if (!$this->allSelected) {
            $this->selected = [];
            return;
        }

        foreach ($this->user->speakers as $speaker) {
            array_push($this->selected, $speaker->id);
        }
    }

    public function render(): View
    {
        return view('livewire.user-speakers-detail', [
            'speakers' => $this->user->speakers()->paginate(20),
        ]);
    }
}
