<div>
    <main>
        <section class="py-0">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="bg-light p-4 text-center rounded-3">
                            <h1 class="m-0">Checkout</h1>
                            <div class="d-flex justify-content-center">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb breadcrumb-dots mb-0">
                                        <li class="breadcrumb-item">
                                            <a href="#">Learning</a>
                                        </li>
                                        <li class="breadcrumb-item">
                                            <a href="#">Request</a>
                                        </li>
                                        <li class="breadcrumb-item">
                                            <a href="#">Cart</a>
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="pt-5">
            <div class="container">
                <div class="row g-4 g-sm-5">
                    <div class="col-xl-8 mb-4 mb-sm-0">
                        <div class="alert alert-danger alert-dismissible d-flex justify-content-between align-items-center fade show py-2 pe-2"
                            role="alert">
                            <div>
                                <i class="bi bi-exclamation-octagon-fill me-2"></i> Sebelum checkout harap periksa
                                terlebih
                                dahulu <a href="#" class="text-reset btn-link mb-0 fw-bold">(Learning)</a>
                            </div>
                            <button type="button" class="btn btn-link mb-0 text-primary-hover text-end"
                                data-bs-dismiss="alert" aria-label="Close">
                                <i class="bi bi-x-lg"></i>
                            </button>
                        </div>
                        <div class="card card-body shadow p-4">
                            <h5 class="mb-0">Personal Details</h5>
                            <form class="row g-3 mt-0">
                                <div class="col-md-6 bg-light-input">
                                    <label for="yourName" class="form-label">Your name *</label>
                                    <input type="text" class="form-control" id="yourName" placeholder="Name"
                                        value="{{ auth()->user()->name }}" disabled>
                                </div>
                                <div class="col-md-6 bg-light-input">
                                    <label for="postalCode" class="form-label">Kopeg *</label>
                                    <input type="text" class="form-control" id="postalCode" placeholder="PIN code"
                                        value="{{ auth()->user()->kopeg }}" disabled>
                                </div>
                                <div class="col-md-6 bg-light-input">
                                    <label for="emailInput" class="form-label">Email address *</label>
                                    <input type="email" class="form-control" id="emailInput" placeholder="Email"
                                        value="{{ auth()->user()->email }}" disabled>
                                </div>
                                <div class="col-md-6 bg-light-input">
                                    <label for="mobileNumber" class="form-label">Mobile number *</label>
                                    <input type="text" class="form-control" id="mobileNumber"
                                        placeholder="Mobile number" value="{{ auth()->user()->phone }}" disabled>
                                </div>
                                <div class="col-md-6 bg-light-input">
                                    <label for="address" class="form-label">Address *</label>
                                    <input type="text" class="form-control" id="address" placeholder="Address"
                                        value="{{ auth()->user()->address }}" disabled>
                                </div>
                            </form>
                            <div class="row g-3 mt-4">
                                <h5 class="">Payment method</h5>
                                <div class="col-12">
                                    <div class="accordion accordion-circle" id="accordioncircle">

                                        <div class="accordion-item mb-3">
                                            <h6 class="accordion-header" id="heading-2">
                                                <button class="accordion-button collapsed rounded" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapse-2"
                                                    aria-expanded="true" aria-controls="collapse-2"> Pay with Net
                                                    Banking
                                                </button>
                                            </h6>
                                            <div id="collapse-2" class="accordion-collapse collapse show"
                                                aria-labelledby="heading-2" data-bs-parent="#accordioncircle">
                                                <div class="accordion-body">
                                                    <form class="row text-start g-3">
                                                        <p class="mb-1">In order to complete your transaction, you
                                                            need to
                                                            transfer in our account bank.</p>
                                                        <p class="my-0">Select your bank from the drop-down list and
                                                            click proceed to continue with your payment.</p>
                                                        <div class="col-md-6">
                                                            <select
                                                                class="form-select form-select-sm border-0"
                                                                aria-label=".form-select-sm" id='payment'>
                                                                {{-- <option value="">Please choose one</option> --}}
                                                                @foreach ($lpayment as $item)
                                                                    <option value="{{ $item->id }}"
                                                                        >{{ $item->name }} - {{ $item->accnumber }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4">
                        <div class="row mb-0">
                            <div class="col-md-6 col-xl-12">
                                <div class="card card-body shadow p-4 mb-4">
                                    <h4 class="mb-4">Order Summary</h4>
                                    <div class="mb-3">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span>Transaction code</span>
                                            <p class="mb-0 h6 fw-light">AB12365E</p>
                                        </div>
                                        <div class="input-group mt-2">
                                            <input wire:model="code" class="form-control form-control"
                                                placeholder="COUPON CODE">
                                            <button wire:click.prevent="coupon" type="button"
                                                class="btn btn-primary">Apply</button>
                                        </div>
                                        @if ($tcode)
                                            @if ($check)
                                                <p class="mb-0 mt-1 text-success fw-bold">* Congratulation you coupon
                                                    <i>{{ $tcode }}</i> is found
                                                </p>
                                            @else
                                                <p class="mb-0 mt-1 text-danger fw-bold">* Coupon {{ $tcode }}
                                                    you entered an invalid discount code. Please check the code and try
                                                    again!</p>
                                            @endif
                                        @endif
                                    </div>
                                    @if ($tcode)
                                        @if ($check)
                                            <li class="list-inline-item">
                                                <input type="radio" class="btn-check" name="options"
                                                    id="option1" checked>
                                                <label class="btn btn-success-soft-check" for="option1"> <span
                                                        class="mb-2 h6 fw-light"><i>Coupon is applied</i></span> <span
                                                        class="d-flex align-items-center">
                                                        <span
                                                            class="mb-0 h5 me-2 text-success">{{ $tcode }}</span>
                                                        <span class="badge text-bg-dark mb-0">
                                                            @if ($check->typecut == 'percentage')
                                                                {{ $check->cutprice }}%
                                                            @else
                                                                {{ 'Rp. ' . format_uang($check->cutprice) }}
                                                            @endif off
                                                        </span> </span>
                                                </label>
                                            </li>
                                        @endif
                                    @endif
                                    <hr>
                                    <div class="row g-3">
                                        <div class="col-sm-4">
                                            <img class="rounded"
                                                src="{{ $learns->image ? asset(\Storage::url($learns->image)) : '' }}"
                                                alt="">
                                        </div>
                                        <div class="col-sm-8">
                                            <h6 class="mb-0">
                                                <a href="#">{{ $learns->title }}</a>
                                            </h6>
                                            <div class="d-flex justify-content-between align-items-center mt-3">
                                                <span
                                                    class="text-success">{{ 'Rp. ' . format_uang($learns->price) }}</span>

                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <ul class="list-group list-group-borderless mb-2">
                                        <li class="list-group-item px-0 d-flex justify-content-between">
                                            <span class="h6 fw-light mb-0">Original Price</span>
                                            <span
                                                class="h6 fw-light mb-0 fw-bold">{{ 'Rp. ' . format_uang($learns->price) }}</span>
                                        </li>
                                        <li class="list-group-item px-0 d-flex justify-content-between">
                                            <span class="h6 fw-light mb-0">Coupon Discount</span>
                                            @if ($check)
                                                @if ($check->typecut == 'percentage')
                                                    <span
                                                        class="text-danger">{{ 'Rp. ' . format_uang($learns->price * ($check->cutprice / 100)) }}</span>
                                                @else
                                                    <span
                                                        class="text-danger">{{ 'Rp. ' . format_uang($check->cutprice) }}</span>
                                                @endif
                                            @else
                                                <span class="text-danger">{{ 'Rp. ' . format_uang(0) }}</span>
                                            @endif
                                        </li>
                                        <li class="list-group-item px-0 d-flex justify-content-between">
                                            <span class="h5 mb-0">Total</span>
                                            @if ($check)
                                                @if ($check->typecut == 'percentage')
                                                    <span
                                                        class="h5 mb-0">{{ 'Rp. ' . format_uang($learns->price - $learns->price * ($check->cutprice / 100)) }}</span>
                                                @else
                                                    @if ($learns->price - $check->cutprice >= 0)
                                                        <span
                                                            class="h5 mb-0">{{ 'Rp. ' . format_uang($learns->price - $check->cutprice) }}</span>
                                                    @else
                                                        <span class="h5 mb-0">{{ 'Rp. ' . format_uang(0) }}</span>
                                                    @endif
                                                @endif
                                            @else
                                                <span
                                                    class="h5 mb-0">{{ 'Rp. ' . format_uang($learns->price) }}</span>
                                            @endif
                                        </li>
                                    </ul>
                                    <div class="d-grid">
                                        <a wire:click.prevent='checkout' href="#"
                                            class="btn btn-lg btn-success">Place Order</a>
                                    </div>
                                    <p class="small mb-0 mt-2 text-center">By completing your purchase, you agree to
                                        these
                                        <a href="#">
                                            <strong>Terms of Service</strong>
                                        </a>
                                    </p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</div>

@push('script')
    <script>
        $(document).ready(function() {
            window.livewire.emit('changepayment', $("#payment").val());
            $("#payment").on("change", function() {
                window.livewire.emit('changepayment', this.value);
                // alert(this.value)
            });
        });
    </script>
@endpush
