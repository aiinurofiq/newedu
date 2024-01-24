<?php

namespace App\Http\Livewire\admin;

use App\Models\Subdivisi;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;

class Profileuser extends Component
{
    public $user,$divisi,$nama,$kopeg,$strata,$subdivisi,$newpassword,$confirmpassword;
    public $action = 'R';
    protected $rules = [
        'nama' => 'required',
        'strata' => 'required',
        'kopeg' => 'required'
    ];
    public function render()
    {
        // $this->user = User::where('id',Auth::user()->id);
        // dd($this->user);
        // $this->divisi = Subdivisi::all();
        return view('livewire.admin.profile')->layout('layouts.admin.app');
    }
}
