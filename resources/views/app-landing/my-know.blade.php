@extends('app-landing.accdash')
@section('content-profile')
{{-- <form class="bg-light border p-4 rounded-3 my-4 z-index-9 position-relative">
    <div class="row g-3">
        <button
            type="button"
            class="btn btn-primary mb-0 rounded z-index-1 w-100"
            data-bs-toggle="modal" data-bs-target="#exampleModal"
        >
            <i class="fas fa-plus"></i> Kirim Knowledge
        </button>
        
        
    </div>
</form> --}}
<!-- Modal -->
{{-- <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <x-form
                method="POST"
                action="{{ route('knowledges.store') }}"
                has-files
                class="mt-4"
            >
                @include('app.knowledges.form-inputs')

                <div class="mt-4">
                        <i class="icon ion-md-return-left text-primary"></i>
                        @lang('crud.common.back')
                    </a>

                    <button type="submit" class="btn btn-primary float-right">
                        <i class="icon ion-md-save"></i>
                        @lang('crud.common.create')
                    </button>
                </div>
            </x-form>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
    </div>
    </div>
</div> --}}

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