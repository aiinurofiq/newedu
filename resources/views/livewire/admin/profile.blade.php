<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <!-- User Sidebar -->
        <div class="col-xl-4 col-lg-5 col-md-5 order-1 order-md-0">
            <!-- User Card -->
            <div class="card mb-4">
                <div class="card-body">
                    <div class="user-avatar-section">
                        <div class="d-flex align-items-center flex-column">
                            <img class="img-fluid rounded mb-3 pt-1 mt-4" src="{{asset('icon.png')}}"
                                height="100" width="100" alt="User avatar" />
                            <div class="user-info text-center">
                                <h4 class="mb-2">{{ auth()->user()->name }}</h4>
                                <span class="badge bg-label-secondary mt-1">{{ auth()->user()->name }}</span>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <p class="mt-4 small text-uppercase text-muted">Details</p>
                    <div class="info-container">
                        <ul class="list-unstyled">
                            <li class="mb-2">
                                <span class="fw-semibold me-1">Username :</span>
                                <span>{{ auth()->user()->name }}</span>
                            </li>
                            <li class="mb-2 pt-1">
                                <span class="fw-semibold me-1">Email :</span>
                                <span>{{ auth()->user()->email }}</span>
                            </li>
                            <li class="mb-2 pt-1">
                                <span class="fw-semibold me-1">Akun dibuat :</span>
                                <span>{{ auth()->user()->created_at ? date_format(auth()->user()->created_at, 'd F Y') : '-' }}</span>
                            </li>
                            <li class="mb-2 pt-1">
                                <span class="fw-semibold me-1">Akun update:</span>
                                <span>{{ auth()->user()->updated_at ? date_format(auth()->user()->updated_at, 'd F Y') : '-' }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /User Card -->
        </div>
        <div class="col-xl-8 col-lg-7 col-md-7 order-0 order-md-1">
            <!-- User Pills -->
            <ul class="nav nav-pills flex-column flex-md-row mb-4">
                <li class="nav-item">
                    <button wire:click="$set('action', 'R')" class="nav-link {{ $action == 'R' || $action == 'U' ? 'active' : '' }}"><i
                            class="ti ti-user-check ti-xs me-1"></i>Account</button>
                </li>
            </ul>
            <!--/ User Pills -->

            <div class="card card-action mb-4 {{ $action == 'R' || $action == 'U' ? '' : 'd-none' }}">
                <div class="card-header align-items-center">
                    <h5 class="card-action-title mb-0">Profile Info</h5>
                    
                </div>
                <div class="card-body">
                    <div class="{{ $action == 'R' ? '' : 'd-none' }}">
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-fullname">Full Name</label>
                            <input type="text" class="form-control" placeholder="John Doe"
                                value="{{ auth()->user()->name }}" disabled />
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-company">Divisi</label>
                            <input type="text" class="form-control" id="basic-default-company"
                                placeholder="ACME Inc." value="{{ auth()->user()->nik }}" disabled />
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-phone">Sub Divisi</label>
                            <input type="text" id="basic-default-phone" class="form-control phone-mask"
                                placeholder="658 799 8941" value="{{ auth()->user()->npwp }}" disabled />
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-email">Email</label>
                            <input type="text" id="basic-default-email" class="form-control" placeholder="john.doe"
                                aria-label="john.doe" aria-describedby="basic-default-email2"
                                value="{{ auth()->user()->email }}" disabled />
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-email">Kopeg</label>
                            <input type="text" id="basic-default-email" class="form-control" placeholder="-"
                                aria-label="-" aria-describedby="basic-default-email2" value="{{ auth()->user()->kopeg }}"
                                disabled />
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="basic-default-email">Alamat</label>
                            <input type="text" id="basic-default-email" class="form-control" placeholder="-"
                                aria-label="-" aria-describedby="basic-default-email2"
                                value="{{ auth()->user()->address }}" disabled />
                        </div>
                    </div>
                    
                </div>
            </div>

            
            <!--/ Change Password -->

            <!--/ Billing Address -->
        </div>
        <!--/ User Content -->
        <!--/ User Sidebar -->
    </div>

</div>
@section('script')
    <script>
        const select2 = $('.select2')
        if (select2.length) {
            select2.each(function() {
                var $this = $(this);
                $this.wrap('<div class="position-relative"></div>').select2({
                    placeholder: 'Select value',
                    dropdownParent: $this.parent()
                });
            });
        }
        $('#divisi').on('change', function(e) {
            var data = $('#divisi').select2("val");
            @this.set('subdivisi', data);
        });
        $('#strata').on('change', function(e) {
            var data = $('#strata').select2("val");
            @this.set('strata', data);
        });

        function kirim(value) {
            event.preventDefault();
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Akses akan dihapus!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Iya saya yakin!',
                customClass: {
                    confirmButton: 'btn btn-primary me-3',
                    cancelButton: 'btn btn-label-secondary'
                },
                buttonsStyling: false
            }).then(function(result) {
                if (result.value) {
                    window.livewire.emit('hapus', value);
                }
            });
        }
        document.addEventListener("livewire:load", function(event) {
            window.livewire.on('notif', (param) => {
                Swal.fire({
                    title: param.title,
                    text: param.text,
                    icon: param.icon,
                    customClass: {
                        confirmButton: 'btn btn-primary'
                    },
                    buttonsStyling: false
                });
                $("#addNewCCModal").modal('hide');
            });
            window.livewire.on('strata', (param) => {
                Swal.fire({
                    title: 'Terdapat form yang belum diisi!',
                    text: ' Isian harap dicek kembali!',
                    icon: 'error',
                    customClass: {
                        confirmButton: 'btn btn-primary'
                    },
                    buttonsStyling: false
                });
            });
        });
    </script>
@endsection
