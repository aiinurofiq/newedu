@extends('layouts-landing.app')
@section('content-landing')
<section class="pt-0">
    <div class="container-fluid px-0">
        <div class="card bg-blue h-100px h-md-200px rounded-0" style="background:url(assets/images/pattern/04.png) no-repeat center center; background-size:cover;"> </div>
    </div>
    <div class="container mt-n4">
        <div class="row">
            <div class="col-12">
                <div class="card bg-transparent card-body pb-0 px-0 mt-2 mt-sm-0">
                    <div class="row d-sm-flex justify-sm-content-between mt-2 mt-md-0">
                        <div class="col-auto">
                            <div class="avatar avatar-xxl position-relative mt-n3"> <img class="avatar-img rounded-circle border border-white border-3 shadow" src="{{ auth()->user()->profile_photo_path ? asset(\Storage::url(auth()->user()->profile_photo_path)) : '' }}" alt=""> <span class="badge text-bg-success rounded-pill position-absolute top-50 start-100 translate-middle mt-4 mt-md-5 ms-n3 px-md-3">{{ auth()->user()->roles->pluck('name')->implode(', ') }}</span> </div>
                        </div>
                        <div class="col d-sm-flex justify-content-between align-items-center">
                            <div>
                                <h1 class="my-1 fs-4"> {{auth()->user()->name}}</h1>
                                <ul class="list-inline mb-0">
                                    <li class="list-inline-item me-3 mb-1 mb-sm-0"> <span class="h6">{{auth()->user()->email}}</span> <span class="text-body fw-light">({{auth()->user()->phone}})</span> </li>
                                    {{-- <li class="list-inline-item me-3 mb-1 mb-sm-0"> <span class="h6">7</span> <span class="text-body fw-light">Completed courses</span> </li>
                                    <li class="list-inline-item me-3 mb-1 mb-sm-0"> <span class="h6">52</span> <span class="text-body fw-light">Completed lessons</span> </li> --}}
                                </ul>
                            </div>
                            <div class="mt-2 mt-sm-0"> <a href="{{url('/my-profile')}}" class="btn btn-outline-primary mb-0">Lihat Profil Saya</a> </div>
                        </div>
                    </div>
                </div>
                <hr class="d-xl-none">
                <div class="col-12 col-xl-3 d-flex justify-content-between align-items-center"> <a class="h6 mb-0 fw-bold d-xl-none" href="#">Menu</a>
                    <button class="btn btn-primary d-xl-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasSidebar" aria-controls="offcanvasSidebar"> <i class="fas fa-sliders-h"></i> </button>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="pt-0">
    <div class="container">
        <div class="row">
            <div class="col-xl-3">
                <div class="offcanvas-xl offcanvas-end" tabindex="-1" id="offcanvasSidebar">
                    <div class="offcanvas-header bg-light">
                        <h5 class="offcanvas-title" id="offcanvasNavbarLabel">My profile</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#offcanvasSidebar" aria-label="Close"></button>
                    </div>
                    @include('layouts-landing.sidemenu-profile')
                </div>
            </div>
            <div class="col-xl-9">
                @yield('content-profile')
            </div>
        </div>
    </div>
</section>
@endsection
