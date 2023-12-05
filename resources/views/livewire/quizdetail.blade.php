<div class="card border" wire:init="cek">
    {{-- <div class="card border"> --}}
    <div class="card-header border-bottom">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="row g-0">
                        <div class="col-md-2"> <img src="{{ $section->image ? asset(\Storage::url($section->image)) : '' }}"
                                class="rounded-2" alt="Card image"> </div>
                        <div class="col-md-10">
                            <div class="card-body">
                                <h3 class="card-title"><a href="#">Quiz
                                        {{ $quiz->description }}</a>
                                </h3>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if ($question)
        @if ($question_id == $question->count())
            <div class="card bg-transparent border rounded-3 m-2">
                <div class="card-header bg-light border-bottom px-lg-6 pt-6 pb-6 ">
                    <p class="lead justify-content text-center">Anda akan menyimpan hasil Quiz anda, apakah anda yakin?.</p>

                    <div class="d-flex justify-content-center">
                        <button wire:click.prevent="submit()" type="button" class="btn btn-success mb-0 me-3">Akhiri Quiz</button>
                            <button wire:click.prevent="back()" type="button" class="btn btn-primary mb-0">Kembali</button>
                    </div>
                </div>
            </div>
        @else
            <div class="card-body">
                <h5 class="text-danger text-end"><i class="bi bi-clock-history me-2"></i>Time Left: <span wire:ignore
                        id="demo">0h
                        00m 00s</span></h5>
                <div class="card bg-transparent border rounded-3 mb-1" id="myGroup">
                    <div class="card-header bg-light border-bottom px-lg-5">
                        <div class="row row-cols-auto">
                            @foreach ($quiz->questions as $item)
                                <div class="col mt-3">
                                    <button wire:click.prevent="qot({{ $loop->index }})"
                                        class="btn 
                                @if (array_key_exists($loop->index, $jwb)) btn-primary
                            @else
                            btn-outline-primary @endif "
                                        type="button">{{ $loop->index + 1 }}</button>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="card card-body">
                            <h4>{{ $question_id + 1 }}. {{ $qot }}</h4>
                            <hr>
                            <div class="vstack gap-2">
                                @foreach ($answers as $items)
                                    <div>
                                        <input wire:model="answer" type="radio" class="btn-check"
                                            name="ques{{ $question_id }}" id="option{{ $items->id }}"
                                            value="{{ $items->id }}"
                                            @if (array_key_exists($question_id, $jwb)) @if ($jwb[$question_id] == $items->id)
                                        selected @endif
                                            @endif>
                                        <label class="btn btn-outline-primary w-100"
                                            for="option{{ $items->id }}">{{ $items->answer }}</label>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between mt-3">
                                @if ($question_id != 0)
                                    <button wire:click.prevent="back()" type="button"
                                        class="btn btn-primary next-btn mb-0">Back
                                        question</button>
                                @else
                                    <div></div>
                                @endif
                                @if ($question_id != $question->count() - 1)
                                    <button wire:click.prevent="next()" type="button"
                                        class="btn btn-primary next-btn mb-0">Next
                                        question</button>
                                @else<button wire:click.prevent="next()" type="button"
                                        class="btn btn-success next-btn mb-0">View
                                        result</button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @else
        @if ($status == 1)
            <div class="card bg-transparent border rounded-3 m-2">
                <div class="card-header bg-light border-bottom px-lg-6 pt-6 pb-6 ">
                    <p class="lead justify-content">Pada learning ini terdapat sebuah Quiz dari section
                        {{ $quiz->description }} dengan waktu pengerjaan selama {{ $quiz->questions->count() * 3 }}
                        Menit,
                        Quiz akan berakhir ketika anda menyelesaikan soal atau waktu yang ditentukan sudah berakhir.</p>

                    <div class="d-flex justify-content-center">
                        <button wire:click.prevent="start()" type="button" class="btn btn-primary mb-0">Mulai
                            Quiz</button>
                    </div>
                </div>
            </div>
        @endif
    @endif
</div>

@push('script')
    <script>
        document.addEventListener("livewire:load", function(event) {
            window.livewire.on('change', (param) => {
                $("#option" + param).prop("checked", true);
                // alert("#option"+param)
            });
            window.livewire.on('time', (param) => {
                // alert('asd')
                let deadline = new Date(param).getTime();

                // To call defined fuction every second
                let x = setInterval(function() {

                    // Getting current time in required format
                    let now = new Date().getTime();

                    // Calculating the difference
                    let t = deadline - now;

                    // Getting value of days, hours, minutes, seconds
                    // let days = Math.floor(t / (1000 * 60 * 60 * 24));
                    let hours = Math.floor(
                        (t % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    let minutes = Math.floor(
                        (t % (1000 * 60 * 60)) / (1000 * 60));
                    let seconds = Math.floor(
                        (t % (1000 * 60)) / 1000);

                    // Output the remaining time
                    document.getElementById("demo").innerHTML = +hours + "h " +
                        minutes + "m " + seconds + "s ";

                    // Output for over time
                    if (t < 0) {
                        clearInterval(x);
                        document.getElementById("demo")
                            .innerHTML = "EXPIRED";
                            window.livewire.emit('submit');
                    }
                }, 1000);
            });
        });
    </script>
@endpush
