<div>
    <div class="col-12">
        <div class="row g-4">
            @foreach ($learns as $learn)
            <div class="col-sm-6 col-lg-4 col-xl-3">
                <div class="card shadow h-100">
                    <img src="{{ $learn->image ? asset(\Storage::url($learn->image)) : '' }}" class="card-img-top"
                        alt="course image" />
                    <div class="card-body pb-0">
                        <div class="d-flex justify-content-between mb-2">
                            <a href="#"
                                class="badge bg-purple bg-opacity-10 text-purple">{{$learn->categorylearn->name}}</a>
                        </div>
                        <h5 class="card-title">
                            <a href="{{ route('learns-detail', ['id' => encrypt($learn->id)]) }}">{{$learn->title}}</a>
                        </h5>
                        <p class="mb-2 text-truncate-2">
                            {{$learn->description}}
                        </p>
                    </div>
                    <div class="card-footer pt-0 pb-3">
                        <hr />
                        <div class="d-flex justify-content-between">
                            <span class="h6 fw-light mb-0">
                                <i class="far fa-clock text-danger me-2"></i>By: {{$learn->user->name}}
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
