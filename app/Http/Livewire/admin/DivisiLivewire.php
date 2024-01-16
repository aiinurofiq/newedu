<?php

namespace App\Http\Livewire\admin;

use App\Models\Divisi;
use App\Models\Subdivisi;
use App\Models\Wilayahsungai;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Illuminate\Support\Str;

class DivisiLivewire extends Component
{
    use WithFileUploads;
    use WithPagination;
    public $subdivisiall, $divisiall, $wsall, $title, $abstract, $subdivisi, $ws, $divisi, $imageknowledge, $writer, $editknowledge, $deleteknowledge;
    public $perPage = 5;
    public $action = 'R';
    protected $paginationTheme = 'bootstrap';
    public $search = '';
    protected $listeners = [
        'confirm' => 'confirm',
        'store' => 'store',
        'edit' => 'edit',
        'delete' => 'delete',
    ];
    public function render()
    {
        return view('livewire.admin.divisi', ['data' => $this->dataknowledge()])->layout('layouts.admin.app');
    }
    public function dataknowledge()
    {
        $cari = $this->search;
        return Subdivisi::when($cari, function ($query) use ($cari) {
            return $query->where('subdivisi', 'like', '%' . $cari . '%');
        })->paginate($this->perPage);
    }
    public function confirm()
    {
        $validate = [
            'subdivisi' => 'required',
        ];
        $this->validate($validate);
        $this->editknowledge ? $this->edit(true) : $this->store();
    }
    public function edit($id, $confirm = false)
    {
        if (!$this->editknowledge) {
            $this->editknowledge = Subdivisi::find($id);
            $this->subdivisi = $this->editknowledge->subdivisi;
            $this->divisi = $this->editknowledge->divisi;
            $this->action = 'U';
        } else {
            if (!$confirm) {
                $this->emit('konfirm', ['title' => 'Apakah anda yakin?', 'text' => 'Divisi akan diupdate!', 'icon' => 'warning', 'confirm' => 'Update Divisi!', 'type' => 'edit']);
            } else {
                try {
                    $data = [
                        'subdivisi' => $this->subdivisi,
                        'divisi' => $this->divisi,
                    ];
                    Subdivisi::where('id', $this->editknowledge->id)->update($data);
                    $this->emit('notif', ['title' => 'Divisi berhasil diupdate!!', 'text' => 'Upload section dan modules untuk learning.', 'icon' => 'success']);
                    $this->clear();
                } catch (\Exception $e) {
                    $this->emit('notif', ['title' => $e->getMessage(), 'text' => 'Maaf terjadi kesalahan pada sistem.', 'icon' => 'error']);
                    $this->clear();
                }
            }
        }
    }
    public function store($confirm = false)
    {
        if (!$confirm) {
            $this->emit('konfirm', ['title' => 'Apakah anda yakin?', 'text' => 'Divisi akan dibuat!', 'icon' => 'warning', 'confirm' => 'Buat Divisi!', 'type' => 'store']);
        } else {
            try {
                Subdivisi::create([
                    'subdivisi' => $this->subdivisi,
                    'divisi' => $this->divisi,
                ]);
                $this->emit('notif', ['title' => 'Divisi berhasil dibuat!!', 'text' => 'Upload section dan modules untuk learning.', 'icon' => 'success']);
                $this->clear();
            } catch (\Exception $e) {
                $this->emit('notif', ['title' => $e->getMessage(), 'text' => 'Maaf terjadi kesalahan pada sistem.', 'icon' => 'error']);
                $this->clear();
            }
        }
    }
    public function delete($id, $confirm = false)
    {
        if (!$confirm) {
            $this->deleteknowledge = Subdivisi::find($id);
            $this->emit('konfirm', ['title' => 'Apakah anda yakin?', 'text' => 'Divisi akan dihapus!', 'icon' => 'warning', 'confirm' => 'Hapus Divisi!', 'type' => 'delete']);
        } else {
            try {
                Subdivisi::find($this->deleteknowledge->id)->delete();
                $this->emit('notif', ['title' => 'Divisi berhasil dihapus!!', 'text' => 'Proses berhasil.', 'icon' => 'success']);
                $this->clear();
            } catch (\Exception $e) {
                $this->emit('notif', ['title' => $e->getMessage(), 'text' => 'Maaf terjadi kesalahan pada sistem.', 'icon' => 'error']);
                $this->clear();
            }
        }
    }
    public function clear()
    {
        $this->title = null;
        $this->abstract = null;
        $this->writer = null;
        $this->subdivisi = null;
        $this->subdivisi = null;
        $this->ws = null;
        $this->divisi = null;
        $this->imageknowledge = null;
        $this->editknowledge = null;
        $this->deleteknowledge = null;
        $this->emit('reset');
        $this->action = 'R';
    }
}
