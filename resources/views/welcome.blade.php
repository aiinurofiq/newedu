@extends('layouts-landing.app')
@section('content-landing')
<section class="pt-0 position-relative overflow-hidden h-700px h-sm-600px h-lg-700px rounded-top-4 mx-2 mx-md-4" style="background-image:url({{asset('bg.jpg')}}); background-position: center; background-size: cover;">
    <div class="bg-overlay bg-dark opacity-5"></div>
    <figure class="position-absolute bottom-0 left-0 w-100 d-md-block mb-n3 z-index-9" style="margin-left:-20px;">
        <svg class="fill-body" width="110%" height="150" viewBox="0 0 500 150" preserveAspectRatio="none">
            <path d="M0,150 L0,40 Q250,150 500,40 L580,150 Z"></path>
        </svg>
    </figure>
    <div class="container z-index-9 position-relative">
        <div class="row py-0 py-md-5 align-items-center text-center text-sm-start">
            <div class="col-sm-10 col-lg-8 col-xl-6 all-text-white my-5 mt-md-0">
                <div class="py-0 py-md-5 my-5">
                    <div class="d-inline-block bg-white px-3 py-2 rounded-pill mb-3">
                        <p class="mb-0 text-dark"><span class="badge text-bg-success rounded-pill me-1">New</span> Knowledge Updated</p>
                    </div>
                    <h1 class="text-white display-5">Start learning from <span class="text-warning">best platform</span></h1>
                    <p class="text-white">JTlearning is online learning and teaching from Perum Jasa Tirta I. Taught by experts to help you acquire new skills.</p>
                    <div class="d-sm-flex align-items-center mt-4"> <a href="#" class="btn btn-primary me-2 mb-4 mb-sm-0 d-none">Get Started</a>
                        <div class="d-flex align-items-center justify-content-center py-2 ms-0 ms-sm-4 d-none">
                            <a data-glightbox data-gallery="office-tour" href="https://www.youtube.com/embed/tXHviS-4ygo" class="btn btn-round btn-white-shadow text-danger me-7 mb-0 overflow-visible"> <i class="fas fa-play"></i>
                                <h6 class="mb-0 ms-3 text-white fw-normal position-absolute start-100 top-50 translate-middle-y">Watch video</h6> </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
    
    <section class="py-0 py-xl-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-sm-6 col-xl-3">
                    <div class="d-flex justify-content-center align-items-center p-4 bg-warning bg-opacity-15 rounded-3">
                        <span class="display-6 lh-1 text-warning mb-0"><i class="fas fa-tv"></i></span>
                        <div class="ms-4 h6 fw-normal mb-0">
                            <div class="d-flex">
                                <h5 class="purecounter mb-0 fw-bold" data-purecounter-start="0"
                                    data-purecounter-end="{{ $jurnal->count() }}" data-purecounter-delay="200">
                                    0
                                </h5>
                                <span class="mb-0 h5">+ Jurnals</span>
                            </div>
                            <p class="mb-0">Courses</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-3">
                    <div class="d-flex justify-content-center align-items-center p-4 bg-blue bg-opacity-10 rounded-3">
                        <span class="display-6 lh-1 text-blue mb-0"><i class="fas fa-user-tie"></i></span>
                        <div class="ms-4 h6 fw-normal mb-0">
                            <div class="d-flex">
                                <h5 class="purecounter mb-0 fw-bold" data-purecounter-start="0"
                                    data-purecounter-end="{{ $exsum->count() }}" data-purecounter-delay="200">
                                    0
                                </h5>
                                <span class="mb-0 h5">+ Exsums</span>
                            </div>
                            <p class="mb-0"> Courses</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-3">
                    <div class="d-flex justify-content-center align-items-center p-4 bg-purple bg-opacity-10 rounded-3">
                        <span class="display-6 lh-1 text-purple mb-0"><i class="fas fa-user-graduate"></i></span>
                        <div class="ms-4 h6 fw-normal mb-0">
                            <div class="d-flex">
                                <h5 class="purecounter mb-0 fw-bold" data-purecounter-start="0"
                                    data-purecounter-end="{{ $explanation->count() }}" data-purecounter-delay="200">
                                    0
                                </h5>
                                <span class="mb-0 h6">+ Explanations</span>
                            </div>
                            <p class="mb-0"> Courses</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-3">
                    <div class="d-flex justify-content-center align-items-center p-4 bg-info bg-opacity-10 rounded-3">
                        <span class="display-6 lh-1 text-info mb-0"><i class="bi bi-patch-check-fill"></i></span>
                        <div class="ms-4 h6 fw-normal mb-0">
                            <div class="d-flex">
                                <h5 class="purecounter mb-0 fw-bold" data-purecounter-start="0"
                                    data-purecounter-end="{{ $report->count() }}" data-purecounter-delay="300">
                                    0
                                </h5>
                                <span class="mb-0 h5">+ Reports</span>
                            </div>
                            <p class="mb-0"> Courses</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
