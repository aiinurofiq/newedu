<?php

namespace App\Http\Livewire\admin;

use App\Models\Category;
use App\Models\Explanation;
use App\Models\Exsum;
use App\Models\Jurnal;
use App\Models\Knowledge;
use App\Models\Report;
use App\Models\Subdivisi;
use App\Models\Topic;
use App\Models\Wilayahsungai;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Illuminate\Support\Str;

class Knowledgeadmin extends Component
{
    use WithFileUploads;
    use WithPagination;
    public $topicall, $categoryall, $divisiall, $wsall, $title, $abstract, $topic, $category, $ws, $divisi, $imageknowledge, $writer, $editknowledge, $deleteknowledge, $jurnalall = [], $exsumall = [], $explanall = [], $reportall = [], $filemodule, $description, $typemodule, $deletemoduleid, $editmoduleid, $year;
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
        'addmodule' => 'addmodule',
        'deletemodule' => 'deletemodule',
        'editmodule' => 'editmodule',
    ];
    public function mount()
    {
        $this->topicall = Topic::all();
        $this->categoryall = Category::all();
        $this->divisiall = Subdivisi::all();
        $this->wsall = Wilayahsungai::all();
    }
    public function render()
    {
        return view('livewire.admin.knowledge', ['data' => $this->dataknowledge()])->layout('layouts.admin.app');
    }
    public function dataknowledge()
    {
        $cari = $this->search;
        return Knowledge::where('user_id', Auth::user()->id)->when($cari, function ($query) use ($cari) {
            return $query->where('title', 'like', '%' . $cari . '%');
        })->paginate($this->perPage);
    }
    public function confirm()
    {
        $validate = [
            'title' => 'required',
            'abstract' => 'required',
            'writer' => 'required',
            'year' => 'required',
        ];
        $this->editknowledge ? null : $validate['imageknowledge'] = 'required';
        $this->validate($validate);
        if ($this->topic == '' || $this->category == '' || $this->ws == '' || $this->divisi == '') {
            $this->emit('notif', ['title' => 'Knowledge belum diisi!', 'text' => 'Harap isi semua isian.', 'icon' => 'error']);
        } else {
            $this->editknowledge ? $this->edit(true) : $this->store();
        }
    }
    public function edit($id, $confirm = false)
    {
        if (!$this->editknowledge) {
            $this->editknowledge = Knowledge::find($id);
            $this->title = $this->editknowledge->title;
            $this->abstract = $this->editknowledge->abstract;
            $this->writer = $this->editknowledge->writer;
            $this->category = $this->editknowledge->category_id;
            $this->topic = $this->editknowledge->topic_id;
            $this->ws = $this->editknowledge->wilayahsungai_id;
            $this->divisi = $this->editknowledge->divisi_id;
            $this->year = $this->editknowledge->year;
            $this->emit('set', ['category' => $this->category, 'topic' => $this->topic, 'ws' => $this->ws, 'divisi' => $this->divisi]);
            $this->action = 'U';
        } else {
            if (!$confirm) {
                $this->emit('konfirm', ['title' => 'Apakah anda yakin?', 'text' => 'Knowledge akan diupdate!', 'icon' => 'warning', 'confirm' => 'Update Knowledge!', 'type' => 'edit']);
            } else {
                try {
                    $data = [
                        'title' => $this->title,
                        'abstract' => $this->abstract,
                        'writer' => $this->writer,
                        'topic_id' => $this->topic,
                        'category_id' => $this->category,
                        'wilayahsungai_id' => $this->ws,
                        'divisi_id' => $this->divisi,
                        'year' => $this->year,
                    ];
                    if ($this->imageknowledge) {
                        $upload = $this->imageknowledge->store('public');
                        $data['photo'] = $upload;
                    }
                    Knowledge::where('id', $this->editknowledge->id)->update($data);
                    $this->emit('notif', ['title' => 'Knowledge berhasil diupdate!!', 'text' => 'Upload section dan modules untuk learning.', 'icon' => 'success']);
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
            $this->emit('konfirm', ['title' => 'Apakah anda yakin?', 'text' => 'Knowledge akan dibuat!', 'icon' => 'warning', 'confirm' => 'Buat Knowledge!', 'type' => 'store']);
        } else {
            try {
                $upload = $this->imageknowledge->store('public');
                Knowledge::create([
                    'uuid' => Str::uuid(),
                    'title' => $this->title,
                    'abstract' => $this->abstract,
                    'writer' => $this->writer,
                    'status' => '0',
                    'photo' => $upload,
                    'user_id' => Auth::user()->id,
                    'topic_id' => $this->topic,
                    'category_id' => $this->category,
                    'wilayahsungai_id' => $this->ws,
                    'divisi_id' => $this->divisi,
                    'year' => $this->year,
                    'ispublic' => '0',
                ]);
                $this->emit('notif', ['title' => 'Knowledge berhasil dibuat!!', 'text' => 'Upload section dan modules untuk learning.', 'icon' => 'success']);
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
            $this->deleteknowledge = Knowledge::find($id);
            $this->emit('konfirm', ['title' => 'Apakah anda yakin?', 'text' => 'Knowledge akan dihapus!', 'icon' => 'warning', 'confirm' => 'Hapus Knowledge!', 'type' => 'delete']);
        } else {
            try {
                Knowledge::find($this->deleteknowledge->id)->delete();
                $this->emit('notif', ['title' => 'Knowledge berhasil dihapus!!', 'text' => 'Proses berhasil.', 'icon' => 'success']);
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
            $this->deleteknowledge = Knowledge::find($id);
            $this->emit('konfirm', ['title' => 'Apakah anda yakin?', 'text' => 'Knowledge' . ($this->deleteknowledge->ispublic ? ' tidak ' : ' ') . 'akan dipublish!', 'icon' => 'warning', 'confirm' => 'Update Knowledge!', 'type' => 'publish']);
        } else {
            try {
                Knowledge::where('id', $this->deleteknowledge->id)->update(['ispublic' => $this->deleteknowledge->ispublic ? 0 : 1]);
                $this->emit('notif', ['title' => 'Knowledge berhasil diupdate!!', 'text' => 'Proses berhasil.', 'icon' => 'success']);
                $this->clear();
            } catch (\Exception $e) {
                $this->emit('notif', ['title' => $e->getMessage(), 'text' => 'Maaf terjadi kesalahan pada sistem.', 'icon' => 'error']);
                $this->clear();
            }
        }
    }
    public function modules($id)
    {
        $this->deleteknowledge = Knowledge::find($id);
        $this->jurnalall = Jurnal::where('knowledge_id', $id)->get();
        $this->exsumall = Exsum::where('knowledge_id', $id)->get();
        $this->explanall = Explanation::where('knowledge_id', $id)->get();
        $this->reportall = Report::where('knowledge_id', $id)->get();
        $this->action = 'A';
    }
    public function confirmmodule()
    {
        if ($this->editmoduleid) {
            $this->editmodule(1);
        } else {
            $validate = [
                'filemodule' => 'required',
            ];
            $this->validate($validate);
            $this->addmodule($this->typemodule);
        }
    }
    public function addmodule($type, $confirm = false)
    {
        if (!$confirm) {
            $this->typemodule = $type;
            $this->emit('konfirm', ['title' => 'Apakah anda yakin?', 'text' => 'Module akan ditambah!', 'icon' => 'warning', 'confirm' => 'Tambah Module!', 'type' => 'addmodule']);
        } else {
            try {
                $upload = $this->filemodule->store('public');
                $data = [
                    'file' => $upload . '|' . $this->filemodule->getClientOriginalName(),
                    'description' => $this->description,
                    'knowledge_id' => $this->deleteknowledge->id,
                ];
                if ($this->typemodule == 'jurnal') {
                    Jurnal::create($data);
                    $this->jurnalall = Jurnal::where('knowledge_id', $this->deleteknowledge->id,)->get();
                } else if ($this->typemodule == 'exsum') {
                    Exsum::create($data);
                    $this->exsumall = Exsum::where('knowledge_id', $this->deleteknowledge->id,)->get();
                } else if ($this->typemodule == 'explan') {
                    Explanation::create($data);
                    $this->explanall = Explanation::where('knowledge_id', $this->deleteknowledge->id,)->get();
                } else {
                    Report::create($data);
                    $this->reportall = Report::where('knowledge_id', $this->deleteknowledge->id,)->get();
                }
                $this->emit('notif', ['title' => 'Module berhasil ditambah!!', 'text' => 'Proses berhasil.', 'icon' => 'success']);
                $this->cancel();
            } catch (\Exception $e) {
                $this->emit('notif', ['title' => $e->getMessage(), 'text' => 'Maaf terjadi kesalahan pada sistem.', 'icon' => 'error']);
                $this->cancel();
            }
        }
    }
    public function confirmdelete($type, $id)
    {
        $this->typemodule = $type;
        $this->deletemodule($id);
    }
    public function deletemodule($id, $confirm = false)
    {
        if (!$confirm) {
            $this->deletemoduleid = $id;
            $this->emit('konfirm', ['title' => 'Apakah anda yakin?', 'text' => 'Module akan dihapus!', 'icon' => 'warning', 'confirm' => 'Hapus Module!', 'type' => 'deletemodule']);
        } else {
            try {
                if ($this->typemodule == 'jurnal') {
                    Jurnal::find($this->deletemoduleid)->delete();
                    $this->jurnalall = Jurnal::where('knowledge_id', $this->deleteknowledge->id,)->get();
                } else if ($this->typemodule == 'exsum') {
                    Exsum::find($this->deletemoduleid)->delete();
                    $this->exsumall = Exsum::where('knowledge_id', $this->deleteknowledge->id,)->get();
                } else if ($this->typemodule == 'explan') {
                    Explanation::find($this->deletemoduleid)->delete();
                    $this->explanall = Explanation::where('knowledge_id', $this->deleteknowledge->id,)->get();
                } else {
                    Report::find($this->deletemoduleid)->delete();
                    $this->reportall = Report::where('knowledge_id', $this->deleteknowledge->id,)->get();
                }
                $this->emit('notif', ['title' => 'Module berhasil dihapus!!', 'text' => 'Proses berhasil.', 'icon' => 'success']);
                $this->cancel();
            } catch (\Exception $e) {
                $this->emit('notif', ['title' => $e->getMessage(), 'text' => 'Maaf terjadi kesalahan pada sistem.', 'icon' => 'error']);
                $this->cancel();
            }
        }
    }
    public function confirmedit($type, $id)
    {
        $this->editmoduleid = null;
        $this->typemodule = $type;
        $this->editmodule($id);
        $this->action = 'M';
    }
    public function editmodule($id, $confirm = false)
    {
        if (!$this->editmoduleid) {
            if ($this->typemodule == 'jurnal') {
                $this->editmoduleid = Jurnal::find($id);
            } else if ($this->typemodule == 'exsum') {
                $this->editmoduleid = Exsum::find($id);
            } else if ($this->typemodule == 'explan') {
                $this->editmoduleid = Explanation::find($id);
            } else {
                $this->editmoduleid = Report::find($id);
            }
            $this->description = $this->editmoduleid->description;
            // $this->action = 'U';
        } else {
            if (!$confirm) {
                $this->emit('konfirm', ['title' => 'Apakah anda yakin?', 'text' => 'Module akan diupdate!', 'icon' => 'warning', 'confirm' => 'Update Module!', 'type' => 'editmodule']);
            } else {
                try {
                    $data = [
                        'description' => $this->description,
                    ];
                    if ($this->filemodule) {
                        $upload = $this->filemodule->store('public');
                        $data['file'] = $upload . '|' . $this->filemodule->getClientOriginalName();
                    }
                    if ($this->typemodule == 'jurnal') {
                        Jurnal::where('id', $this->editmoduleid->id)->update($data);
                        $this->jurnalall = Jurnal::where('knowledge_id', $this->deleteknowledge->id,)->get();
                    } else if ($this->typemodule == 'exsum') {
                        Exsum::where('id', $this->editmoduleid->id)->update($data);
                        $this->exsumall = Exsum::where('knowledge_id', $this->deleteknowledge->id,)->get();
                    } else if ($this->typemodule == 'explan') {
                        Explanation::where('id', $this->editmoduleid->id)->update($data);
                        $this->explanall = Explanation::where('knowledge_id', $this->deleteknowledge->id,)->get();
                    } else {
                        Report::where('id', $this->editmoduleid->id)->update($data);
                        $this->reportall = Report::where('knowledge_id', $this->deleteknowledge->id,)->get();
                    }
                    $this->emit('notif', ['title' => 'Module berhasil diupdate!!', 'text' => 'Proses berhasil.', 'icon' => 'success']);
                    $this->cancel();
                } catch (\Exception $e) {
                    $this->emit('notif', ['title' => $e->getMessage(), 'text' => 'Maaf terjadi kesalahan pada sistem.', 'icon' => 'error']);
                    $this->cancel();
                }
            }
        }
    }
    public function changetype($type)
    {
        $this->cancel();
        $this->typemodule = $type;
        $this->action = 'M';
    }
    public function cancel()
    {
        $this->action = 'A';
        $this->editmoduleid = null;
        $this->description = '';
        $this->deletemoduleid = null;
        $this->emit('reset');
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
        $this->jurnalall = [];
        $this->exsumall = [];
        $this->explanall = [];
        $this->reportall = [];
        $this->action = 'R';
    }
}
