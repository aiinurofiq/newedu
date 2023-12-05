@extends('layouts-landing.app')
@section('content-landing')
    <main>
        <section class="py-0">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="bg-light p-4 text-center rounded-3">
                            <h1 class="m-0">Request</h1>
                            <div class="d-flex justify-content-center">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb breadcrumb-dots mb-0">
                                        <li class="breadcrumb-item">
                                            <a href="#">Home</a>
                                        </li>
                                        <li class="breadcrumb-item">
                                            <a href="#">Learning</a>
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">Request</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="pt-5">
            <div class="container" data-sticky-container>
                <div class="row g-4 g-sm-5">
                    <div class="col-xl-4">
                        <div data-sticky data-margin-top="80" data-sticky-for="992">
                            <div class="row justify-content-center">
                                <div class="col-md-8 col-xl-12">
                                    <div class="card shadow">
                                        <div class="rounded-3"> <img
                                                src="{{ $learns->image ? asset(\Storage::url($learns->image)) : '' }}"
                                                class="card-img-top" alt="book image"> </div>
                                        <div class="card-body">
                                            <div class="text-center d-grid">
                                                @if ($ltransaction ?? 0)
                                                    <button class="btn btn-secondary disabled mb-2 me-00 me-sm-3"><i
                                                            class="bi bi-hourglass-bottom me-2"></i>On Verification</button>
                                                    <button data-bs-toggle="modal" data-bs-target="#exampleModal"
                                                        class="btn btn-success mb-2 mb-sm-0 me-00 me-sm-3"><i
                                                            class="bi bi-receipt me-1"></i>Check Status</button>
                                            </div>
                                        @else
                                            <a href="{{ route('checkout', ['id' => encrypt($learns->id)]) }}"
                                                class="btn btn-success mb-2 mb-sm-0 me-00 me-sm-3"><i
                                                    class="bi bi-cart3 me-2"></i>Checkout</a>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-8">
                    <h1 class="mb-4">{{ $learns->title }}</h1>
                    <ul class="list-inline mb-4">
                        <li class="list-inline-item">
                            <input type="radio" class="btn-check" name="options" id="option1" checked>
                            <label class="btn btn-success-soft-check" for="option1"> <span
                                    class="mb-2 h6 fw-light">Price</span> <span class="d-flex align-items-center">
                                    <span
                                        class="mb-0 h5 me-2 text-success">{{ 'Rp. ' . format_uang($learns->price) }}</span>
                            </label>
                        </li>
                    </ul>
                    <h4>Description</h4>
                    <p>{{ $learns->description }}</p>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <ul class="list-group list-group-borderless">
                                <li class="list-group-item px-0"> <span class="h6 fw-light"><i
                                            class="bi fa-fw bi-calendar-fill text-primary me-2"></i>Published
                                        date:</span> <span class="h6">{{ $learns->created_at->format('d M Y') }}</span>
                                </li>
                                <li class="list-group-item px-0"> <span class="h6 fw-light"><i
                                            class="fas fa-fw fa-book text-primary me-2"></i>Section count:</span> <span
                                        class="h6">{{ $section->count() }}</span> </li>
                                <li class="list-group-item px-0"> <span class="h6 fw-light"><i
                                            class="bi fa-fw bi-bag-fill text-primary me-2"></i>Topic:</span> <span
                                        class="h6">
                                        @if ($learns->type == 0)
                                            Beginner
                                        @else
                                            @if ($learns->type == 1)
                                                Intermediate
                                            @else
                                                Advanced
                                            @endif
                                        @endif
                                    </span> </li>

                            </ul>
                        </div>
                        <div class="col-md-6">
                            <ul class="list-group list-group-borderless">
                                <li class="list-group-item px-0"> <span class="h6 fw-light"><i
                                            class="bi fa-fw bi-person-circle text-primary me-2"></i>Published by:</span>
                                    <span class="h6">{{ $learns->user->name }}</span>
                                </li>
                                <li class="list-group-item px-0"> <span class="h6 fw-light"><i
                                            class="bi fa-fw bi-eye-fill text-primary me-2"></i>Category:</span> <span
                                        class="h6">{{ $learns->categorylearn->name }}</span> </li>
                            </ul>
                        </div>
                    </div>
                    <p>Learning ini dibatasi kepada beberapa pengguna. Untuk dapat mengakses learning ini silahkan
                        checkout terlebih dahulu.</p>
                    <div class="col-12">
                        <ul class="nav nav-pills nav-pills-bg-soft px-3" id="book-pills-tab" role="tablist">
                            <li class="nav-item me-2 me-sm-4" role="presentation">
                                <button class="nav-link mb-0 active" id="book-pills-tab-1" data-bs-toggle="pill"
                                    data-bs-target="#book-pills-1" type="button" role="tab"
                                    aria-controls="book-pills-1" aria-selected="true">Author</button>
                            </li>
                        </ul>
                        <div class="tab-content pt-4 px-3" id="book-pills-tabContent">
                            <div class="tab-pane fade show active" id="book-pills-1" role="tabpanel"
                                aria-labelledby="book-pills-tab-1">
                                <div class="row g-4">
                                    <div class="col-md-3"> <img
                                            src="{{ $learns->user->profile_photo_path ? \Storage::url($learns->user->profile_photo_path) : '' }}"
                                            class="rounded-3" alt=""> </div>
                                    <div class="col-md-9">
                                        <div class="d-sm-flex justify-content-sm-between">
                                            <div class="mb-3">
                                                <h3 class="mb-0">{{ $learns->user->name }}</h3> <span>Publisher</span>
                                            </div>

                                        </div>
                                        <P class="mt-3 mt-sm-0 mb-0">{{ $learns->user->name }} merupakan author yang
                                            mengupload Learning {{ $learns->title }} yang diupload pada tanggal
                                            {{ $learns->created_at->format('d F Y') }} dengan jumlah
                                            {{ $section->count() }} Section.</P>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @if ($ltransaction ?? 0)
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Status Transaction</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row mb-3">
                                <div class="col-3 mt-3 h6">Name</div>
                                <div class="col-9"><input type="text" class="form-control" value="{{ $ltransaction->user->name }}"
                                        aria-label="Username" aria-describedby="basic-addon1" disabled></div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-3 mt-2 h6">Email address</div>
                                <div class="col-9"><input type="text" class="form-control" value="{{ $ltransaction->user->email }}"
                                        aria-label="Username" aria-describedby="basic-addon1" disabled></div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-3 mt-2 h6">Mobile number</div>
                                <div class="col-9"><input type="text" class="form-control" value="{{ $ltransaction->user->phone }}"
                                        aria-label="Username" aria-describedby="basic-addon1" disabled></div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-3 mt-2 h6">Payment</div>
                                <div class="col-9"><input type="text" class="form-control" value="{{$ltransaction->lpayment->name}} - {{$ltransaction->lpayment->accnumber}}"
                                        aria-label="Username" aria-describedby="basic-addon1" disabled></div>
                            </div>
                            @if ($ltransaction->coupon_id != 1)
                                
                            <div class="row mb-3">
                                <div class="col-3 mt-2 h6">Price</div>
                                <div class="col-9"><input type="text" class="form-control" value="{{ 'Rp. ' . format_uang($ltransaction->learning->price) }}"
                                        aria-label="Username" aria-describedby="basic-addon1" disabled></div>
                            </div>
                            
                            <div class="row mb-3">
                                <div class="col-3 mt-2 h6">Coupon Applied</div>
                                <div class="col-9"><input type="text" class="form-control" value="{{ 'Rp. ' . format_uang($ltransaction->learning->price - $ltransaction->totalamount) }}"
                                        aria-label="Username" aria-describedby="basic-addon1" disabled></div>
                            </div>
                            @endif
                            <div class="row mb-3">
                                <div class="col-3 mt-2 h6">Total</div>
                                <div class="col-9"><input type="text" class="form-control" value="{{ 'Rp. ' . format_uang($ltransaction->totalamount) }}"
                                        aria-label="Username" aria-describedby="basic-addon1" disabled></div>
                            </div>
                            <hr>
                            <p class="ms-2"><span class="fw-bold">Note :</span> Silahkan melakukan payment sesuai transaksi diatas. Jika anda sudah melakukan transaksi, silahkan menunggu konfirmasi dari kami. Terima Kasih!</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </main>
@endsection
