<?php

namespace App\Http\Livewire;

use App\Models\Report;
use Livewire\Component;
use Illuminate\View\View;
use App\Models\Knowledge;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class KnowledgeReportsDetail extends Component
{
    use WithPagination;
    use WithFileUploads;
    use AuthorizesRequests;

    public Knowledge $knowledge;
    public Report $report;
    public $reportFile;
    public $uploadIteration = 0;

    public $selected = [];
    public $editing = false;
    public $allSelected = false;
    public $showingModal = false;

    public $modalTitle = 'New Report';

    protected $rules = [
        'reportFile' => ['nullable', 'file'],
    ];

    public function mount(Knowledge $knowledge): void
    {
        $this->knowledge = $knowledge;
        $this->resetReportData();
    }

    public function resetReportData(): void
    {
        $this->report = new Report();

        $this->reportFile = null;

        $this->dispatchBrowserEvent('refresh');
    }

    public function newReport(): void
    {
        $this->editing = false;
        $this->modalTitle = trans('crud.knowledge_reports.new_title');
        $this->resetReportData();

        $this->showModal();
    }

    public function editReport(Report $report): void
    {
        $this->editing = true;
        $this->modalTitle = trans('crud.knowledge_reports.edit_title');
        $this->report = $report;

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

        if (!$this->report->knowledge_id) {
            $this->authorize('create', Report::class);

            $this->report->knowledge_id = $this->knowledge->id;
        } else {
            $this->authorize('update', $this->report);
        }

        if ($this->reportFile) {
            $this->report->file = $this->reportFile->store('public');
        }

        $this->report->save();

        $this->uploadIteration++;

        $this->hideModal();
    }

    public function destroySelected(): void
    {
        $this->authorize('delete-any', Report::class);

        collect($this->selected)->each(function (string $id) {
            $report = Report::findOrFail($id);

            if ($report->file) {
                Storage::delete($report->file);
            }

            $report->delete();
        });

        $this->selected = [];
        $this->allSelected = false;

        $this->resetReportData();
    }

    public function toggleFullSelection(): void
    {
        if (!$this->allSelected) {
            $this->selected = [];
            return;
        }

        foreach ($this->knowledge->reports as $report) {
            array_push($this->selected, $report->id);
        }
    }

    public function render(): View
    {
        return view('livewire.knowledge-reports-detail', [
            'reports' => $this->knowledge->reports()->paginate(20),
        ]);
    }
}
