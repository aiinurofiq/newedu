
@extends('app-landing.accdash')
@section('content-profile')
<div class="row mb-4">
    <div class="card-header bg-transparent">
        <h3 class="mb-0">Knowledge Saya</h3> 
    </div>
    <div class="col-sm-6 col-lg-4 mb-3 mb-lg-0">
        <div class="d-flex justify-content-center align-items-center p-4 bg-orange bg-opacity-15 rounded-3"> <span class="display-6 lh-1 text-orange mb-0"><i class="fas fa-tv fa-fw"></i></span>
            <div class="ms-4">
                <div class="d-flex">
                    <h5 class="purecounter mb-0 fw-bold" data-purecounter-start="0" data-purecounter-end="{{$knows->where('user_id', auth()->user()->id)->count()}}" data-purecounter-delay="200">0</h5> </div>
                <p class="mb-0 h6 fw-light">Total Knowledge dikirim</p>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-4 mb-3 mb-lg-0">
        <div class="d-flex justify-content-center align-items-center p-4 bg-purple bg-opacity-15 rounded-3"> <span class="display-6 lh-1 text-purple mb-0"><i class="fas fa-clipboard-check fa-fw"></i></span>
            <div class="ms-4">
                <div class="d-flex">
                    <h5 class="purecounter mb-0 fw-bold" data-purecounter-start="0" data-purecounter-end="{{$reqknows->where('user_id', auth()->user()->id)->count()}}" data-purecounter-delay="200">0</h5> </div>
                <p class="mb-0 h6 fw-light">Total Permintaan Knowledge</p>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-4 mb-3 mb-lg-0">
        <div class="d-flex justify-content-center align-items-center p-4 bg-success bg-opacity-10 rounded-3"> <span class="display-6 lh-1 text-success mb-0"><i class="fas fa-medal fa-fw"></i></span>
            <div class="ms-4">
                <div class="d-flex">
                    <h5 class="purecounter mb-0 fw-bold" data-purecounter-start="0" data-purecounter-end="{{$knows->where('status', 1)->count()}}" data-purecounter-delay="300">0</h5> </div>
                <p class="mb-0 h6 fw-light">Total Knowledge Terpublish</p>
            </div>
        </div>
    </div>
</div>
<table id="example" class="display" style="width:100%">
    <thead>
        <tr>
            <th>Judul</th>
            <th>Penulis</th>
            <th>Kategori</th>
            <th>Topik</th>
            <th>Status</th>
            <th>Timestamp</th>
        </tr>
    </thead>
    <tbody>
        @foreach ( $knows->where('user_id', auth()->user()->id) as $know )
        <tr>
            <td>{{$know->title}}</td>
            <td>{{$know->writer}}</td>
            <td>{{$know->category->name}}</td>
            <td>{{$know->topic->name}}</td>
            <td>
                @if ($know->status == 1)
                <i class="fas fa-check-circle text-success me-2"></i> Terverifikasi
                @else
                <i class="bi bi-patch-exclamation-fill text-danger me-2"></i> Belum diverifikasi
                @endif
            </td>
            <td>{{$know->created_at}}</td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th>Judul</th>
            <th>Penulis</th>
            <th>Kategori</th>
            <th>Topik</th>
            <th>Status</th>
            <th>Timestamp</th>
        </tr>
    </tfoot>
</table>
<div class="row mb-4">
    <div class="card-header bg-transparent">
        <h3 class="mb-0">Learning Saya</h3> 
    </div>
    <div class="col-sm-6 col-lg-4 mb-3 mb-lg-0">
        <div class="d-flex justify-content-center align-items-center p-4 bg-orange bg-opacity-15 rounded-3"> <span class="display-6 lh-1 text-orange mb-0"><i class="fas fa-tv fa-fw"></i></span>
            <div class="ms-4">
                <div class="d-flex">
                    <h5 class="purecounter mb-0 fw-bold" data-purecounter-start="0" data-purecounter-end="9" data-purecounter-delay="200">0</h5> </div>
                <p class="mb-0 h6 fw-light">Total Courses</p>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-4 mb-3 mb-lg-0">
        <div class="d-flex justify-content-center align-items-center p-4 bg-purple bg-opacity-15 rounded-3"> <span class="display-6 lh-1 text-purple mb-0"><i class="fas fa-clipboard-check fa-fw"></i></span>
            <div class="ms-4">
                <div class="d-flex">
                    <h5 class="purecounter mb-0 fw-bold" data-purecounter-start="0" data-purecounter-end="52" data-purecounter-delay="200">0</h5> </div>
                <p class="mb-0 h6 fw-light">Complete lessons</p>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-4 mb-3 mb-lg-0">
        <div class="d-flex justify-content-center align-items-center p-4 bg-success bg-opacity-10 rounded-3"> <span class="display-6 lh-1 text-success mb-0"><i class="fas fa-medal fa-fw"></i></span>
            <div class="ms-4">
                <div class="d-flex">
                    <h5 class="purecounter mb-0 fw-bold" data-purecounter-start="0" data-purecounter-end="8" data-purecounter-delay="300">0</h5> </div>
                <p class="mb-0 h6 fw-light">Achieved Certificates</p>
            </div>
        </div>
    </div>
</div>
<table id="example" class="display" style="width:100%">
    <thead>
        <tr>
            <th>Judul</th>
            <th>Penulis</th>
            <th>Kategori</th>
            <th>Topik</th>
            <th>Status</th>
            <th>Timestamp</th>
        </tr>
    </thead>
    <tbody>
        @foreach ( $knows->where('user_id', auth()->user()->id) as $know )
        <tr>
            <td>{{$know->title}}</td>
            <td>{{$know->writer}}</td>
            <td>{{$know->category->name}}</td>
            <td>{{$know->topic->name}}</td>
            <td>
                @if ($know->status == 1)
                <i class="fas fa-check-circle text-success me-2"></i> Terverifikasi
                @else
                <i class="bi bi-patch-exclamation-fill text-danger me-2"></i> Belum diverifikasi
                @endif
            </td>
            <td>{{$know->created_at}}</td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th>Judul</th>
            <th>Penulis</th>
            <th>Kategori</th>
            <th>Topik</th>
            <th>Status</th>
            <th>Timestamp</th>
        </tr>
    </tfoot>
</table>
@endsection