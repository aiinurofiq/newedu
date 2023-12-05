<?php

namespace App\Http\Livewire\admin;

use App\Models\Knowledge;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Approveknowledge extends Component
{
    use WithFileUploads;
    use WithPagination;
    public $topicall, $categoryall, $divisiall, $wsall, $title, $abstract, $topic, $category, $ws, $divisi, $imageknowledge, $writer, $editknowledge, $deleteknowledge;
    public $perPage = 5;
    public $action = 'R';
    protected $paginationTheme = 'bootstrap';
    public $search = '';
    protected $listeners = [
        'confirm' => 'confirm',
        'store' => 'store',
        'edit' => 'edit',
        'delete' => 'delete',
        'publish' => 'publish',
        'changeberkas' => 'changeberkas',
    ];
    public function render()
    {
        return view('livewire.admin.approveknowledge', ['data' => $this->dataknowledge()])->layout('layouts.admin.app');
    }
    public function dataknowledge()
    {
        $cari = $this->search;
        return Knowledge::orderBy('status', 'asc')->when($cari, function ($query) use ($cari) {
            return $query->where('title', 'like', '%' . $cari . '%');
        })->paginate($this->perPage);
    }
    public function confirm()
    {
        $validate = [
            'title' => 'required',
            'abstract' => 'required',
            'writer' => 'required',
        ];
        $this->editknowledge ? null : $validate['imageknowledge'] = 'required';
        $this->validate($validate);
        if ($this->topic == '' || $this->category == '' || $this->ws == '' || $this->divisi == '') {
            $this->emit('notif', ['title' => 'Knowledge belum diisi!', 'text' => 'Harap isi semua isian.', 'icon' => 'error']);
        } else {
            $this->editknowledge ? $this->edit(true) : $this->store();
        }
    }

    public function publish($id, $confirm = false)
    {
        if (!$confirm) {
            $this->deleteknowledge = Knowledge::find($id);
            $this->emit('konfirm', ['title' => 'Apakah anda yakin?', 'text' => 'Knowledge' . ($this->deleteknowledge->ispublic ? ' tidak ' : ' ') . 'akan Diapprove!', 'icon' => 'warning', 'confirm' => 'Update Knowledge!', 'type' => 'publish']);
        } else {
            try {
                Knowledge::where('id', $this->deleteknowledge->id)->update(['status' => $this->deleteknowledge->status ? 0 : 1]);
                $this->emit('notif', ['title' => 'Knowledge berhasil diupdate!!', 'text' => 'Proses berhasil.', 'icon' => 'success']);
            } catch (\Exception $e) {
                $this->emit('notif', ['title' => $e->getMessage(), 'text' => 'Maaf terjadi kesalahan pada sistem.', 'icon' => 'error']);
            }
        }
    }
}
