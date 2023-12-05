<div class="container-xxl flex-grow-1 container-p-y">
    {{-- <h4 class="fw-bold py-3 mb-2"><span class="text-muted fw-light">Home /</span> Buat Pengadaan</h4> --}}
    <div class="d-flex justify-content-between mb-4">
        <button wire:click="$set('action', 'C')"
            class="create-new btn btn-primary py-3 {{ $action == 'R' ? '' : 'd-none' }}"><i
                class="ti ti-plus me-sm-1"></i>
            <span class="fw-bold">Tambah
                Akses</span></button>
        <button wire:click="$set('action', 'R')"
            class="create-new btn btn-warning py-3  {{ $action == 'C' ? '' : 'd-none' }}"><i
                class="ti ti-arrow-left me-sm-1"></i>
            <span class="fw-bold">Kembali</span></button>
        <h4 class="fw-bold mb-2"><span class="text-muted fw-light">Home /</span> Permission</h4>
    </div>
    <div class="card mb-4 {{ $action == 'R' ? '' : 'd-none' }}">
        <h5 class="card-header">List Permission</h5>

        <div class="table-responsive ms-4 me-4">
            <table class="table">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Nama Anggota</th>
                        <th class="text-center">Email</th>
                        <th class="text-center">Akses</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @forelse ($data as $item)
                        @if ($item->getRoleNames()->first() != '')
                            <tr>
                                <td class="text-center">{{ $loop->index + 1 }}</td>
                                <td>
                                    {{ $item->name }}
                                </td>
                                <td class="text-center">{{ $item->email }}</td>
                                <td class="text-center">{{ $item->getRoleNames()->first() }}</td>
                                <td class="text-center">
                                    <button onclick='kirim({{ $item->id }})' class="btn btn-sm btn-danger"
                                        {{ $data->count() == 1 || $item->id == Auth::user()->id ? 'disabled' : '' }}>
                                        Hapus Akses<span class="fw-bold"></span></button>
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
                <span> Menampilkan 1 sampai {{ $data->count() }} data dari
                    {{ $data->count() }} hasil</span>
            </div>
        </div>

    </div>

    <div class="card mb-4 {{ $action == 'C' ? '' : 'd-none' }}">
        <h5 class="card-header">Tambah Akses Anggota</h5>
        <div class="d-flex justify-content-between ms-4 me-4 mb-3">
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
                        <th class="text-center">Nama</th>
                        <th class="text-center">Email</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @forelse ($data2 as $item)
                        <tr>
                            <td class="text-center">{{ $loop->index + $data2->firstItem() }}</td>
                            <td>
                                {{ $item->name }}
                            </td>
                            <td class="text-center">{{ $item->email }}</td>
                            <td class="text-center">
                                <button wire:click='tambah({{ $item->id }})' class="btn btn-sm btn-success mb-1">
                                    Super Admin<span class="fw-bold"></span></button><br>
                                    <button wire:click='tambahunit({{ $item->id }})' class="btn btn-sm btn-warning">
                                        Admin Unit<span class="fw-bold"></span></button>
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
                <span> Menampilkan {{ $data2->firstItem() }} sampai {{ $data2->lastItem() }} data dari
                    {{ $data2->total() }} hasil</span>
                <div>{{ $data2 }}</div>
            </div>
        </div>

    </div>



</div>
@section('script')
    <script>
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
        });
    </script>
@endsection
