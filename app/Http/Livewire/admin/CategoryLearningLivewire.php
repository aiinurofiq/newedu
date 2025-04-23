<?php

namespace App\Http\Livewire\admin;

use App\Models\Categorylearn;
use App\Models\Subdivisi;
use App\Models\Wilayahsungai;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Illuminate\Support\Str;

class CategoryLearningLivewire extends Component
{
    use WithFileUploads;
    use WithPagination;
    public $categoryall, $divisiall, $wsall, $title, $abstract, $category, $ws, $divisi, $imageknowledge, $writer, $editknowledge, $deleteknowledge;
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
        return view('livewire.admin.categorylearn', ['data' => $this->dataknowledge()])->layout('layouts.admin.app');
    }
    public function dataknowledge()
    {
        $cari = $this->search;
        return Categorylearn::when($cari, function ($query) use ($cari) {
            return $query->where('name', 'like', '%' . $cari . '%');
        })->paginate($this->perPage);
    }
    public function confirm()
    {
        $validate = [
            'category' => 'required',
        ];
        $this->validate($validate);
        $this->editknowledge ? $this->edit(true) : $this->store();
    }
    public function edit($id, $confirm = false)
    {
        if (!$this->editknowledge) {
            $this->editknowledge = Categorylearn::find($id);
            $this->category = $this->editknowledge->name;
            $this->action = 'U';
        } else {
            if (!$confirm) {
                $this->emit('konfirm', ['title' => 'Apakah anda yakin?', 'text' => 'Category akan diupdate!', 'icon' => 'warning', 'confirm' => 'Update Category!', 'type' => 'edit']);
            } else {
                try {
                    $data = [
                        'name' => $this->category,
                    ];
                    Categorylearn::where('id', $this->editknowledge->id)->update($data);
                    $this->emit('notif', ['title' => 'Category berhasil diupdate!!', 'text' => 'Upload section dan modules untuk learning.', 'icon' => 'success']);
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
            $this->emit('konfirm', ['title' => 'Apakah anda yakin?', 'text' => 'Category akan dibuat!', 'icon' => 'warning', 'confirm' => 'Buat Category!', 'type' => 'store']);
        } else {
            try {
                Categorylearn::create([
                    'name' => $this->category,
                    'description' => true,
                ]);
                $this->emit('notif', ['title' => 'Category berhasil dibuat!!', 'text' => 'Upload section dan modules untuk learning.', 'icon' => 'success']);
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
            $this->deleteknowledge = Categorylearn::find($id);
            $this->emit('konfirm', ['title' => 'Apakah anda yakin?', 'text' => 'Category akan dihapus!', 'icon' => 'warning', 'confirm' => 'Hapus Category!', 'type' => 'delete']);
        } else {
            try {
                Categorylearn::find($this->deleteknowledge->id)->delete();
                $this->emit('notif', ['title' => 'Category berhasil dihapus!!', 'text' => 'Proses berhasil.', 'icon' => 'success']);
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
        $this->category = null;
        $this->category = null;
        $this->ws = null;
        $this->divisi = null;
        $this->imageknowledge = null;
        $this->editknowledge = null;
        $this->deleteknowledge = null;
        $this->emit('reset');
        $this->action = 'R';
    }
}
