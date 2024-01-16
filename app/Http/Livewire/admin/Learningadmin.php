<?php

namespace App\Http\Livewire\admin;

use App\Models\Categorylearn;
use App\Models\Learning;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Illuminate\Support\Str;

class Learningadmin extends Component
{
    use WithFileUploads;
    use WithPagination;
    public $categorylearn, $title, $description, $level, $category, $price, $image, $editlearning, $deletelearning, $user_id;
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
    protected $rules = [
        'title' => 'required',
        'description' => 'required',
        'price' => 'required|numeric',
    ];
    public function render()
    {
        $this->categorylearn = Categorylearn::all();
        return view('livewire.admin.learning', ['data' => $this->datalearning()])->layout('layouts.admin.app');
    }
    public function datalearning()
    {
        $cari = $this->search;
        return Learning::when($cari, function ($query) use ($cari) {
            return $query->where('title', 'like', '%' . $cari . '%');
        })->paginate($this->perPage);
    }
    public function confirm($length)
    {
        $this->validate();
        if (($this->editlearning ? false : ($length <= 0)) || $this->level == '' || $this->category == '') {
            $this->emit('notif', ['title' => 'Learning belum diisi!', 'text' => 'Harap isi semua isian.', 'icon' => 'error']);
        } else {
            $this->editlearning ? $this->edit(true) : $this->store();
        }
    }
    public function edit($id, $confirm = false)
    {
        if (!$this->editlearning) {
            $this->editlearning = Learning::find($id);
            $this->title = $this->editlearning->title;
            $this->description = $this->editlearning->description;
            $this->price = $this->editlearning->price;
            $this->category = $this->editlearning->category;
            $this->level = $this->editlearning->level;
            $this->emit('set', ['category' => $this->editlearning->categorylearn_id, 'level' => $this->editlearning->level]);
            $this->action = 'U';
        } else {
            if (!$confirm) {
                $this->emit('konfirm', ['title' => 'Apakah anda yakin?', 'text' => 'Learning akan diupdate!', 'icon' => 'warning', 'confirm' => 'Update Learning!', 'type' => 'edit']);
            } else {
                try {
                    $data = [
                        'title' => $this->title,
                        'description' => $this->description,
                        'price' => $this->price,
                        'categorylearn_id' => $this->category,
                        'level' => $this->level,
                    ];
                    if ($this->image) {
                        $data['image'] = $this->image;
                    }
                    Learning::where('id', $this->editlearning->id)->update($data);
                    $this->emit('notif', ['title' => 'Learning berhasil diupdate!!', 'text' => 'Upload section dan modules untuk learning.', 'icon' => 'success']);
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
            $this->emit('konfirm', ['title' => 'Apakah anda yakin?', 'text' => 'Learning akan dibuat!', 'icon' => 'warning', 'confirm' => 'Buat Learning!', 'type' => 'store']);
        } else {
            try {
                Learning::create([
                    'uuid' => Str::uuid(),
                    'title' => $this->title,
                    'description' => $this->description,
                    'type' => '1',
                    'price' => $this->price,
                    'user_id' => Auth::user()->id,
                    'categorylearn_id' => $this->category,
                    'level' => $this->level,
                    'ispublic' => '0',
                    'image' => $this->image,
                ]);
                $this->emit('notif', ['title' => 'Learning berhasil dibuat!!', 'text' => 'Upload section dan modules untuk learning.', 'icon' => 'success']);
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
            $this->deletelearning = Learning::find($id);
            $this->emit('konfirm', ['title' => 'Apakah anda yakin?', 'text' => 'Learning akan dihapus!', 'icon' => 'warning', 'confirm' => 'Hapus Learning!', 'type' => 'delete']);
        } else {
            try {
                Learning::find($this->deletelearning->id)->delete();
                $this->emit('notif', ['title' => 'Learning berhasil dihapus!!', 'text' => 'Proses berhasil.', 'icon' => 'success']);
                $this->clear();
            } catch (\Exception $e) {
                $this->emit('notif', ['title' => $e->getMessage(), 'text' => 'Maaf terjadi kesalahan pada sistem.', 'icon' => 'error']);
                $this->clear();
            }
        }
    }

    public function publish($id, $confirm = false)
    {
        if (!$confirm) {
            $this->deletelearning = Learning::find($id);
            $this->emit('konfirm', ['title' => 'Apakah anda yakin?', 'text' => 'Learning' . ($this->deletelearning->ispublic ? ' tidak ' : ' ') . 'akan dipublish!', 'icon' => 'warning', 'confirm' => 'Update Learning!', 'type' => 'publish']);
        } else {
            try {
                Learning::where('id', $this->deletelearning->id)->update(['ispublic' => $this->deletelearning->ispublic ? 0 : 1]);
                $this->emit('notif', ['title' => 'Learning berhasil diupdate!!', 'text' => 'Proses berhasil.', 'icon' => 'success']);
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
        $this->description = null;
        $this->price = null;
        $this->editlearning = null;
        $this->deletelearning = null;
        $this->image = null;
        $this->emit('reset');
        $this->action = 'R';
    }
    public function changeberkas($value)
    {
        $this->image = $value;
    }
    public function dropzoneStore(Request $request)
    {
        $image = $request->file('file');
        $file = $image->store('public');
        return response()->json(['success' => $file]);
    }
}
