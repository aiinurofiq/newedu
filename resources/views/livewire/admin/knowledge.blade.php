<div class="container-xxl flex-grow-1 container-p-y">
    <div class="d-flex justify-content-between mb-4">
        <h4 class="fw-bold mb-2"><span class="text-muted fw-light">Home /</span> Knowledge</h4>
        <button wire:click="$set('action', 'C')"
            class="create-new btn btn-primary {{ $action == 'R' ? '' : 'd-none' }}"><i
                class="ti ti-plus me-sm-1"></i><span class="fw-bold">Buat Knowledge</span></button>
        <button wire:click="clear()" onclick="event.preventDefault()"
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
                        <th class="text-center">Upload By</th>
                        <th class="text-center">Topic</th>
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
                                <img src="{{ asset(\Storage::url($item->photo)) }}" class="rounded" alt="Shoe img"
                                    height="62" width="62" style="object-fit: cover;" />
                            </td>
                            <td class="text-center">{{ $item->user->name }}</td>
                            <td class="text-center"><span class="badge bg-info mb-1">Topic :
                                    {{ $item->topic->name }}</span>
                                <span class="badge bg-warning">Category : {{ $item->category->name }}</span>
                            </td>
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
                                        <li><a wire:click="publish({{ $item->id }})" class="dropdown-item"
                                                href="javascript:void(0);">
                                                <i class="ti ti-send me-2 ti-sm"></i>
                                                <span
                                                    class="align-middle">{{ $item->ispublic ? 'Hide Knowledge' : 'Publish Knowledge' }}</span></a>
                                        </li>
                                        <li><a wire:click="modules({{ $item->id }})" class="dropdown-item"
                                                href="javascript:void(0);">
                                                <i class="ti ti-section me-2 ti-sm"></i>
                                                <span class="align-middle">Module Knowledge</span></a>
                                        </li>
                                        <li><a wire:click="edit({{ $item->id }})" class="dropdown-item"
                                                href="javascript:void(0);">
                                                <i class="ti ti-edit-circle me-2 ti-sm"></i>
                                                <span class="align-middle">Edit Knowledge</span></a></li>
                                        <li><a wire:click="delete({{ $item->id }})" class="dropdown-item"
                                                href="javascript:void(0);">
                                                <i class="ti ti-trash me-2 ti-sm"></i>
                                                <span class="align-middle">Delete Knowledge</span></a></li>
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
    <div class="card {{ $action == 'C' || $action == 'U' ? '' : 'd-none' }}">
        <h5 class="card-header">{{ $editknowledge ? 'Edit' : 'Tambah' }} Knowledge </h5>
        <div class="card-body">
            <form wire:submit.prevent="confirm" id='formreset' class="row g-3">
                <div class="col-md-12">
                    <label class="form-label" for="basic-icon-default-fullname">Title</label>
                    <input wire:model="title" type="text"
                        class="form-control @error('title') is-invalid @enderror" placeholder="Input Title" />
                    @error('title')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-12">
                    <label for="exampleFormControlTextarea1" class="form-label">Abstract</label>
                    <textarea wire:model='abstract' id="autosize-demo" rows="3" placeholder="Input Abstract"
                        class="form-control @error('abstract') is-invalid @enderror"></textarea> @error('abstract')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="exampleFormControlTextarea1" class="form-label">Writer</label>
                    <input wire:model="writer" type="text"
                        class="form-control @error('writer') is-invalid @enderror" placeholder="Input Writer" />
                    @error('writer')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="exampleFormControlTextarea1" class="form-label">Year</label>
                    <input wire:model="year" type="text" class="form-control @error('year') is-invalid @enderror"
                        placeholder="Input Year" />
                    @error('year')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-6 {{ $editknowledge ? '' : 'd-none' }}">
                    <label for="formFile" class="form-label">Current Image</label>
                    <img src="{{ $editknowledge ? asset(\Storage::url($editknowledge->photo)) : '' }}"
                        class="img-thumbnail" alt="...">
                </div>
                <div class="{{ $editknowledge ? 'col-md-6' : 'col-md-12' }}">
                    <label for="formFile" class="form-label">{{ $editknowledge ? 'Edit' : '' }} Image</label>
                    <input wire:model='imageknowledge'
                        class="form-control fileupload @error('imageknowledge') is-invalid @enderror"
                        type="file" />
                    @error('imageknowledge')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div wire:ignore class="col-md-6">
                    <label class="form-label">Topic</label>
                    <select id='topic' class="select2 form-select" data-allow-clear="false">
                        <option value="">Please select</option>
                        @foreach ($topicall as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div wire:ignore class="col-md-6">
                    <label class="form-label">Category</label>
                    <select id='category' class="select2 form-select" data-allow-clear="false">
                        <option value="">Please select</option>
                        @foreach ($categoryall as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div wire:ignore class="col-md-6">
                    <label class="form-label">Wilayah Sungai</label>
                    <select id='ws' class="select2 form-select" data-allow-clear="false">
                        <option value="">Please select</option>
                        @foreach ($wsall as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div wire:ignore class="col-md-6">
                    <label class="form-label">Divisi</label>
                    <select id='divisi' class="select2 form-select" data-allow-clear="false">
                        <option value="">Please select</option>
                        @foreach ($divisiall as $item)
                            <option value="{{ $item->id }}">{{ $item->subdivisi }} - {{ $item->divisi }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-12">
                    <div class="d-flex justify-content-between mb-3 mt-2">
                        <button wire:click="clear()" onclick="event.preventDefault()" class="btn btn-warning"><i
                                class="fa-solid fa-circle-left me-sm-1"></i> <span
                                class="fw-bold">Kembali</span></button>
                        <button wire:click="confirm()" data-value="1" class="btn btn-primary"><i
                                class="fa-solid fa-paper-plane me-sm-1"></i> <span
                                class="fw-bold">{{ $editknowledge ? 'Update' : 'Buat' }}
                                Knowledge</span></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="row mt-4 {{ $action == 'A' ? '' : 'd-none' }}">
        <div
            class="mb-4 bg-label-primary d-flex justify-content-between flex-column-reverse flex-lg-row  align-items-center py-4 px-5">
            <div class="text-center text-lg-start mt-2 ms-3">
                <h3 class="text-primary mb-1">{{ $deleteknowledge ? $deleteknowledge->title : null }}</h3>
                <p class="text-body mb-1">Upload and Edit Jurnal, Exsum, Explanation, Report.</p>
            </div>

            <button wire:click="clear()" onclick="event.preventDefault()" class="btn btn-warning"><i
                    class="fa-solid fa-circle-left me-sm-1"></i><span class="fw-bold">Kembali</span></button>
        </div>
        <!-- Navigation -->
        <div wire:ignore class="col-lg-3 col-md-4 col-12 mb-md-0 mb-3">
            <div class="d-flex justify-content-between flex-column mb-2 mb-md-0">
                <ul class="nav nav-align-left nav-pills flex-column">
                    <li class="nav-item">
                        <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#payment">
                            <i class="ti ti-credit-card me-1 ti-sm"></i>
                            <span class="align-middle fw-semibold">Jurnal</span>
                        </button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#delivery">
                            <i class="ti ti-briefcase me-1 ti-sm"></i>
                            <span class="align-middle fw-semibold">Exsum</span>
                        </button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#cancellation">
                            <i class="ti ti-rotate-clockwise-2 me-1 ti-sm"></i>
                            <span class="align-middle fw-semibold">Explanation</span>
                        </button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#orders">
                            <i class="ti ti-box me-1 ti-sm"></i>
                            <span class="align-middle fw-semibold">Report</span>
                        </button>
                    </li>
                </ul>
                <div class="d-none d-md-block">
                    <div class="mt-4">
                        <img src="{{ asset('assetsadmin/img/illustrations/girl-sitting-with-laptop.png') }}"
                            class="img-fluid" width="270" alt="FAQ Image" />
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-9 col-md-8 col-12">
            <div class="tab-content py-0">
                <div wire:ignore.self class="tab-pane fade show active" id="payment" role="tabpanel">
                    <div class="card p-4">
                        <div class="d-flex mb-3 justify-content-between">
                            <div class="d-flex gap-3">
                                <div>
                                    <span class="badge bg-label-primary rounded-2 p-2">
                                        <i class="ti ti-credit-card ti-lg"></i>
                                    </span>
                                </div>
                                <div>
                                    <h4 class="mb-0">
                                        <span class="align-middle">Jurnal</span>
                                    </h4>
                                    <small>Jurnal Knowledge</small>
                                </div>
                            </div>
                            <div>
                                <button wire:click="changetype('jurnal')" class="create-new btn btn-primary"><i
                                        class="ti ti-plus me-sm-1"></i><span class="fw-bold">Tambah Jurnal
                                    </span></button>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Description</th>
                                        <th class="text-center">File</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @forelse ($jurnalall as $item)
                                        <tr>
                                            <td class="text-center" width='1%'>
                                                {{ $loop->iteration }}</td>
                                            <td>{{ $item->description }}</td>
                                            <td class="text-center" width='1%'>
                                                <a href="{{ asset(\Storage::url(explode('|',$item->file)[0])) }}" target="_blank"
                                                    class="btn btn-primary btn-sm btn-icon">
                                                    <span class="ti-xs ti ti-file"></span></a>
                                            </td>
                                            <td class="text-center" width='1%'>
                                                <div class="btn-group">
                                                    <button type="button"
                                                        class="btn btn-primary btn-icon rounded-pill dropdown-toggle hide-arrow"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="ti ti-dots-vertical"></i>
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-menu-end">
                                                        <li><a wire:click="confirmedit('jurnal',{{ $item->id }})"
                                                                class="dropdown-item" href="javascript:void(0);">
                                                                <i class="ti ti-edit-circle me-2 ti-sm"></i>
                                                                <span class="align-middle">Edit Module</span></a>
                                                        </li>
                                                        <li><a wire:click="confirmdelete('jurnal',{{ $item->id }})"
                                                                class="dropdown-item" href="javascript:void(0);">
                                                                <i class="ti ti-trash me-2 ti-sm"></i>
                                                                <span class="align-middle">Delete Module</span></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center">Tidak ada data</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <hr class="p-0 m-0 mb-4">
                        </div>
                    </div>
                </div>
                <div wire:ignore.self class="tab-pane fade" id="delivery" role="tabpanel">
                    <div class="card p-4">
                        <div class="d-flex mb-3 justify-content-between">
                            <div class="d-flex gap-3">
                                <div>
                                    <span class="badge bg-label-primary rounded-2 p-2">
                                        <i class="ti ti-credit-card ti-lg"></i>
                                    </span>
                                </div>
                                <div>
                                    <h4 class="mb-0">
                                        <span class="align-middle">Exsum</span>
                                    </h4>
                                    <small>Exsum Knowledge</small>
                                </div>
                            </div>
                            <div>
                                <button wire:click="changetype('exsum')" class="create-new btn btn-primary"><i
                                        class="ti ti-plus me-sm-1"></i><span class="fw-bold">Tambah Exsum
                                    </span></button>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Description</th>
                                        <th class="text-center">File</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @forelse ($exsumall as $item)
                                        <tr>
                                            <td class="text-center" width='1%'>
                                                {{ $loop->iteration }}</td>
                                            <td>{{ $item->description }}</td>
                                            <td class="text-center" width='1%'>
                                                <a href="{{ asset(\Storage::url(explode('|',$item->file)[0])) }}" target="_blank"
                                                    class="btn btn-primary btn-sm btn-icon">
                                                    <span class="ti-xs ti ti-file"></span></a>
                                            </td>
                                            <td class="text-center" width='1%'>
                                                <div class="btn-group">
                                                    <button type="button"
                                                        class="btn btn-primary btn-icon rounded-pill dropdown-toggle hide-arrow"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="ti ti-dots-vertical"></i>
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-menu-end">
                                                        <li><a wire:click="confirmedit('exsum',{{ $item->id }})"
                                                                class="dropdown-item" href="javascript:void(0);">
                                                                <i class="ti ti-edit-circle me-2 ti-sm"></i>
                                                                <span class="align-middle">Edit Module</span></a>
                                                        </li>
                                                        <li><a wire:click="confirmdelete('exsum',{{ $item->id }})"
                                                                class="dropdown-item" href="javascript:void(0);">
                                                                <i class="ti ti-trash me-2 ti-sm"></i>
                                                                <span class="align-middle">Delete Module</span></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center">Tidak ada data</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <hr class="p-0 m-0 mb-4">
                        </div>
                    </div>
                </div>
                <div wire:ignore.self class="tab-pane fade" id="cancellation" role="tabpanel">
                    <div class="card p-4">
                        <div class="d-flex mb-3 justify-content-between">
                            <div class="d-flex gap-3">
                                <div>
                                    <span class="badge bg-label-primary rounded-2 p-2">
                                        <i class="ti ti-credit-card ti-lg"></i>
                                    </span>
                                </div>
                                <div>
                                    <h4 class="mb-0">
                                        <span class="align-middle">Explanation</span>
                                    </h4>
                                    <small>Explanation Knowledge</small>
                                </div>
                            </div>
                            <div>
                                <button wire:click="changetype('explan')" class="create-new btn btn-primary"><i
                                        class="ti ti-plus me-sm-1"></i><span class="fw-bold">Tambah Explanation
                                    </span></button>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Description</th>
                                        <th class="text-center">File</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @forelse ($explanall as $item)
                                        <tr>
                                            <td class="text-center" width='1%'>
                                                {{ $loop->iteration }}</td>
                                            <td>{{ $item->description }}</td>
                                            <td class="text-center" width='1%'>
                                                <a href="{{ asset(\Storage::url(explode('|',$item->file)[0])) }}" target="_blank"
                                                    class="btn btn-primary btn-sm btn-icon">
                                                    <span class="ti-xs ti ti-file"></span></a>
                                            </td>
                                            <td class="text-center" width='1%'>
                                                <div class="btn-group">
                                                    <button type="button"
                                                        class="btn btn-primary btn-icon rounded-pill dropdown-toggle hide-arrow"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="ti ti-dots-vertical"></i>
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-menu-end">
                                                        <li><a wire:click="confirmedit('explan',{{ $item->id }})"
                                                                class="dropdown-item" href="javascript:void(0);">
                                                                <i class="ti ti-edit-circle me-2 ti-sm"></i>
                                                                <span class="align-middle">Edit Module</span></a>
                                                        </li>
                                                        <li><a wire:click="confirmdelete('explan',{{ $item->id }})"
                                                                class="dropdown-item" href="javascript:void(0);">
                                                                <i class="ti ti-trash me-2 ti-sm"></i>
                                                                <span class="align-middle">Delete Module</span></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center">Tidak ada data</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <hr class="p-0 m-0 mb-4">
                        </div>
                    </div>
                </div>
                <div wire:ignore.self class="tab-pane fade" id="orders" role="tabpanel">
                    <div class="card p-4">
                        <div class="d-flex mb-3 justify-content-between">
                            <div class="d-flex gap-3">
                                <div>
                                    <span class="badge bg-label-primary rounded-2 p-2">
                                        <i class="ti ti-credit-card ti-lg"></i>
                                    </span>
                                </div>
                                <div>
                                    <h4 class="mb-0">
                                        <span class="align-middle">Report</span>
                                    </h4>
                                    <small>Report Knowledge</small>
                                </div>
                            </div>
                            <div>
                                <button wire:click="changetype('report')" class="create-new btn btn-primary"><i
                                        class="ti ti-plus me-sm-1"></i><span class="fw-bold">Tambah Report
                                    </span></button>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Description</th>
                                        <th class="text-center">File</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @forelse ($reportall as $item)
                                        <tr>
                                            <td class="text-center" width='1%'>
                                                {{ $loop->iteration }}</td>
                                            <td>{{ $item->description }}</td>
                                            <td class="text-center" width='1%'>
                                                <a href="{{ asset(\Storage::url(explode('|',$item->file)[0])) }}" target="_blank"
                                                    class="btn btn-primary btn-sm btn-icon">
                                                    <span class="ti-xs ti ti-file"></span></a>
                                            </td>
                                            <td class="text-center" width='1%'>
                                                <div class="btn-group">
                                                    <button type="button"
                                                        class="btn btn-primary btn-icon rounded-pill dropdown-toggle hide-arrow"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="ti ti-dots-vertical"></i>
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-menu-end">
                                                        <li><a wire:click="confirmedit('report',{{ $item->id }})"
                                                                class="dropdown-item" href="javascript:void(0);">
                                                                <i class="ti ti-edit-circle me-2 ti-sm"></i>
                                                                <span class="align-middle">Edit Module</span></a>
                                                        </li>
                                                        <li><a wire:click="confirmdelete('report',{{ $item->id }})"
                                                                class="dropdown-item" href="javascript:void(0);">
                                                                <i class="ti ti-trash me-2 ti-sm"></i>
                                                                <span class="align-middle">Delete Module</span></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center">Tidak ada data</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <hr class="p-0 m-0 mb-4">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /FAQ's -->
    </div>
    <div class="card {{ $action == 'M' ? '' : 'd-none' }}">
        <h5 class="card-header">Module </h5>
        <div class="card-body">
            <form wire:submit.prevent="confirmmodule" id="addNewCCForm" class="row g-3">
                <div class="col-12">
                    <label class="form-label" for="modalAddCardName">File</label>
                    <input wire:model='filemodule' type="file"
                        class="form-control fileupload @error('filemodule') is-invalid @enderror"
                        placeholder="John Doe" />
                    @error('filemodule')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-12 col-md-12">
                    <label class="form-label" for="modalAddCardName">Description (Optional)</label>
                    <textarea wire:model='description' id="autosize-demo" rows="3" placeholder="Input Description"
                        class="form-control"></textarea>
                </div>
                <div class="col-12 text-center">
                    <div wire:loading.remove wire:target="filemodule">
                        <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
                        <button wire:click='cancel()' type="reset" class="btn btn-label-secondary btn-reset">
                            Cancel
                        </button>
                    </div>
                    <div wire:loading wire:target="filemodule">
                        <button class="btn btn-primary" type="button" disabled>
                            <span class="spinner-border spinner-border-sm" role="status"
                                aria-hidden="true"></span>
                        </button>
                    </div>
                </div>
            </form>
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
                $('.fileupload').val('')
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