<section>
    <div class="container">
        <div class="row g-4 align-items-center">
            <div class="col-lg-5">
                <h2>Find Out More About us, <span class="text-warning">JTLearning</span> insides.</h2> <img src="{{asset('bg2.jpg')}}" class="rounded-2" alt=""> </div>
            <div class="col-lg-7">
                <div class="row g-4">
                    <div class="col-sm-6">
                        <div class="icon-lg bg-orange bg-opacity-10 text-orange rounded-2"><i class="fas fa-user-tie fs-5"></i></div>
                        <h5 class="mt-2">Learn with Experts</h5>
                        <p class="mb-0">Connect with a community of like-minded learners, exchange ideas, and thrive in your chosen field. Unlock your potential and stay ahead with the guidance of seasoned experts on "Learn with Experts."</p>
                    </div>
                    <div class="col-sm-6">
                        <div class="icon-lg bg-info bg-opacity-10 text-info rounded-2"><i class="fas fa-book fs-5"></i></div>
                        <h5 class="mt-2">Learn Anything</h5>
                        <p class="mb-0">No matter your interests or expertise level, this platform offers a vast array of courses spanning diverse subjects, empowering you to explore, discover, and master anything you desire.</p>
                    </div>
                    <div class="col-sm-6">
                        <div class="icon-lg bg-success bg-opacity-10 text-success rounded-2"><i class="bi bi-alarm-fill fs-5"></i></div>
                        <h5 class="mt-2">Flexible Learning</h5>
                        <p class="mb-0">Engage with content through various mediums, including video lectures, interactive assignments, and collaborative projects, providing a dynamic and customizable learning experience.</p>
                    </div>
                    <div class="col-sm-6">
                        <div class="icon-lg bg-purple bg-opacity-10 text-purple rounded-2"><i class="fas fa-university fs-5"></i></div>
                        <h5 class="mt-2">Industrial Standards</h5>
                        <p class="mb-0">Whether you're a beginner or an experienced professional, our curated content ensures an enriching learning experience.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
    {{-- Start Knowledge --}}
    <section>
        <div class="container">
            <div class="row mb-4">
                <div class="col-lg-8 mx-auto text-center">
                    <h2 class="fs-1">Knowledge Update</h2>
                    <p class="mb-0">
                        Knowledge Provides Journals, Exsums, Reports, and Explanations for Internal PJT I
                    </p>
                </div>
            </div>
            <div class="tab-content" id="course-pills-tabContent">

                <div class="row g-4">
                    @forelse ($knows as $know)
                        @if ($know->status == 1 && $know->ispublic == 1)
                            <div class="col-sm-6 col-lg-4 col-xl-3">
                                <div class="card shadow h-100">
                                    <img src="{{ $know->photo ? asset(\Storage::url($know->photo)) : '' }}"
                                        class="card-img-top" alt="course image" />
                                    <div class="card-body pb-0">
                                        <div class="d-flex justify-content-between mb-2">
                                            <a href="{{ route('knows-detail', ['id' => encrypt($know->id)]) }}"
                                                class="badge bg-blue bg-opacity-10 text-purple">{{ $know->topic->name }}</a>
                                        </div>
                                        <h5 class="card-title fw-normal">
                                            <a
                                                href="{{ route('knows-detail', ['id' => encrypt($know->id)]) }}">{{ $know->title }}</a>
                                        </h5>
                                        <p class="mb-2 text-truncate-2">
                                            {{ $know->abstract }}
                                        </p>
                                    </div>
                                    <div class="card-footer pt-0 pb-3">
                                        <hr />
                                        <div class="d-flex justify-content-between">
                                            <span class="h6 fw-light mb-0"><i
                                                    class="far fa-clock text-danger me-2"></i>By:{{ $know->writer }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @empty
                        Data Tidak Tersedia
                    @endforelse
                </div>
            </div>
        </div>
    </section>
    {{-- End Knowledge --}}
    {{-- Start Learning --}}
    <section>
        <div class="container d-none">
            <div class="row mb-4">
                <div class="col-lg-8 mx-auto text-center">
                    <h2 class="fs-1">Learning Update</h2>
                    <p class="mb-0">
                        Learn All You Can to Enhance Your Skills and Knowledge
                    </p>
                </div>
            </div>
            <div class="tab-content" id="course-pills-tabContent">

                <div class="row g-4">
                    @forelse ($learns as $learn)
                        @if ($learn->ispublic == 1)
                            <div class="col-sm-6 col-lg-4 col-xl-3">
                                <div class="card shadow h-100">
                                    <img src="{{ $learn->image ? asset(\Storage::url($learn->image)) : '' }}"
                                        class="card-img-top" alt="course image" />
                                    <div class="card-body pb-0">
                                        <div class="d-flex justify-content-between mb-2">
                                            <a href="{{ route('learns-detail', ['id' => encrypt($learn->id)]) }}"
                                                class="badge bg-blue bg-opacity-10 text-purple">{{ $learn->categorylearn->name }}</a>
                                        </div>
                                        <h5 class="card-title fw-normal">
                                            <a
                                                href="{{ route('learns-detail', ['id' => encrypt($learn->id)]) }}">{{ $learn->title }}</a>
                                        </h5>
                                        <p class="mb-2 text-truncate-2">
                                            {{ $learn->description }}
                                        </p>
                                    </div>
                                    <div class="card-footer pt-0 pb-3">
                                        <hr />
                                        <div class="d-flex justify-content-between">
                                            <span class="h6 fw-light mb-0"><i
                                                    class="far fa-clock text-danger me-2"></i>By:{{ $know->user->name }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @empty
                        Data Tidak Tersedia
                    @endforelse
                </div>
            </div>
        </div>
    </section>
    {{-- End Learning --}}
    <section class="pt-0 pt-lg-5">
        <div class="container position-relative">
            <figure class="position-absolute top-50 start-50 translate-middle ms-2">
                <svg>
                    <path class="fill-white opacity-4"
                        d="m496 22.999c0 10.493-8.506 18.999-18.999 18.999s-19-8.506-19-18.999 8.507-18.999 19-18.999 18.999 8.506 18.999 18.999z" />
                    <path class="fill-white opacity-4"
                        d="m775 102.5c0 5.799-4.701 10.5-10.5 10.5-5.798 0-10.499-4.701-10.499-10.5 0-5.798 4.701-10.499 10.499-10.499 5.799 0 10.5 4.701 10.5 10.499z" />
                    <path class="fill-white opacity-4"
                        d="m192 102c0 6.626-5.373 11.999-12 11.999s-11.999-5.373-11.999-11.999c0-6.628 5.372-12 11.999-12s12 5.372 12 12z" />
                    <path class="fill-white opacity-4"
                        d="m20.499 10.25c0 5.66-4.589 10.249-10.25 10.249-5.66 0-10.249-4.589-10.249-10.249-0-5.661 4.589-10.25 10.249-10.25 5.661-0 10.25 4.589 10.25 10.25z" />
                </svg>
            </figure>
            <div class="row">
                <div class="col-12">
                    <div class="bg-info p-4 p-sm-5 rounded-3">
                        <div class="row position-relative">
                            <figure class="fill-white opacity-1 position-absolute top-50 start-0 translate-middle-y">
                                <svg width="141px" height="141px">
                                    <path
                                        d="M140.520,70.258 C140.520,109.064 109.062,140.519 70.258,140.519 C31.454,140.519 -0.004,109.064 -0.004,70.258 C-0.004,31.455 31.454,-0.003 70.258,-0.003 C109.062,-0.003 140.520,31.455 140.520,70.258 Z" />
                                </svg>
                            </figure>
                            <div class="col-11 mx-auto position-relative">
                                <div class="row align-items-center">
                                    <div class="col-lg-7">
                                        <h3 class="text-white">Knowledge and Learning Management System Perum Jasa Tirta I
                                        </h3>
                                        <p class="text-white mb-3 mb-lg-0">
                                            Knowledge and Learning for All Employees in Perum Jasa Tirta I
                                        </p>
                                    </div>
                                    <div class="col-lg-5 text-lg-end d-none">
                                        <a href="#" class="btn btn-outline-warning mb-0">Start Now!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
