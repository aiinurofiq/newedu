<?php

namespace App\Http\Livewire\admin;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

class Permission extends Component
{
    // use HasRoles;
    use WithPagination;
    public $perPage = 5;
    public $action = 'R';
    public $search = '';
    protected $paginationTheme = 'bootstrap';
    protected $listeners = [
        'hapus' => 'hapus',
    ];
    public function render()
    {

        return view('livewire.admin.permission', ['data' => $this->datapermission(), 'data2' =>  $this->datanotpermission()])->layout('layouts.admin.app');
    }
    public function datapermission()
    {
        return User::with('roles')->get();
    }
    public function datanotpermission()
    {
        $cari = $this->search;
        return User::doesntHave('roles')->when($cari, function ($query) use ($cari) {
            return $query->where('name', 'like', '%' . $cari . '%');
        })->paginate($this->perPage);
    }
    public function tambah($id){
        User::findorFail($id)->assignRole('super-admin');
        $this->emit('notif', ['title' => 'Akses berhasil ditambahkan!!', 'text' => 'Anggota telah update.', 'icon' => 'success']);
        $this->action = 'R';
    }
    public function tambahunit($id){
        User::findorFail($id)->assignRole('admin-unit');
        $this->emit('notif', ['title' => 'Akses berhasil ditambahkan!!', 'text' => 'Anggota telah update.', 'icon' => 'success']);
        $this->action = 'R';
    }
    public function hapus($id){
        $user = User::findorFail($id);
        $user->getRoleNames()->first() == 'super-admin' ? $user->removeRole('super-admin') : $user->removeRole('admin-unit');
        $this->emit('notif', ['title' => 'Akses berhasil dihapus!!', 'text' => 'Anggota telah update.', 'icon' => 'success']);
    }
}
