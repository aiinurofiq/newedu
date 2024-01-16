@extends('app-landing.accdash')
@section('content-profile')
<div class="card bg-transparent border rounded-3">
    <div class="card-header bg-transparent border-bottom">
        <h3 class="card-header-title mb-0">Profile {{$user->name}}</h3> </div>
    <div class="card-body">
        <form class="row g-4">
            <div class="col-12 justify-content-center align-items-center">
                <label class="form-label">Profile picture</label>
                <div class="d-flex align-items-center">
                    <label class="position-relative me-4" for="uploadfile-1" title="Replace this pic"> 
                        <span class="avatar avatar-xl">
                            <img id="uploadfile-1-preview" class="avatar-img rounded-circle border border-white border-3 shadow" src="{{ auth()->user()->profile_photo_path ? asset(\Storage::url(auth()->user()->profile_photo_path)) : '' }}" alt="">
                        </span>
                    </label>
                </div>
            </div>
            <div class="col-12">
                <label class="form-label">Full name</label>
                <div class="input-group">
                    <input type="text" class="form-control" value="{{$user->name}}" readonly> 
                </div>
            </div>
            <div class="col-12">
                <label class="form-label">Email</label>
                <div class="input-group">
                    <input type="text" class="form-control" value="{{$user->email}}" readonly> 
                </div>
            </div>
            <div class="col-md-6">
                <label class="form-label">Alamat Lengkap</label>
                <input name="address" class="form-control" value="{{$user->address}}" readonly> 
            </div>
            <div class="col-md-6">
                <label class="form-label">Kota</label>
                <input name="address" class="form-control" value="{{$user->city->name}}" readonly> 
            </div>
            <div class="col-md-6">
                <label class="form-label">Nomor Telpon</label>
                <input type="text" class="form-control" value="{{$user->phone}}" readonly> 
            </div>
            <div class="col-md-6">
                <label class="form-label">Jenis Kelamin</label>
                <input type="text" class="form-control" value="{{$user->gender->name}}" readonly> 
            </div>
            <div class="col-md-6">
                <label class="form-label">Agama</label>
                <input type="text" class="form-control" value="{{$user->religion->name}}" readonly> 
            </div>
            <div class="col-md-6">
                <label class="form-label">Status Pernikahan</label>
                <input type="text" class="form-control" value="{{$user->marital->name}}" readonly> 
            </div>
        </form>
    </div>
</div>
@endsection