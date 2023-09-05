@extends('app-landing.accdash')
@section('content-profile')
<form class="bg-light border p-4 rounded-3 my-4 z-index-9 position-relative">
    <div class="row g-3">
        <button
            type="button"
            class="btn btn-primary mb-0 rounded z-index-1 w-100"
            data-bs-toggle="modal" data-bs-target="#exampleModal"
        >
            <i class="fas fa-plus"></i> Kirim Knowledge
        </button>
        
        
    </div>
</form>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="col-12">
                <label class="form-label">Course title</label>
                <input class="form-control" type="text" placeholder="Enter course title"> 
            </div>
            <div class="col-12">
                <label class="form-label">Short description</label>
                <textarea class="form-control" rows="2" placeholder="Enter keywords"></textarea>
            </div>
            <div class="col-md-12">
                <label class="form-label">Course category</label>
                <select class="form-select js-choice border-0 z-index-9 bg-transparent" aria-label=".form-select-sm" data-search-enabled="true">
                    <option value="">Select category</option>
                    <option>Engineer</option>
                    <option>Medical</option>
                    <option>Information technology</option>
                    <option>Finance</option>
                    <option>Marketing</option>
                </select>
            </div>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
        </div>
    </div>
    </div>
</div>

{{-- <form class="bg-light border p-4 rounded-3 my-4 z-index-9 position-relative">
    <div class="row g-3">
        <div class="col-xl-3">
        <input
            class="form-control me-1"
            type="search"
            placeholder="Enter keyword"
        />
        </div>
        <div class="col-xl-8">
        <div class="row g-3">
            <div class="col-sm-6 col-md-3 pb-2 pb-md-0">
            <select
                class="form-select form-select-sm js-choice"
                aria-label=".form-select-sm example"
            >
                <option value="">Categories</option>
                <option>All</option>
                <option>Development</option>
                <option>Design</option>
                <option>Accounting</option>
                <option>Translation</option>
                <option>Finance</option>
                <option>Legal</option>
                <option>Photography</option>
                <option>Writing</option>
                <option>Marketing</option>
            </select>
            </div>
            <div class="col-sm-6 col-md-3 pb-2 pb-md-0">
            <select
                class="form-select form-select-sm js-choice"
                aria-label=".form-select-sm example"
            >
                <option value="">Price level</option>
                <option>All</option>
                <option>Free</option>
                <option>Paid</option>
            </select>
            </div>
            <div class="col-sm-6 col-md-3 pb-2 pb-md-0">
            <select
                class="form-select form-select-sm js-choice"
                aria-label=".form-select-sm example"
            >
                <option value="">Skill level</option>
                <option>All levels</option>
                <option>Beginner</option>
                <option>Intermediate</option>
                <option>Advanced</option>
            </select>
            </div>
            <div class="col-sm-6 col-md-3 pb-2 pb-md-0">
            <select
                class="form-select form-select-sm js-choice"
                aria-label=".form-select-sm example"
            >
                <option value="">Language</option>
                <option>English</option>
                <option>Francas</option>
                <option>Russian</option>
                <option>Hindi</option>
                <option>Bengali</option>
                <option>Spanish</option>
            </select>
            </div>
        </div>
        </div>
        <div class="col-xl-1">
        <button
            type="button"
            class="btn btn-primary mb-0 rounded z-index-1 w-100"
        >
            <i class="fas fa-search"></i>
        </button>
        </div>
    </div>
</form> --}}
<div class="col-12">
    <div class="row g-4">
        @foreach ($knowledges as $knowledge )
        <div class="col-sm-6 col-lg-4 col-xl-3">
            <div class="card shadow h-100">
            <img
                src="{{$knowledge->photo ? \Storage::url($knowledge->photo) : '' }}"
                class="card-img-top"
                alt="course image"
            />
            <div class="card-body pb-0">
                <div class="d-flex justify-content-between mb-2">
                <a
                    href="#"
                    class="badge bg-purple bg-opacity-10 text-purple"
                    >{{$knowledge->topic->name}}</a
                >
                </div>
                <h5 class="card-title">
                    <a href="{{ route('knows-detail', ['id' => encrypt($knowledge->id)]) }}">{{$knowledge->title}}</a>
                </h5>
                <p class="mb-2 text-truncate-2">
					{{$knowledge->abstract}}
				</p>
            </div>
            <div class="card-footer pt-0 pb-3">
                <hr />
                <div class="d-flex justify-content-between">
                    <span class="h6 fw-light mb-0"
                    ><i class="far fa-clock text-danger me-2"></i>By:{{$knowledge->writer}}</span
                  >
                </div>
            </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection