<?php

namespace App\Http\Livewire\admin;

use App\Models\Learning;
use App\Models\Module;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Illuminate\Support\Str;

class Sectionmodule extends Component
{
    use WithFileUploads;
    use WithPagination;
    public $level, $category, $price, $image, $editlearning, $deletelearning, $user_id;
    public $learning, $title, $description, $typemodule, $quiz, $textmodule, $urlmodule, $section_id, $deletesection, $deletemodule, $editsection, $editmodule, $editimage;
    public $perPage = 5;
    public $action = 'R';
    protected $paginationTheme = 'bootstrap';
    public $search = '';
    protected $listeners = [
        'confirm' => 'confirm',
        'store' => 'store',
        'edit' => 'edit',
        'editmodule' => 'editmodule',
        'delete' => 'delete',
        'deletemodule' => 'deletemodule',
        'changeberkas' => 'changeberkas',
    ];
    public function mount()
    {
        $this->learning = Learning::first();
    }
    public function render()
    {
        // $ch = curl_init();

        // // set url 
        // curl_setopt($ch, CURLOPT_URL, "http://36.66.205.254:8082/smsd-api/public/api/highlights");

        // // return the transfer as a string 
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        // // $output contains the output string 
        // $output = curl_exec($ch);

        // // tutup curl 
        // curl_close($ch);

        // // menampilkan hasil curl
        // dd($output);
        return view('livewire.admin.sectionmodule', ['data' => $this->datalearning()])->layout('layouts.admin.app');
    }
    public function datalearning()
    {
        $cari = $this->search;
        return Learning::with('sections')->when($cari, function ($query) use ($cari) {
            return $query->where('title', 'like', '%' . $cari . '%');
        })->paginate($this->perPage);
    }
    public function datasection($id)
    {
        $this->learning = Learning::find($id);
        $this->action = "U";
    }
    public function changesection($id)
    {
        $this->section_id = $id;
        $this->action = "AddMod";
    }
    public function confirm($length)
    {
        $validate = [
            'title' => 'required',
            'description' => 'required',
        ];
        if ($this->action == 'AddSec') {
            $this->validate($validate);
            if (($this->editsection ? false : ($length <= 0)) || $this->quiz == '') {
                $this->emit('notif', ['title' => 'Section belum diisi!', 'text' => 'Harap isi semua isian.', 'icon' => 'error']);
            } else {
                $this->editsection ? $this->edit(true) : $this->store();
            }
        } else {
            $validate['textmodule'] = 'required';
            $validate['urlmodule'] = $this->typemodule == 2 ? 'required' : '';
            $this->validate($validate);
            if ($this->typemodule == '' || ($this->typemodule == 1 && ($this->editmodule && $this->editimage ? false : ($length <= 0)))) {
                $this->emit('notif', ['title' => 'Module belum diisi!', 'text' => 'Harap isi semua isian.', 'icon' => 'error']);
            } else {
                $this->editmodule ? $this->editmodule(true) : $this->store();
            }
        }
    }
    public function store($confirm = false)
    {
        if (!$confirm) {
            $this->emit('konfirm', ['title' => 'Apakah anda yakin?', 'text' => 'Section atau Module akan dibuat!', 'icon' => 'warning', 'confirm' => 'Buat Section atau Module!', 'type' => 'store']);
        } else {
            if ($this->action == 'AddSec') {
                try {
                    Section::create([
                        'title' => $this->title,
                        'image' => $this->image,
                        'description' => $this->description,
                        'learning_id' => $this->learning->id,
                        'hquiz' => $this->quiz,
                    ]);
                    $this->emit('notif', ['title' => 'Section berhasil dibuat!!', 'text' => 'Upload modules untuk Learning.', 'icon' => 'success']);
                    $this->clear();
                } catch (\Exception $e) {
                    $this->emit('notif', ['title' => $e->getMessage(), 'text' => 'Maaf terjadi kesalahan pada sistem.', 'icon' => 'error']);
                    $this->clear();
                }
            } else {
                try {
                    $data = [
                        'title' => $this->title,
                        'description' => $this->description,
                        'section_id' => $this->section_id,
                        'text' => $this->textmodule,
                        'duration' => '0',
                    ];
                    $data['file'] = $this->typemodule == 1 ? $this->image : null;
                    $data['videoembed'] = $this->typemodule == 2 ? $this->urlmodule : null;
                    Module::create($data);
                    $this->emit('notif', ['title' => 'Section berhasil dibuat!!', 'text' => 'Upload modules untuk Learning.', 'icon' => 'success']);
                    $this->clear();
                } catch (\Exception $e) {
                    $this->emit('notif', ['title' => $e->getMessage(), 'text' => 'Maaf terjadi kesalahan pada sistem.', 'icon' => 'error']);
                    $this->clear();
                }
            }
        }
    }
    public function delete($id, $confirm = false)
    {
        if (!$confirm) {
            $this->deletesection = Section::find($id);
            $this->emit('konfirm', ['title' => 'Apakah anda yakin?', 'text' => 'Section akan dihapus!', 'icon' => 'warning', 'confirm' => 'Hapus Section!', 'type' => 'delete']);
        } else {
            try {
                Section::find($this->deletesection->id)->delete();
                $this->emit('notif', ['title' => 'Section berhasil dihapus!!', 'text' => 'Proses berhasil.', 'icon' => 'success']);
                $this->clear();
            } catch (\Exception $e) {
                $this->emit('notif', ['title' => $e->getMessage(), 'text' => 'Maaf terjadi kesalahan pada sistem.', 'icon' => 'error']);
                $this->clear();
            }
        }
    }
    public function deletemodule($id, $confirm = false)
    {
        if (!$confirm) {
            $this->deletemodule = Module::find($id);
            $this->emit('konfirm', ['title' => 'Apakah anda yakin?', 'text' => 'Module akan dihapus!', 'icon' => 'warning', 'confirm' => 'Hapus Module!', 'type' => 'deletemodule']);
        } else {
            try {
                Module::find($this->deletemodule->id)->delete();
                $this->emit('notif', ['title' => 'Module berhasil dihapus!!', 'text' => 'Proses berhasil.', 'icon' => 'success']);
                $this->clear();
            } catch (\Exception $e) {
                $this->emit('notif', ['title' => $e->getMessage(), 'text' => 'Maaf terjadi kesalahan pada sistem.', 'icon' => 'error']);
                $this->clear();
            }
        }
    }
    public function edit($id, $confirm = false)
    {
        if (!$this->editsection) {
            $this->editsection = Section::find($id);
            $this->title = $this->editsection->title;
            $this->description = $this->editsection->description;
            $this->quiz = $this->editsection->hquiz;
            $this->emit('set', ['quiz' => $this->editsection->hquiz]);
            $this->action = 'AddSec';
        } else {
            if (!$confirm) {
                $this->emit('konfirm', ['title' => 'Apakah anda yakin?', 'text' => 'Section akan diupdate!', 'icon' => 'warning', 'confirm' => 'Update Section!', 'type' => 'edit']);
            } else {
                try {
                    $data = [
                        'title' => $this->title,
                        'description' => $this->description,
                        'hquiz' => $this->quiz,
                    ];
                    if ($this->image) {
                        $data['image'] = $this->image;
                    }
                    Section::where('id', $this->editsection->id)->update($data);
                    $this->emit('notif', ['title' => 'Section berhasil diupdate!!', 'text' => 'Upload modules untuk learning.', 'icon' => 'success']);
                    $this->clear();
                } catch (\Exception $e) {
                    $this->emit('notif', ['title' => $e->getMessage(), 'text' => 'Maaf terjadi kesalahan pada sistem.', 'icon' => 'error']);
                    $this->clear();
                }
            }
        }
    }
    public function editmodule($id, $confirm = false)
    {
        if (!$this->editmodule) {
            $this->editmodule = Module::find($id);
            $this->title = $this->editmodule->title;
            $this->description = $this->editmodule->description;
            $this->textmodule = $this->editmodule->text;
            $this->urlmodule = $this->editmodule->videoembed;
            $this->editimage = $this->editmodule->file;
            $this->typemodule = ($this->editimage ? 1 : 2);
            $this->emit('set', ['typemodule' => $this->typemodule]);
            $this->action = 'AddMod';
        } else {
            if (!$confirm) {
                $this->emit('konfirm', ['title' => 'Apakah anda yakin?', 'text' => 'Module akan diupdate!', 'icon' => 'warning', 'confirm' => 'Update Module!', 'type' => 'editmodule']);
            } else {
                try {
                    $data = [
                        'title' => $this->title,
                        'description' => $this->description,
                        'text' => $this->textmodule,
                    ];
                    $this->typemodule == 1 && $this->image ? $data['file'] = $this->image : $data['videoembed'] = null;
                    if ($this->typemodule == 2) {
                        $data['videoembed'] = $this->urlmodule;
                        $data['file'] = null;
                    } else {
                        $this->image ? $data['file'] = $this->image : null;
                        $data['videoembed'] = null;
                    }
                    Module::where('id', $this->editmodule->id)->update($data);
                    $this->emit('notif', ['title' => 'Section berhasil diupdate!!', 'text' => 'Upload modules untuk learning.', 'icon' => 'success']);
                    $this->clear();
                } catch (\Exception $e) {
                    $this->emit('notif', ['title' => $e->getMessage(), 'text' => 'Maaf terjadi kesalahan pada sistem.', 'icon' => 'error']);
                    $this->clear();
                }
            }
        }
    }
    public function clear($confirm = false)
    {
        $this->title = null;
        $this->description = null;
        $this->image = null;
        $this->textmodule = null;
        $this->section_id = null;
        $this->quiz = null;
        $this->deletesection = null;
        $this->deletemodule = null;
        $this->editsection = null;
        $this->editmodule = null;
        $this->editimage = null;
        $this->emit('reset');
        $confirm ? $this->learning = null : null;
        $this->action = $confirm ? 'R' : 'U';
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
