<div class="container-xxl flex-grow-1 container-p-y">
    <div class="d-flex justify-content-between mb-4">
        <h4 class="fw-bold mb-2"><span class="text-muted fw-light">Home /</span> Section</h4>
        <button wire:click="clear(true)" onclick="event.preventDefault()"
            class="btn btn-warning {{ $action == 'U' ? '' : 'd-none' }}"><i
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
                        <th class="text-center">Total Section</th>
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
                            <td class="text-center text-nowrap">
                                <div class="ms-3 badge bg-label-danger">{{ $item->sections->count() }}</div>
                            </td>
                            <td class="text-center text-nowrap">
                                <button wire:click="datasection({{ $item->id }})"
                                    onclick="event.preventDefault()" class="btn btn-sm btn-primary" width='1%'><span
                                        class="fw-bold">Section &
                                        Module</span></button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">Tidak ada data</td>
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

    <div class="card mb-4 {{ $action == 'U' ? '' : 'd-none' }}">
        {{-- <div class="card-header"> --}}
        <div class="d-flex justify-content-between align-items-center ms-4 me-4 mt-4">
            <div>
                <h5>Section Learning <span class="badge bg-danger rounded-pill">{{ $learning ? $learning->title : '' }}</span></h5>
            </div>
            <div class="d-flex align-items-center">
                <button wire:click="$set('action', 'AddSec')" class="btn btn-primary me-2"><i
                        class="ti ti-plus me-sm-1"></i><span class="fw-bold">Add
                        Section</span></button>
            </div>
        </div>
        {{-- </div> --}}
        <div class="table-responsive ms-4 me-4">
            <table class="table">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Section</th>
                        <th class="text-center">Image</th>
                        <th class="text-center">Description</th>
                        <th class="text-center">Quiz</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @forelse (($learning ? $learning->sections : []) as $item)
                        <tr>
                            <td class="text-center" width='1%'>{{ $loop->iteration }}</td>
                            <td>{{ $item->title }}</td>
                            <td class="text-center" width='1%'>
                                <img src="{{ asset(\Storage::url($item->image)) }}" class="rounded" alt="Shoe img"
                                    height="62" width="62" style="object-fit: cover;" />
                            </td>
                            <td class="text-center">{{ $item->description }}</td>
                            <td class="text-center">
                                @if ($item->hquiz == 1)
                                    <div class="ms-3 badge bg-label-success">Have Quiz</div>
                                @else
                                    <div class="ms-3 badge bg-label-danger">Not Have Quiz</div>
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
                                        <li><a wire:click="changesection({{ $item->id }})" class="dropdown-item"
                                                href="javascript:void(0);">
                                                <i class="ti ti-plus me-2 ti-sm"></i>
                                                <span class="align-middle">Add Module</span></a>
                                        </li>
                                        <li><a wire:click="edit({{ $item->id }})" class="dropdown-item"
                                                href="javascript:void(0);">
                                                <i class="ti ti-edit-circle me-2 ti-sm"></i>
                                                <span class="align-middle">Edit Section</span></a></li>
                                        <li><a wire:click="delete({{ $item->id }})" class="dropdown-item"
                                                href="javascript:void(0);">
                                                <i class="ti ti-trash me-2 ti-sm"></i>
                                                <span class="align-middle">Delete Section</span></a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        @if ($item->modules->count() > 0)
                            <tr>
                                <td></td>
                                <td colspan="5">
                                    <table class="table table-bordered" style="font-size: 12px">
                                        <thead>
                                            <tr>
                                                <td class="text-center">No</td>
                                                <td class="text-center">Module</td>
                                                <td class="text-center">Text</td>
                                                <td class="text-center">Description</td>
                                                <td class="text-center">File</td>
                                                <td class="text-center">Actions</td>
                                            </tr>
                                        </thead>
                                        <tbody class="table-border-bottom-0">
                                            @forelse ($item->modules as $modul)
                                                <tr>
                                                    <td class="text-center" width='1%'>{{ $loop->iteration }}
                                                    </td>
                                                    <td class="text-center">{{ $modul->title }}</td>
                                                    <td>{{ $modul->text }}</td>
                                                    <td>{{ $modul->description }}</td>
                                                    <td class="text-center" width='1%'>
                                                        <a href="{{ $modul->file ? asset(\Storage::url($modul->file)) : $modul->videoembed }}"
                                                            target="_blank" class="btn btn-primary btn-sm btn-icon">
                                                            <span class="ti-xs ti ti-file"></span></a>
                                                    </td>
                                                    <td class="text-center" width='1%'>
                                                        <div class="btn-group">
                                                            <button type="button"
                                                                class="btn btn-sm btn-primary btn-icon rounded-pill dropdown-toggle hide-arrow"
                                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                                <i class="ti ti-dots-vertical"></i>
                                                            </button>
                                                            <ul class="dropdown-menu dropdown-menu-end">
                                                                <li><a wire:click="editmodule({{ $modul->id }})"
                                                                        class="dropdown-item"
                                                                        href="javascript:void(0);">
                                                                        <i class="ti ti-edit-circle me-2 ti-sm"></i>
                                                                        <span class="align-middle">Edit
                                                                            Module</span></a>
                                                                </li>
                                                                <li><a wire:click="deletemodule({{ $modul->id }})"
                                                                        class="dropdown-item"
                                                                        href="javascript:void(0);">
                                                                        <i class="ti ti-trash me-2 ti-sm"></i>
                                                                        <span class="align-middle">Delete
                                                                            Module</span></a></li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="6" class="text-center">Tidak ada data</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        @endif
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">Tidak ada data</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <hr class="p-0 m-0 mb-4">
            <div class="d-flex justify-content-between mb-4">
                <span> Menampilkan 1 sampai {{ $learning ? $learning->sections->count() : '0' }} data dari
                    {{ $learning ? $learning->sections->count() : '0' }} hasil</span>
            </div>
        </div>
    </div>
    <div class="card mb-4 {{ $action == 'AddSec' || $action == 'AddMod' ? '' : 'd-none' }}">
        <h5 class="card-header">{{ $editsection || $editmodule ? 'Edit' : 'Tambah' }} {{ $action == 'AddSec' ? 'Section' : 'Module' }}</h5>
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-{{ $action == 'AddMod' ? '12' : '6' }}">
                    <label class="form-label" for="basic-icon-default-fullname">Title</label>
                    <input wire:model="title" type="text"
                        class="form-control @error('title') is-invalid @enderror" placeholder="Input Title" />
                    @error('title')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-6 {{ $action == 'AddSec' ? '' : 'd-none' }}">
                    <div wire:ignore>
                        <label class="form-label">Quiz</label>
                        <select id='quiz' class="select2 form-select" data-allow-clear="false">
                            <option value="">Please select</option>
                            <option value="1">Ada</option>
                            <option value="0">Tidak</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-12 {{ $action == 'AddMod' ? '' : 'd-none' }}">
                    <label class="form-label" for="basic-icon-default-fullname">Text</label>
                    <textarea wire:model='textmodule' id="autosize-demo" rows="3" placeholder="Input Text"
                        class="form-control @error('textmodule') is-invalid @enderror"></textarea> @error('textmodule')
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

                <div class="col-md-6 {{ $action == 'AddMod' ? '' : 'd-none' }}">
                    <div wire:ignore>
                        <label class="form-label">Type</label>
                        <select id='typemodule' class="select2 form-select" data-allow-clear="false">
                            <option value="">Please select</option>
                            <option value="1">Berkas</option>
                            <option value="2">Video Youtube</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6 {{ $typemodule == '2' && $action == 'AddMod' ? '' : 'd-none' }} ">
                    <label class="form-label" for="basic-icon-default-fullname">Url Youtube</label>
                    <input wire:model="urlmodule" type="text"
                        class="form-control @error('urlmodule') is-invalid @enderror"
                        placeholder="Input Url Youtube" />
                    @error('urlmodule')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div
                    class="{{ $action == 'AddMod' ? 'col-md-6' : 'col-md-12' }}  {{ $typemodule == '1' || $action == 'AddSec' ? '' : 'd-none' }}">
                    <label for="formFile" class="form-label">{{ $editsection || $editmodule ? 'Edit' : '' }} Berkas</label>
                    <form wire:ignore action="{{ route('dropzonestore') }}" method="post"
                        enctype="multipart/form-data" id="image-upload" class="dropzone">
                        @csrf
                        <div class="dz-message needsclick">
                            Tarik file atau klik untuk upload
                            <span class="note needsclick">(Berkas harus jelas dan lengkap. Maksimal berkas adalah
                                <strong>10 MB</strong> Setiap File.)</span>
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
                                class="fw-bold">{{ $editsection || $editmodule ? 'Update' : 'Buat' }}
                                {{ $action == 'AddSec' ? 'Section' : 'Module' }}</span></button>
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
        $('#typemodule').on('change', function(e) {
            var data = $('#typemodule').select2("val");
            @this.set('typemodule', data);
        });
        $('#quiz').on('change', function(e) {
            var data = $('#quiz').select2("val");
            @this.set('quiz', data);
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
                        } else if (param.type == 'edit' || param.type == 'editmodule') {
                            type = param.type;
                            dropzone.getAcceptedFiles().length == 0 ? window.livewire.emit(param.type,
                                1,
                                true) : uploadimage()
                        } else {
                            window.livewire.emit(param.type, 1, true)
                        } 
                    }
                });
            });
            window.livewire.on('reset', (param) => {
                $('#typemodule').val('').trigger('change');
                $('#quiz').val('').trigger('change');
                dropzone.removeAllFiles(true);
            });
            window.livewire.on('set', (param) => {
                $('#typemodule').val(param.typemodule).trigger('change');
                $('#quiz').val(param.quiz).trigger('change');
            });
            dropzone.on("success", function(file, response) {
                console.log(response.success);
                window.livewire.emit('changeberkas', response.success);
                dropzone.removeFile(file);
                if (dropzone.getAcceptedFiles().length == 0) {
                    // window.livewire.emit('store');
                    type == 'store' ? window.livewire.emit('store', true) : window.livewire.emit(type, 1,
                        true);
                    dropzone.removeAllFiles(true);
                }
            });

            function uploadimage() {
                const acceptedFiles = dropzone.getAcceptedFiles();
                if (acceptedFiles.length == 0) {
                    type == 'store' ? window.livewire.emit('store', true) : window.livewire.emit('edit', 1,
                        true);
                }
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
