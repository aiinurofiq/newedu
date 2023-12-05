<div>
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
                                class="badge bg-purple bg-opacity-10 text-purple">{{$know->category->name}}</a>
                        </div>
                        <h5 class="card-title">
                            <a href="{{ route('knows-detail', ['id' => encrypt($know->id)]) }}">{{$know->title}}</a>
                        </h5>
                        <p class="mb-2 text-truncate-2">
                            {{$know->description}}
                        </p>
                    </div>
                    <div class="card-footer pt-0 pb-3">
                        <hr />
                        <div class="d-flex justify-content-between">
                            <span class="h6 fw-light mb-0">
                                <i class="far fa-clock text-danger me-2"></i>By: {{$know->user->name}}
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
