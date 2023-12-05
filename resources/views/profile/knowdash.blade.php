@extends('app-landing.accdash')
@section('content-profile')
<div class="row mb-4">
    <div class="col-sm-6 col-lg-4 mb-3 mb-lg-0">
        <div class="d-flex justify-content-center align-items-center p-4 bg-orange bg-opacity-15 rounded-3"> <span class="display-6 lh-1 text-orange mb-0"><i class="fas fa-book"></i></span>
            <div class="ms-4">
                <div class="d-flex">
                    <h5 class="purecounter mb-0 fw-bold" data-purecounter-start="0" data-purecounter-end="{{$knows->where('user_id', auth()->user()->id)->count()}}" data-purecounter-delay="200">0</h5> </div>
                <p class="mb-0 h6 fw-light">Total Knowledge dikirim</p>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-4 mb-3 mb-lg-0">
        <div class="d-flex justify-content-center align-items-center p-4 bg-purple bg-opacity-15 rounded-3"> <span class="display-6 lh-1 text-purple mb-0"><i class="fas fa-book"></i></span>
            <div class="ms-4">
                <div class="d-flex">
                    <h5 class="purecounter mb-0 fw-bold" data-purecounter-start="0" data-purecounter-end="{{$reqknows->where('user_id', auth()->user()->id)->count()}}" data-purecounter-delay="200">0</h5> </div>
                <p class="mb-0 h6 fw-light">Total Permintaan Knowledge</p>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-4 mb-3 mb-lg-0">
        <div class="d-flex justify-content-center align-items-center p-4 bg-success bg-opacity-10 rounded-3"> <span class="display-6 lh-1 text-success mb-0"><i class="fas fa-book"></i></span>
            <div class="ms-4">
                <div class="d-flex">
                    <h5 class="purecounter mb-0 fw-bold" data-purecounter-start="0" data-purecounter-end="{{$knows->where('status', 1)->count()}}" data-purecounter-delay="300">0</h5> </div>
                <p class="mb-0 h6 fw-light">Total Knowledge Terpublish</p>
            </div>
        </div>
    </div>
</div>
@endsection