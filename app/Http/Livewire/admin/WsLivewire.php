<?php

namespace App\Http\Livewire\admin;

use App\Models\Wilayahsungai;
use App\Models\Subdivisi;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Illuminate\Support\Str;

class WsLivewire extends Component
{
    use WithFileUploads;
    use WithPagination;
    public $wilayahsungaiall, $divisiall, $wsall, $title, $abstract, $wilayahsungai, $ws, $divisi, $imageknowledge, $writer, $editknowledge, $deleteknowledge;
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
        return view('livewire.admin.wilayahsungai', ['data' => $this->dataknowledge()])->layout('layouts.admin.app');
    }
    public function dataknowledge()
    {
        $cari = $this->search;
        return Wilayahsungai::when($cari, function ($query) use ($cari) {
            return $query->where('name', 'like', '%' . $cari . '%');
        })->paginate($this->perPage);
    }
    public function confirm()
    {
        $validate = [
            'wilayahsungai' => 'required',
        ];
        $this->validate($validate);
        $this->editknowledge ? $this->edit(true) : $this->store();
    }
    public function edit($id, $confirm = false)
    {
        if (!$this->editknowledge) {
            $this->editknowledge = Wilayahsungai::find($id);
            $this->wilayahsungai = $this->editknowledge->name;
            $this->action = 'U';
        } else {
            if (!$confirm) {
                $this->emit('konfirm', ['title' => 'Apakah anda yakin?', 'text' => 'Wilayahsungai akan diupdate!', 'icon' => 'warning', 'confirm' => 'Update Wilayahsungai!', 'type' => 'edit']);
            } else {
                try {
                    $data = [
                        'name' => $this->wilayahsungai,
                    ];
                    Wilayahsungai::where('id', $this->editknowledge->id)->update($data);
                    $this->emit('notif', ['title' => 'Wilayahsungai berhasil diupdate!!', 'text' => 'Upload section dan modules untuk learning.', 'icon' => 'success']);
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
            $this->emit('konfirm', ['title' => 'Apakah anda yakin?', 'text' => 'Wilayahsungai akan dibuat!', 'icon' => 'warning', 'confirm' => 'Buat Wilayahsungai!', 'type' => 'store']);
        } else {
            try {
                Wilayahsungai::create([
                    'name' => $this->wilayahsungai,
                ]);
                $this->emit('notif', ['title' => 'Wilayahsungai berhasil dibuat!!', 'text' => 'Upload section dan modules untuk learning.', 'icon' => 'success']);
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
            $this->deleteknowledge = Wilayahsungai::find($id);
            $this->emit('konfirm', ['title' => 'Apakah anda yakin?', 'text' => 'Wilayahsungai akan dihapus!', 'icon' => 'warning', 'confirm' => 'Hapus Wilayahsungai!', 'type' => 'delete']);
        } else {
            try {
                Wilayahsungai::find($this->deleteknowledge->id)->delete();
                $this->emit('notif', ['title' => 'Wilayahsungai berhasil dihapus!!', 'text' => 'Proses berhasil.', 'icon' => 'success']);
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
        $this->wilayahsungai = null;
        $this->wilayahsungai = null;
        $this->ws = null;
        $this->divisi = null;
        $this->imageknowledge = null;
        $this->editknowledge = null;
        $this->deleteknowledge = null;
        $this->emit('reset');
        $this->action = 'R';
    }
}
