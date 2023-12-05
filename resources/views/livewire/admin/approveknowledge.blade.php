<div class="container-xxl flex-grow-1 container-p-y">
    <div class="d-flex justify-content-between mb-4">
        <h4 class="fw-bold mb-2"><span class="text-muted fw-light">Home /</span> Approve Knowledge</h4>
        
    </div>
    <div class="card mb-4 {{ $action == 'R' ? '' : 'd-none' }}">
        <div class="d-flex justify-content-between ms-4 me-4 mb-3 mt-3">
            <div class="d-flex align-items-center">
                Show <select wire:model='perPage' name="perpage" class="form-select ms-2 me-2">
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="75">75</option>
                    <option value="100">100</option>
                </select> entries</div>
            <div class="d-flex align-items-center">
                <div class="input-group input-group-merge">
                    <span class="input-group-text" id="basic-addon-search31"><i class="ti ti-search"></i></span>
                    <input wire:model='search' type="text" class="form-control" placeholder="Search..."
                        aria-label="Search..." aria-describedby="basic-addon-search31" />
                </div>
            </div>
        </div>

        <div class="table-responsive ms-4 me-4">
            <table class="table">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Title</th>
                        <th class="text-center">Abstract</th>
                        <th class="text-center">Image</th>
                        <th class="text-center">Upload</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @forelse ($data as $item)
                        <tr>
                            <td class="text-center" width='1%'>{{ $loop->index + $data->firstItem() }}</td>
                            <td>{{ $item->title }}</td>
                            <td class="text-center">{{ $item->abstract }}</td>
                            <td class="text-center" width='1%'>
                                <img src="{{ asset(\Storage::url($item->photo)) }}" class="rounded" alt="Shoe img"
                                    height="62" width="62" style="object-fit: cover;" />
                            </td>
                            <td class="text-center">{{ $item->user->name }}</td>
                            <td class="text-center">
                                @if ($item->status == 1)
                                    <div class="ms-3 badge bg-success mb-1">Approved</div>
                                @else
                                    <div class="ms-3 badge bg-label-danger mb-1">Not Approved</div>
                                @endif
                                <br>
                                @if ($item->ispublic == 1)
                                    <div class="ms-3 badge bg-success">Published</div>
                                @else
                                    <div class="ms-3 badge bg-danger">Not Publish</div>
                                @endif
                            </td>
                            <td class="text-center" width='1%'>
                                <div class="btn-group">
                                    <button type="button"
                                        class="btn btn-primary btn-icon rounded-pill dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="ti ti-dots-vertical"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li><a class="dropdown-item" target="_blank"
                                                href="{{ route('view', ['id' => encrypt($item->id)]) }}">
                                                <i class="ti ti-eye me-2 ti-sm"></i>
                                                <span class="align-middle">View Knowledge</span></a></li>
                                        <li><a wire:click="publish({{ $item->id }})" class="dropdown-item"
                                                href="javascript:void(0);">
                                                <i class="ti ti-send me-2 ti-sm"></i>
                                                <span
                                                    class="align-middle">{{ $item->status ? 'Dont Approve Knowledge' : 'Approve Knowledge' }}</span></a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">Tidak ada data</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <hr class="p-0 m-0 mb-4">
            <div class="d-flex justify-content-between mb-4">
                <span> Menampilkan {{ $data->firstItem() }} sampai {{ $data->lastItem() }} data dari
                    {{ $data->total() }} hasil</span>
                <div>{{ $data }}</div>
            </div>
        </div>
    </div>
    



</div>
@section('script')
    <script>
        let type = 'store';
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
        $('#category').on('change', function(e) {
            var data = $('#category').select2("val");
            @this.set('category', data);
        });
        $('#topic').on('change', function(e) {
            var data = $('#topic').select2("val");
            @this.set('topic', data);
        });
        $('#ws').on('change', function(e) {
            var data = $('#ws').select2("val");
            @this.set('ws', data);
        });
        $('#divisi').on('change', function(e) {
            var data = $('#divisi').select2("val");
            @this.set('divisi', data);
        });
        document.addEventListener("livewire:load", function(event) {
            window.livewire.on('notif', (param) => {
                Swal.close();
                $.unblockUI();
                Swal.fire({
                    title: param.title,
                    text: param.text,
                    icon: param.icon,
                    customClass: {
                        confirmButton: 'btn btn-primary'
                    },
                    buttonsStyling: false
                });
            });
            window.livewire.on('konfirm', (param) => {
                Swal.fire({
                    title: param.title,
                    text: param.text,
                    icon: param.icon,
                    showCancelButton: true,
                    confirmButtonText: param.confirm,
                    customClass: {
                        confirmButton: 'btn btn-primary me-3',
                        cancelButton: 'btn btn-label-secondary'
                    },
                    buttonsStyling: false
                }).then(function(result) {
                    if (result.value) {
                        loading();
                        if (param.type == 'store') {
                            type = "store"
                            window.livewire.emit(param.type, true)
                        } else {
                            type = "delete";
                            window.livewire.emit(param.type, 1, true)
                        } 
                    }
                });
            });
            window.livewire.on('reset', (param) => {
                $('#category').val('').trigger('change');
                $('#topic').val('').trigger('change');
                $('#ws').val('').trigger('change');
                $('#divisi').val('').trigger('change');
                const form = document.querySelector('form');
                form.reset();
            });
            window.livewire.on('set', (param) => {
                $('#category').val(param.category).trigger('change');
                $('#topic').val(param.topic).trigger('change');
                $('#ws').val(param.ws).trigger('change');
                $('#divisi').val(param.divisi).trigger('change');
            });

            function loading() {
                $.blockUI({
                    message: '<div class="spinner-border text-white" role="status"></div>',
                    css: {
                        backgroundColor: 'transparent',
                        border: '0'
                    },
                    overlayCSS: {
                        opacity: 0.5
                    }
                });
            }
        });
        const textarea = document.querySelector('#autosize-demo');
        autosize(textarea);
    </script>
@endsection
