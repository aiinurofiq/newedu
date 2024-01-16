<?php

namespace App\Http\Livewire\admin;

use App\Models\Knowledge;
use App\Models\Reqknowstat;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;


class Requestknowledge extends Component
{
    use WithFileUploads;
    use WithPagination;
    public $topicall, $categoryall, $divisiall, $wsall, $title, $abstract, $topic, $category, $ws, $divisi, $imageknowledge, $writer, $editknowledge, $deleteknowledge, $historyknowledge, $approve, $confirmapprove,$comment,$hari,$cancelapprove;
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
        'cancel' => 'cancel',
    ];
    public function render()
    {
        $this->historyknowledge = Reqknowstat::where('status', 0)->get();
        return view('livewire.admin.requestknowledge', ['data' => $this->dataknowledge()])->layout('layouts.admin.app');
    }
    public function dataknowledge()
    {
        $cari = $this->search;
        return Reqknowstat::where('status', '!=', 0)->when($cari, function ($query) use ($cari) {
            return $query->where('name', 'like', '%' . $cari . '%');
        })->paginate($this->perPage);
    }
    public function change($id, $approve)
    {
        $this->hari = null;
        $this->comment = null;
        $this->approve = $id;
        $this->confirmapprove = $approve;
        $this->action = 'U';
    }
    public function publish($confirm = false)
    {
        if (!$confirm) {
            $this->confirmapprove ? $this->validate(['hari' => 'required']) : null; 
            $this->emit('konfirm', ['title' => 'Apakah anda yakin?', 'text' => 'Request akan Diupdate!', 'icon' => 'warning', 'confirmalert' => 'Update Request!', 'type' => 'publish']);
        } else {
            try {
                $data = [
                    'status' => $this->confirmapprove ? '1' : '2',
                    'comment' => $this->comment,
                    'start_date' => $this->confirmapprove ? date('Y-m-d H:i:s') : null,
                    'end_date' => $this->confirmapprove ? date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s'). ' + '.$this->hari.' days')) : null
                ];
                Reqknowstat::where('id', $this->approve)->update($data);
                $this->emit('notif', ['title' => 'Request berhasil diupdate!!', 'text' => 'Proses berhasil.', 'icon' => 'success']);
                $this->hari = null;
                $this->comment = null;
                $this->action = 'R';
            } catch (\Exception $e) {
                $this->emit('notif', ['title' => $e->getMessage(), 'text' => 'Maaf terjadi kesalahan pada sistem.', 'icon' => 'error']);
                $this->hari = null;
                $this->comment = null;
                $this->action = 'R';
            }
        }
    }public function cancel($id, $confirm = false)
    {
        if (!$confirm) {
            $this->cancelapprove = $id; 
            $this->emit('konfirm', ['title' => 'Apakah anda yakin?', 'text' => 'Request akan dicancel!', 'icon' => 'warning', 'confirmalert' => 'Update Request!', 'type' => 'cancel']);
        } else {
            try {
                $data = [
                    'status' => '0',
                    'comment' => null,
                    'start_date' => null,
                    'end_date' => null
                ];
                Reqknowstat::where('id', $this->cancelapprove)->update($data);
                $this->hari = null;
                $this->comment = null;
                $this->emit('notif', ['title' => 'Request berhasil diupdate!!', 'text' => 'Proses berhasil.', 'icon' => 'success']);
            } catch (\Exception $e) {
                $this->emit('notif', ['title' => $e->getMessage(), 'text' => 'Maaf terjadi kesalahan pada sistem.', 'icon' => 'error']);
                $this->hari = null;
                $this->comment = null;
            }
        }
    }
}
