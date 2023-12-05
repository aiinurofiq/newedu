@extends('layouts-landing.app')

@section('content-landing')
<section class="py-4">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="bg-light p-4 text-center rounded-3">
                    <h1 class="m-0">Learning</h1>
                    <div class="d-flex justify-content-center">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb breadcrumb-dots mb-0">
                                <li class="breadcrumb-item">
                                    <a href="#">Home</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Semua Learning
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="pt-0">
    <div class="container">
        <livewire:filter-learn/></livewire:filter-learn>
        <div class="row mt-3">
            <livewire:show-learn/></livewire:show-learn>
        </div>
    </div>
</section>
@endsection
