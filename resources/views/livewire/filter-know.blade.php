<div>
    <form class="bg-light border p-4 rounded-3 my-4 z-index-9 position-relative">
        <div class="row g-3">
            <div class="col-2">
                <input wire:model="query" class="form-control me-1" type="search" placeholder="Enter keyword" />
            </div>
            <div class="col-2">
                <div wire:ignore class="row g-3">
                    <select id="category" class="form-select form-select-sm js-choice"
                        aria-label=".form-select-sm example">
                        <option value="" selected>Semua</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-2">
                <div wire:ignore class="row g-3">
                    <select id="ws" class="form-select form-select-sm js-choice"
                        aria-label=".form-select-sm example">
                        <option value="" selected>Semua</option>
                        @foreach ($wsall as $wsitem)
                            <option value="{{ $wsitem->id }}">{{ $wsitem->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-2">
                <div wire:ignore class="row g-3">
                    <select id="divisi" class="form-select form-select-sm js-choice"
                        aria-label=".form-select-sm example">
                        <option value="" selected>Semua</option>
                        @foreach ($divisiall as $item)
                            <option value="{{ $item->id }}">{{ $item->subdivisi }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-2">
                <div wire:ignore class="row g-3">
                    <select id="year" class="form-select form-select-sm js-choice"
                        aria-label=".form-select-sm example">
                        <option value="" selected>Semua</option>
                        @foreach ($yearall as $item)
                            <option value="{{ $item }}">{{ $item }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </form>
    <div class="col-12">
        <div class="row g-4">
            @foreach ($knows as $know)
                <div class="col-sm-6 col-lg-4 col-xl-3">
                    <div class="card shadow h-100">
                        <img src="{{ $know->photo ? asset(\Storage::url($know->photo)) : '' }}" class="card-img-top"
                            alt="course image" />
                        <div class="card-body pb-0">
                            <div class="d-flex justify-content-between mb-2">
                                <a href="#"
                                    class="badge bg-purple bg-opacity-10 text-purple">{{ $know->category->name }}</a>
                            </div>
                            <h5 class="card-title">
                                <a
                                    href="{{ route('knows-detail', ['id' => encrypt($know->id)]) }}">{{ $know->title }}</a>
                            </h5>
                            <p class="mb-2 text-truncate-2">
                                {{ $know->description }}
                            </p>
                        </div>
                        <div class="card-footer pt-0 pb-3">
                            <hr />
                            <div class="d-flex justify-content-between">
                                <span class="h6 fw-light mb-0">
                                    <i class="far fa-clock text-danger me-2"></i>By: {{ $know->user->name }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="col-12">
            <nav class="mt-4 d-flex justify-content-center" aria-label="navigation">
            </nav>
        </div>
    </div>
</div>

@section('script')
    <script>
      $('#category').on('change', function(e) {
            var data = $('#category').val();
            @this.set('category', data);
        });
      $('#ws').on('change', function(e) {
            var data = $('#ws').val();
            @this.set('ws', data);
        });
      $('#divisi').on('change', function(e) {
            var data = $('#divisi').val();
            @this.set('divisi', data);
        });
      $('#year').on('change', function(e) {
            var data = $('#year').val();
            @this.set('year', data);
        });
    </script>
@endsection
