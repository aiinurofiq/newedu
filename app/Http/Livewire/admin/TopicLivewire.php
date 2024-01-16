<?php

namespace App\Http\Livewire\admin;

use App\Models\Category;
use App\Models\Topic;
use App\Models\Subdivisi;
use App\Models\Wilayahsungai;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Illuminate\Support\Str;

class TopicLivewire extends Component
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
    ];
    public function render()
    {
        return view('livewire.admin.topic', ['data' => $this->dataknowledge()])->layout('layouts.admin.app');
    }
    public function dataknowledge()
    {
        $cari = $this->search;
        return Topic::when($cari, function ($query) use ($cari) {
            return $query->where('name', 'like', '%' . $cari . '%');
        })->paginate($this->perPage);
    }
    public function confirm()
    {
        $validate = [
            'topic' => 'required',
        ];
        $this->validate($validate);
        $this->editknowledge ? $this->edit(true) : $this->store();
    }
    public function edit($id, $confirm = false)
    {
        if (!$this->editknowledge) {
            $this->editknowledge = Topic::find($id);
            $this->topic = $this->editknowledge->name;
            $this->action = 'U';
        } else {
            if (!$confirm) {
                $this->emit('konfirm', ['title' => 'Apakah anda yakin?', 'text' => 'Topic akan diupdate!', 'icon' => 'warning', 'confirm' => 'Update Topic!', 'type' => 'edit']);
            } else {
                try {
                    $data = [
                        'name' => $this->topic,
                    ];
                    Topic::where('id', $this->editknowledge->id)->update($data);
                    $this->emit('notif', ['title' => 'Topic berhasil diupdate!!', 'text' => 'Upload section dan modules untuk learning.', 'icon' => 'success']);
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
            $this->emit('konfirm', ['title' => 'Apakah anda yakin?', 'text' => 'Topic akan dibuat!', 'icon' => 'warning', 'confirm' => 'Buat Topic!', 'type' => 'store']);
        } else {
            try {
                Topic::create([
                    'name' => $this->topic,
                ]);
                $this->emit('notif', ['title' => 'Topic berhasil dibuat!!', 'text' => 'Upload section dan modules untuk learning.', 'icon' => 'success']);
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
            $this->deleteknowledge = Topic::find($id);
            $this->emit('konfirm', ['title' => 'Apakah anda yakin?', 'text' => 'Topic akan dihapus!', 'icon' => 'warning', 'confirm' => 'Hapus Topic!', 'type' => 'delete']);
        } else {
            try {
                Topic::find($this->deleteknowledge->id)->delete();
                $this->emit('notif', ['title' => 'Topic berhasil dihapus!!', 'text' => 'Proses berhasil.', 'icon' => 'success']);
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
        $this->topic = null;
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
