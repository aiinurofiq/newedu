<div class="container-xxl flex-grow-1 container-p-y">
    <div class="d-flex justify-content-between mb-4">
        <h4 class="fw-bold mb-2"><span class="text-muted fw-light">Home /</span> Learning</h4>
        <button wire:click="$set('action', 'C')"
            class="create-new btn btn-primary {{ $action == 'R' ? '' : 'd-none' }}"><i
                class="ti ti-plus me-sm-1"></i><span class="fw-bold">Buat Learning</span></button>
        <button wire:click="clear()" onclick="event.preventDefault()"
            class="btn btn-warning {{ $action == 'R' ? 'd-none' : '' }}"><i
                class="fa-solid fa-circle-left me-sm-1"></i><span class="fw-bold">Kembali</span></button>
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
                        <th class="text-center">Image</th>
                        <th class="text-center">Price</th>
                        <th class="text-center">User</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @forelse ($data as $item)
                        <tr>
                            <td class="text-center" width='1%'>{{ $loop->index + $data->firstItem() }}</td>
                            <td>{{ $item->title }}</td>
                            <td class="text-center" width='1%'>
                                <img src="{{ asset(\Storage::url($item->image)) }}" class="rounded" alt="Shoe img"
                                    height="62" width="62" style="object-fit: cover;" />
                            </td>
                            <td class="text-end text-nowrap">{{ 'Rp ' . format_uang($item->price) }}</td>
                            <td class="text-center">{{ $item->user->name }}</td>
                            <td class="text-center">
                                @if ($item->ispublic == 1)
                                    <div class="ms-3 badge bg-label-success">Published</div>
                                @else
                                    <div class="ms-3 badge bg-label-danger">Not Published</div>
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
                                        <li><a wire:click="publish({{ $item->id }})" class="dropdown-item"
                                                href="javascript:void(0);">
                                                <i class="ti ti-send me-2 ti-sm"></i>
                                                <span
                                                    class="align-middle">{{ $item->ispublic ? 'Hide Learning' : 'Publish Learning' }}</span></a>
                                        </li>
                                        <li><a wire:click="edit({{ $item->id }})" class="dropdown-item"
                                                href="javascript:void(0);">
                                                <i class="ti ti-edit-circle me-2 ti-sm"></i>
                                                <span class="align-middle">Edit Learning</span></a></li>
                                        <li><a wire:click="delete({{ $item->id }})" class="dropdown-item"
                                                href="javascript:void(0);">
                                                <i class="ti ti-trash me-2 ti-sm"></i>
                                                <span class="align-middle">Delete Learning</span></a></li>
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
    <div class="card {{ $action == 'R' ? 'd-none' : '' }}">
        <h5 class="card-header">{{ $editlearning ? 'Edit' : 'Tambah' }} Learning</h5>
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-12">
                    <label class="form-label" for="basic-icon-default-fullname">Title</label>
                    <input wire:model="title" type="text" class="form-control @error('title') is-invalid @enderror"
                        placeholder="Input Title" /> @error('title')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-12">
                    <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                    <textarea wire:model='description' id="autosize-demo" rows="3" placeholder="Input Description"
                        class="form-control @error('description') is-invalid @enderror"></textarea> @error('description')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div wire:ignore class="col-md-6">
                    <label class="form-label">Level</label>
                    <select id='level' class="select2 form-select" data-allow-clear="false">
                        <option value="">Please select</option>
                        <option value="1">Beginner</option>
                        <option value="2">Intermediate</option>
                        <option value="3">Advanced</option>
                    </select>
                </div>
                <div wire:ignore class="col-md-6">
                    <label class="form-label">Category</label>
                    <select id='category' class="select2 form-select" data-allow-clear="false">
                        <option value="">Please select</option>
                        @foreach ($categorylearn as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Price</label>
                    <div class="input-group input-group-merge">
                        <span class="input-group-text" style="background-color: rgb(241,240,242)">Rp. </span>
                        <input wire:model="price" type="text"
                            class="form-control ps-1 @error('price') is-invalid @enderror" placeholder="0,00" />
                    </div>
                    @error('price')
                        <span class="invalid-feedback d-block">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">User</label>
                    <input type="text" class="form-control"
                        value="{{ $editlearning ? $editlearning->user->name : Auth::user()->name }}" disabled />

                </div>
                <div class="col-md-6 {{ $editlearning ? '' : 'd-none' }}">
                    <label for="formFile" class="form-label">Current Image</label>
                    <img src="{{ $editlearning ? asset(\Storage::url($editlearning->image)) : '' }}"
                        class="img-thumbnail" alt="...">
                </div>
                <div class="{{ $editlearning ? 'col-md-6' : 'col-md-12' }}">
                    <label for="formFile" class="form-label">{{ $editlearning ? 'Edit' : '' }} Image</label>
                    <form wire:ignore action="{{ route('dropzonestore') }}" method="post"
                        enctype="multipart/form-data" id="image-upload" class="dropzone">
                        @csrf
                        <div class="dz-message needsclick">
                            Tarik file atau klik untuk upload
                            <span class="note needsclick">(Image harus jelas dan lengkap. Maksimal image adalah
                                <strong>2 MB</strong> Setiap File.)</span>
                        </div>
                        <div class="fallback">
                            <input name="file" type="file" id='fileberkas2' />
                        </div>
                    </form>
                </div>
                <div class="col-md-12">
                    <div class="d-flex justify-content-between mb-3 mt-2">
                        <button wire:click="clear()" onclick="event.preventDefault()" class="btn btn-warning"><i
                                class="fa-solid fa-circle-left me-sm-1"></i> <span
                                class="fw-bold">Kembali</span></button>
                        <button id="kirim" data-value="1" class="btn btn-primary"><i
                                class="fa-solid fa-paper-plane me-sm-1"></i> <span
                                class="fw-bold">{{ $editlearning ? 'Update' : 'Buat' }}
                                Learning</span></button>
                    </div>
                </div>
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
        $('#level').on('change', function(e) {
            var data = $('#level').select2("val");
            @this.set('level', data);
        });
        document.addEventListener("livewire:load", function(event) {
            var dropzone = Dropzone.forElement(".dropzone");
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
                            uploadimage()
                        } else if (param.type == 'edit') {
                            type = "edit";
                            dropzone.getAcceptedFiles().length == 0 ? window.livewire.emit('edit',
                                1,
                                true) : uploadimage()
                        } else if (param.type == 'delete') {
                            type = "delete";
                            window.livewire.emit('delete', 1, true)
                        } else {
                            type = "publish";
                            window.livewire.emit('publish', 1, true)
                        }
                    }
                });
            });
            window.livewire.on('reset', (param) => {
                $('#category').val('').trigger('change');
                $('#level').val('').trigger('change');
                dropzone.removeAllFiles(true);
            });
            window.livewire.on('set', (param) => {
                $('#category').val(param.category).trigger('change');
                $('#level').val(param.level).trigger('change');
            });
            dropzone.on("success", function(file, response) {
                console.log(response.success);
                window.livewire.emit('changeberkas', response.success);
                dropzone.removeFile(file);
                if (dropzone.getAcceptedFiles().length == 0) {
                    // window.livewire.emit('store');
                    type == 'store' ? window.livewire.emit('store', true) : window.livewire.emit('edit', 1,
                        true);
                    dropzone.removeAllFiles(true);
                }
            });

            function uploadimage() {
                const acceptedFiles = dropzone.getAcceptedFiles();
                for (var i = 0; i < acceptedFiles.length; i++) {
                    dropzone.processFile(acceptedFiles[i]);
                }
            }

            $("#kirim").click(function(e) {
                event.preventDefault();
                window.livewire.emit('confirm', dropzone.getAcceptedFiles().length);
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

        $(document).ready(function() {
            const previewTemplate = `<div class="dz-preview dz-file-preview">
            <div class="dz-details">
            <div class="dz-thumbnail">
                <img data-dz-thumbnail>
                <span class="dz-nopreview">No preview</span>
                <div class="dz-success-mark"></div>
                <div class="dz-error-mark"></div>
                <div class="dz-error-message"><span data-dz-errormessage></span></div>
                <div class="progress">
                <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuemin="0" aria-valuemax="100" data-dz-uploadprogress></div>
                </div>
            </div>
            <div class="dz-filename" data-dz-name></div>
            <div class="dz-size" data-dz-size></div>
            </div>
            </div>`;
            var dropzone = Dropzone.forElement(".dropzone");
            dropzone.options.acceptedFiles = ".jpeg,.jpg,.png";
            dropzone.options.autoProcessQueue = false;
            dropzone.options.maxFilesize = 2;
            dropzone.options.maxFile = 2;
            dropzone.options.previewTemplate = previewTemplate;
            dropzone.options.addRemoveLinks = true;
            dropzone.options.url = "{{ route('dropzonestore') }}";
            // dropzone.options.uploadMultiple = true;
            dropzone.options.parallelUploads = 2;
            dropzone.on("addedfile", function(file) {
                if (dropzone.getAcceptedFiles().length == 1) {
                    dropzone.removeFile(dropzone.getAcceptedFiles()[0]);
                }
            });
        });
    </script>
@endsection
