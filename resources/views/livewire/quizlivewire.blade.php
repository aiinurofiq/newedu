<div class="col-12">
    <div class="row g-4">
        @foreach ($learnings as $learnings)
            <div class="col-sm-6 col-lg-4 col-xl-3 {{ $action == 'R' ? '' : 'd-none' }}">
                <div class="card shadow h-100">
                    <img src="{{ $learnings->image ? asset(\Storage::url($learnings->image)) : '' }}" class="card-img-top"
                        alt="course image" />
                    <div class="card-body pb-0">
                        <div class="d-flex justify-content-between mb-2">
                            <a href="#"
                                class="badge bg-purple bg-opacity-10 text-purple">{{ $learnings->categorylearn->name }}</a>
                        </div>
                        <h5 class="card-title">
                            <div wire:click="update_learning_id({{ $learnings->id }})">{{ $learnings->title }}</div>
                        </h5>
                        <p class="mb-2 text-truncate-2">
                            {{ $learnings->description }}
                        </p>
                    </div>
                    <div class="card-footer pt-0 pb-3">
                        <hr />
                        <div class="d-flex justify-content-between">
                            <span class="h6 fw-light mb-0"><i class="far fa-clock text-danger me-2"></i> By:
                                {{ $learnings->user->name }}</span>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        @if ($section->quizzes ?? '')

        {{-- {{print_r($tempa)}} --}}
            <div class="table-responsive border-0">
                <div class="card border {{ $action == 'D' ? '' : 'd-none' }}">
                    <table class="table table-dark-gray p-4 mb-0 table-hover text-center align-middle">
                        <thead>
                            <tr>
                                <th scope="col" class="border-0 rounded-start">Section Title</th>
                                <th scope="col" class="border-0">Result</th>
                                <th scope="col" class="border-0">Passing Grade</th>
                                <th scope="col" class="border-0 rounded-end">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($section->quizzes as $sections)
                                @php
                                    $sumvalue = $this->result($sections->id) * $sections->sumvalue;
                                    // $sumvalue = $this->result($sections->id);
                                @endphp
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="w-100px"> <img
                                                    src="{{ $section->image ? asset(\Storage::url($section->image)) : '' }}"
                                                    class="rounded" alt=""> </div>
                                            <div class="mb-0 ms-2">
                                                <h6 class="table-responsive-title"><a href="#">
                                                        <p class="mb-2 text-truncate">
                                                            {{ Str::limit($sections->description, 50) }}</p>
                                                    </a></h6>
                                                {{-- <div class="overflow-hidden">
                                                    <h6 class="mb-0 text-end">100%</h6>
                                                    <div class="progress progress-sm bg-primary bg-opacity-10">
                                                        <div class="progress-bar bg-primary aos" role="progressbar"
                                                            data-aos="slide-right" data-aos-delay="200"
                                                            data-aos-duration="1000" data-aos-easing="ease-in-out"
                                                            style="width: 100%" aria-valuenow="100" aria-valuemin="0"
                                                            aria-valuemax="100"> </div>
                                                    </div>
                                                </div> --}}
                                            </div>
                                        </div>
                                    </td>
                                    <td class="font-weight-bold">
                                        <h5>{{ (int) $sumvalue }}</h5>
                                    </td>
                                    <td>
                                        <h6 class="">{{ (int) $sections->passinggrade }}</h6>
                                    </td>
                                    <td> <a href="{{ route('my-quiz-detail', ['id' => encrypt($sections->id)]) }}"
                                            class="btn btn-sm btn-primary-soft me-1 mb-1 mb-md-0"><i
                                                class="bi bi-play-circle me-1"></i>Continue</a>
                                                {{-- <button
                                            class="btn btn-sm btn-success me-1 mb-1 mb-x;-0 disabled"><i
                                                class="bi bi-check me-1"></i>Complete</button>  --}}
                                            </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <button wire:click="$set('action','R')" class="btn btn-sm btn-success"><i
                            class="bi bi-arrow-left-short me-1"></i>Kembali</button>
                </div>
            </div>
        @endif
    </div>
</div>
