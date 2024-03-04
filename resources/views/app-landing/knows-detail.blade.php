@extends('layouts-landing.app')
@section('content-landing')
    <main>
        <section class="py-0 pb-lg-5">
            <div class="container">
                <div class="row g-3">
                    <div class="col-12">
                        <div class="card overflow-hidden h-200px h-xl-600px rounded-3">
                            <img src="{{ $knows->photo ? asset(\Storage::url($knows->photo)) : '' }}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="pt-0">
            <div class="container">
                <div class="row g-lg-5">
                    <div class="col-lg-12">
                        <div class="row g-4">
                            <div class="col-12">
                                <h1>
                                    {{ $knows->title }}
                                </h1>
                                <ul class="list-inline mb-0">
                                    <li class="list-inline-item h6 me-3 mb-1 mb-sm-0">
                                        <i class="fa-solid fa-circle-check"></i>
                                        <i class="fas fa-clipboard-check text-warning me-2"></i>{{ $knows->category->name }}
                                    </li>
                                    <li class="list-inline-item h6 me-3 mb-1 mb-sm-0">
                                        <i class="fas fa-clipboard-check text-success me-2"></i>{{ $knows->topic->name }}
                                    </li>
                                    <li class="list-inline-item h6 me-3 mb-1 mb-sm-0">
                                        <i class="fas fa-user-graduate text-orange me-2"></i>By: {{ $knows->writer }}
                                    </li>
                                    <li class="list-inline-item h6 me-3 mb-1 mb-sm-0">
                                        <i class="fas fa-clock text-orange me-2"></i>Created at: {{ $knows->created_at }}
                                    </li>
                                </ul>
                            </div>
                            <div class="col-8">
                                <div class="tab-content pt-4 px-3">
                                    <div class="tab-pane fade show active" id="course-pills-1" role="tabpanel"
                                        aria-labelledby="course-pills-tab-1">
                                        <h5 class="mb-3">Knowledge Abstrak</h5>
                                        <p class="mb-3">
                                            {{ $knows->abstract }}
                                        </p>
                                    </div>
                                </div>
                                <div class="tab-content pt-4 px-3 d-none" id="course-pills-tabContent">
                                    <h5 class="mb-3" id='titlemodules'>Abstract Knowledge</h5>
                                    <div class="d-flex justify-content-center align-items-center bg-secondary"
                                        style="height: 350px;" id='loadingpdf'>
                                        <div class="spinner-border text-light" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                    </div>
                                    <div id="gambar" class="d-none">
                                        <img id='changeimage'
                                            src="{{ $knows->photo ? asset(\Storage::url($knows->photo)) : '' }}"
                                            alt="">
                                    </div>
                                    <iframe id="youtube" class="d-none" width="100%" height="500"
                                        src="https://www.youtube.com/embed/0clqrvUTCRk?si=eovY5H6cpPLb2mBs"
                                        title="YouTube video player" frameborder="0"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                        allowfullscreen></iframe>
                                    <div id="filepdf" class="text-center">
                                        <canvas id="the-canvas"
                                            style="border: 1px solid black;
                                        direction: ltr; width:100%"></canvas>
                                        <div>
                                            <button id="prev">Previous</button>
                                            <button id="next">Next</button>
                                            &nbsp; &nbsp;
                                            <span>Page: <span id="page_num"></span> / <span id="page_count"></span></span>
                                        </div>
                                    </div>
                                    <div class="plyr__video-embed" id="youtuber">
                                        <iframe src="https://www.youtube.com/embed/0clqrvUTCRk?si=eovY5H6cpPLb2mBs"
                                            allowfullscreen allowtransparency allow="autoplay"></iframe>
                                    </div>
                                    <div class="mediaplayer d-none">
                                        <div class="col-12">
                                            <div class="video-player rounded-3">
                                                <video id="videotirta" controls crossorigin="anonymous" playsinline
                                                    poster="{{ asset('assets/images/videos/poster.jpg') }}">
                                                    <source id="mediadetail"
                                                        src="{{ asset('assets/images/videos/720p.mp4') }}" type="video/mp4">
                                                </video>
                                            </div>
                                        </div>
                                        <div class="col-12 d-lg-none">
                                            <button class="btn btn-primary mb-3" type="button" data-bs-toggle="offcanvas"
                                                data-bs-target="#offcanvasSidebar" aria-controls="offcanvasSidebar">
                                                <i class="bi bi-camera-video me-1"></i> Playlist </button>
                                        </div>
                                    </div>
                                    <p class="mb-3 mt-3" id="descriptionmodules">
                                    </p>
                                </div>
                            </div>
                            <div class="col-4">
                                @if ($jurnal || $exsum || $report || $explanation)
                                    <h4 class="mb-3">Modules</h4>
                                    @if ($jurnal->count() > 0)
                                        <div class="accordion accordion-icon accordion-bg-light">
                                            <div class="accordion-item mb-3">
                                                <h6 class="accordion-header font-base ">
                                                    <a class="accordion-button fw-bold rounded collapsed d-block "
                                                        id="heading-1" href="#collapse-1" data-bs-toggle="collapse"
                                                        data-bs-target="#collapse-1" aria-expanded="false"
                                                        aria-controls="collapse-1">
                                                        <span class="mb-0">Jurnals</span>
                                                        <span class="small d-block mt-1">({{ $jurnal->count() }}
                                                            Jurnal)</span>
                                                    </a>
                                                </h6>
                                                <div id="collapse-1" class="accordion-collapse collapse"
                                                    aria-labelledby="heading-1" data-bs-parent="#accordionExample2">
                                                    <div class="accordion-body mt-3">
                                                        <div class="vstack gap-3">
                                                            @foreach ($jurnal as $items)
                                                                <div id="header-j{{ $items->id }}" class='header'>
                                                                    <div
                                                                        class="d-flex justify-content-between align-items-center">
                                                                        <div class="position-relative d-flex align-items-center changeimg"
                                                                            data-id="{{ $items->id }}" data-type="j"
                                                                            data-img="{{ explode('|', $items->file)[0] }}">
                                                                            <div href="#"
                                                                                id="btn-j{{ $items->id }}"
                                                                                class="btn btn-danger-soft btn-round btn-sm mb-0 ">
                                                                                <i class="fas fa-play me-0"></i>
                                                                            </div>
                                                                            <span
                                                                                class="d-inline-block text-truncate ms-2 mb-0 h6 fw-light w-200px">Jurnal
                                                                                {{ $loop->index + 1 }}</span>
                                                                        </div>
                                                                        @if ($request->count())
                                                                            @if ($approve ?? 0)
                                                                                <span><a href="{{ asset(\Storage::url(explode('|', $items->file)[0])) }}"
                                                                                        class="btn btn-primary-soft btn-round btn-sm mb-0 "
                                                                                        download='{{ explode('|', $items->file)[1] }}'>
                                                                                        <i
                                                                                            class="fas fa-download me-0"></i>
                                                                                    </a></span>
                                                                            @endif
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endif
                                @if ($jurnal || $exsum || $report || $explanation)
                                    @if ($exsum->count() > 0)
                                        <div class="accordion accordion-icon accordion-bg-light">
                                            <div class="accordion-item mb-3">
                                                <h6 class="accordion-header font-base ">
                                                    <a class="accordion-button fw-bold rounded collapsed d-block "
                                                        id="heading-2" href="#collapse-2" data-bs-toggle="collapse"
                                                        data-bs-target="#collapse-2" aria-expanded="false"
                                                        aria-controls="collapse-2">
                                                        <span class="mb-0">Exsum</span>
                                                        <span class="small d-block mt-1">({{ $exsum->count() }}
                                                            Exsum)</span>
                                                    </a>
                                                </h6>
                                                <div id="collapse-2" class="accordion-collapse collapse"
                                                    aria-labelledby="heading-2" data-bs-parent="#accordionExample2">
                                                    <div class="accordion-body mt-3">
                                                        <div class="vstack gap-3">
                                                            @foreach ($exsum as $items)
                                                                <div id="header-exs{{ $items->id }}" class='header'>
                                                                    <div
                                                                        class="d-flex justify-content-between align-items-center">
                                                                        <div class="position-relative d-flex align-items-center changeimg"
                                                                            data-id="{{ $items->id }}" data-type="exs"
                                                                            data-img="{{ explode('|', $items->file)[0] }}">
                                                                            <div href="#"
                                                                                id="btn-exs{{ $items->id }}"
                                                                                class="btn btn-danger-soft btn-round btn-sm mb-0 ">
                                                                                <i class="fas fa-play me-0"></i>
                                                                            </div>
                                                                            <span
                                                                                class="d-inline-block text-truncate ms-2 mb-0 h6 fw-light w-200px">Exsum
                                                                                {{ $loop->index + 1 }}</span>
                                                                        </div>
                                                                        @if ($request->count())
                                                                            @if ($approve ?? 0)
                                                                                <span><a href="{{ asset(\Storage::url(explode('|', $items->file)[0])) }}"
                                                                                        class="btn btn-primary-soft btn-round btn-sm mb-0 "
                                                                                        download='{{ explode('|', $items->file)[1] }}'>
                                                                                        <i
                                                                                            class="fas fa-download me-0"></i>
                                                                                    </a></span>
                                                                            @endif
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endif
                                @if ($jurnal || $exsum || $report || $explanation)
                                    @if ($report->count() > 0)
                                        <div class="accordion accordion-icon accordion-bg-light">
                                            <div class="accordion-item mb-3">
                                                <h6 class="accordion-header font-base ">
                                                    <a class="accordion-button fw-bold rounded collapsed d-block "
                                                        id="heading-3" href="#collapse-3" data-bs-toggle="collapse"
                                                        data-bs-target="#collapse-3" aria-expanded="false"
                                                        aria-controls="collapse-3">
                                                        <span class="mb-0">Report</span>
                                                        <span class="small d-block mt-1">({{ $report->count() }}
                                                            Report)</span>
                                                    </a>
                                                </h6>
                                                <div id="collapse-3" class="accordion-collapse collapse"
                                                    aria-labelledby="heading-3" data-bs-parent="#accordionExample2">
                                                    <div class="accordion-body mt-3">
                                                        <div class="vstack gap-3">
                                                            @foreach ($report as $items)
                                                                <div id="header-re{{ $items->id }}" class='header'>
                                                                    <div
                                                                        class="d-flex justify-content-between align-items-center">
                                                                        <div class="position-relative d-flex align-items-center changeimg"
                                                                            data-id="{{ $items->id }}" data-type="re"
                                                                            data-img="{{ explode('|', $items->file)[0] }}">
                                                                            <div href="#"
                                                                                id="btn-re{{ $items->id }}"
                                                                                class="btn btn-danger-soft btn-round btn-sm mb-0 ">
                                                                                <i class="fas fa-play me-0"></i>
                                                                            </div>
                                                                            <span
                                                                                class="d-inline-block text-truncate ms-2 mb-0 h6 fw-light w-200px">Report
                                                                                {{ $loop->index + 1 }}</span>
                                                                        </div>
                                                                        @if ($request->count())
                                                                            @if ($approve ?? 0)
                                                                                <span><a href="{{ asset(\Storage::url(explode('|', $items->file)[0])) }}"
                                                                                        class="btn btn-primary-soft btn-round btn-sm mb-0 "
                                                                                        download='{{ explode('|', $items->file)[1] }}'>
                                                                                        <i
                                                                                            class="fas fa-download me-0"></i>
                                                                                    </a></span>
                                                                            @endif
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endif
                                @if ($jurnal || $exsum || $report || $explanation)
                                    @if ($explanation->count() > 0)
                                        <div class="accordion accordion-icon accordion-bg-light">
                                            <div class="accordion-item mb-3">
                                                <h6 class="accordion-header font-base ">
                                                    <a class="accordion-button fw-bold rounded collapsed d-block "
                                                        id="heading-4" href="#collapse-4" data-bs-toggle="collapse"
                                                        data-bs-target="#collapse-4" aria-expanded="false"
                                                        aria-controls="collapse-4">
                                                        <span class="mb-0">Explanation</span>
                                                        <span class="small d-block mt-1">({{ $explanation->count() }}
                                                            Explanation)</span>
                                                    </a>
                                                </h6>
                                                <div id="collapse-4" class="accordion-collapse collapse"
                                                    aria-labelledby="heading-4" data-bs-parent="#accordionExample2">
                                                    <div class="accordion-body mt-3">
                                                        <div class="vstack gap-3">
                                                            @foreach ($explanation as $items)
                                                                <div id="header-exp{{ $items->id }}" class='header'>
                                                                    <div
                                                                        class="d-flex justify-content-between align-items-center">
                                                                        <div class="position-relative d-flex align-items-center changeimg"
                                                                            data-id="{{ $items->id }}" data-type="exp"
                                                                            data-img="{{ explode('|', $items->file)[0] }}">
                                                                            <div href="#"
                                                                                id="btn-exp{{ $items->id }}"
                                                                                class="btn btn-danger-soft btn-round btn-sm mb-0 ">
                                                                                <i class="fas fa-play me-0"></i>
                                                                            </div>
                                                                            <span
                                                                                class="d-inline-block text-truncate ms-2 mb-0 h6 fw-light w-200px">Explanation
                                                                                {{ $loop->index + 1 }}</span>
                                                                        </div>
                                                                        @if ($request->count())
                                                                            @if ($approve ?? 0)
                                                                                <span><a href="{{ asset(\Storage::url(explode('|', $items->file)[0])) }}"
                                                                                        class="btn btn-primary-soft btn-round btn-sm mb-0 "
                                                                                        download='{{ explode('|', $items->file)[1] }}'>
                                                                                        <i
                                                                                            class="fas fa-download me-0"></i>
                                                                                    </a></span>
                                                                            @endif
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endif
                                @if (Request::segment(1) != 'view')
                                    @if ($request->count())
                                        <div class="mt-4">
                                            <h4 class="mb-3">Request Knowledge</h4>
                                            <div class="d-grid gap-2">
                                                @if ($approve)
                                                    <button href="#" data-bs-toggle="modal" data-bs-target=""
                                                        class="btn btn-success" type="button"><i
                                                            class="bi bi-question-circle-fill"></i>
                                                        Approved Request</button>
                                                @else
                                                    <button href="#" data-bs-toggle="modal"
                                                        data-bs-target="#exampleModal"
                                                        class="btn btn-{{ $checkreject->status ? 'danger' : 'warning' }}"
                                                        type="button"><i class="bi bi-question-circle-fill"></i>
                                                        {{ $checkreject->status ? 'Send' : 'Waiting' }} Request</button>
                                                @endif
                                            </div>
                                        </div>
                                    @else
                                        <div class="mt-4">
                                            <h4 class="mb-3">Request Knowledge</h4>
                                            <div class="d-grid gap-2">
                                                <button href="#" data-bs-toggle="modal"
                                                    data-bs-target="#exampleModal" class="btn btn-primary"
                                                    type="button"><i class="bi bi-question-circle-fill"></i> Send
                                                    Request</button>
                                            </div>
                                        </div>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </main>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form name="add-blog-post-form" id="add-blog-post-form" method="post"
                    action="{{ url('requestlanding') }}">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Request Knowledge</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @if ($request->count())
                            @if ($checkreject->status == 2)
                                <div class="row mb-3">
                                    <div class="col-12 mt-2">Note Sebelum</div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-12">
                                        @if ($checkreject->status == 2)
                                            <input type="text" class="form-control"
                                                value="{{ $checkreject->description }}" aria-label="Username"
                                                aria-describedby="basic-addon1" disabled>
                                        @endif
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-12 mt-2">Balasan</div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-12">
                                        @if ($request->count())
                                            @if ($checkreject->status == 2)
                                                <input type="text" class="form-control"
                                                    value="{{ $checkreject->comment }}" aria-label="Username"
                                                    aria-describedby="basic-addon1" disabled>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            @endif
                        @endif
                        <div class="row mb-3">
                            <div class="col-12 mt-2">Note Request</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-12">
                                @if ($request->count())
                                    <input name='requestknow' id='requestknow' type="text" class="form-control"
                                        value="{{ $checkreject->status == 0 ? $checkreject->description : '' }}"
                                        aria-label="Username" aria-describedby="basic-addon1"
                                        {{ $checkreject->status == 2 || $checkreject->status == 1 ? '' : 'disabled' }}>
                                @else
                                    <input name='requestknow' id='requestknow' type="text" class="form-control"
                                        value="" aria-label="Username" aria-describedby="basic-addon1">
                                @endif
                                <input name='idknow' id='idknow' type="text" class="form-control d-none"
                                    value="{{ $knows->id }}" aria-label="Username" aria-describedby="basic-addon1">
                            </div>
                        </div>
                        @if ($request->count())
                            @if ($checkreject->status == 2 || $checkreject->status == 1)
                                <hr>
                                <p class="ms-2"><span class="fw-bold">Note :</span> Silahkan mengisi note sebagai alasan
                                    dalam akses file knowledge dan menunggu approve dari kami. Terima Kasih!</p>
                            @endif
                        @else
                            <hr>
                            <p class="ms-2"><span class="fw-bold">Note :</span> Silahkan mengisi note sebagai alasan
                                dalam akses file knowledge dan menunggu approve dari kami. Terima Kasih!</p>
                        @endif

                    </div>
                    <div class="modal-footer">
                        @if ($request->count())
                            @if ($checkreject->status == 2 || $checkreject->status == 1)
                                <button type="submit" class="btn btn-primary">Send</button>
                            @endif
                        @else
                            <button type="submit" class="btn btn-primary">Send</button>
                        @endif
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @push('script')
        <script>
            var pdfDoc = null,
                pageNum = 1,
                pageRendering = false,
                pageNumPending = null,
                scale = 1,
                canvas = document.getElementById('the-canvas'),
                ctx = canvas.getContext('2d');
            // var url = 'https://s2.q4cdn.com/170666959/files/Blank.pdf';
            var url = 'https://raw.githubusercontent.com/mozilla/pdf.js/ba2edeae/web/compressed.tracemonkey-pldi-09.pdf';

            // Loaded via <script> tag, create shortcut to access PDF.js exports.
            var pdfjsLib = window['pdfjs-dist/build/pdf'];

            // The workerSrc property shall be specified.
            pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.worker.min.js';


            /**
             * Get page info from document, resize canvas accordingly, and render page.
             * @param num Page number.
             */
            function renderPage(num) {
                pageRendering = true;
                // Using promise to fetch the page
                pdfDoc.getPage(num).then(function(page) {
                    var viewport = page.getViewport({
                        scale: scale
                    });
                    canvas.height = viewport.height;
                    canvas.width = viewport.width;

                    // Render PDF page into canvas context
                    var renderContext = {
                        canvasContext: ctx,
                        viewport: viewport
                    };
                    var renderTask = page.render(renderContext);

                    // Wait for rendering to finish
                    renderTask.promise.then(function() {
                        pageRendering = false;
                        if (pageNumPending !== null) {
                            // New page rendering is pending
                            renderPage(pageNumPending);
                            pageNumPending = null;
                        }
                    });
                });

                // Update page counters
                document.getElementById('page_num').textContent = num;
            }

            /**
             * If another page rendering in progress, waits until the rendering is
             * finised. Otherwise, executes rendering immediately.
             */
            function queueRenderPage(num) {
                if (pageRendering) {
                    pageNumPending = num;
                } else {
                    renderPage(num);
                }
            }

            /**
             * Displays previous page.
             */
            function onPrevPage() {
                if (pageNum <= 1) {
                    return;
                }
                pageNum--;
                queueRenderPage(pageNum);
            }
            document.getElementById('prev').addEventListener('click', onPrevPage);

            /**
             * Displays next page.
             */
            function onNextPage() {
                if (pageNum >= pdfDoc.numPages) {
                    return;
                }
                pageNum++;
                queueRenderPage(pageNum);
            }
            document.getElementById('next').addEventListener('click', onNextPage);

            /**
             * Asynchronously downloads PDF.
             */
            pdfjsLib.getDocument(url).promise.then(function(pdfDoc_) {
                pdfDoc = pdfDoc_;
                document.getElementById('page_count').textContent = pdfDoc.numPages;

                // Initial/first page rendering
                renderPage(pageNum);
            });
            $(document).ready(function() {
                const player2 = new Plyr('#youtuber');
                window.player = player2;
                const player = new Plyr('video');
                window.player = player;
                $(".changeimg").on("click", function() {
                    player.stop();
                    player2.stop();
                    $('#loadingpdf').removeClass('d-none')
                    $('#course-pills-tabContent').removeClass('d-none')
                    $('.btn-round').removeClass('btn-success')
                    $('.btn-round').addClass('btn-danger-soft')
                    $('.header').removeClass("p-2 bg-success bg-opacity-10 rounded-3")
                    $('#gambar').addClass('d-none')
                    $('#youtuber').addClass('d-none')
                    $('#filepdf').addClass('d-none')
                    $('.mediaplayer').addClass('d-none')
                    let dataIdheader = $(this).attr("data-id");
                    let typemod = $(this).attr("data-type");
                    let dataId = $(this).attr("data-img");
                    let videoembed = $(this).attr("data-url");
                    $("#header-" + typemod + dataIdheader).toggleClass("p-2 bg-success bg-opacity-10 rounded-3")
                    // $("#duration-" + dataIdheader).html("Playing")
                    // alert("#btn-"+dataIdheader)
                    $("#btn-" + typemod + dataIdheader).removeClass("btn-danger-soft")
                    $("#btn-" + typemod + dataIdheader).addClass("btn-success")
                    if (videoembed) {
                        $('#youtuber').removeClass('d-none')
                        $('#youtuber').attr("src",
                            videoembed);
                        player2.source = {
                            type: 'video',
                            sources: [{
                                src: videoembed,
                                provider: 'youtube',
                            }, ],
                        };
                    } else {
                        var img = dataId.replace('public', 'storage');
                        fileExtension = dataId.replace(/^.*\./, '');
                        switch (fileExtension) {
                            case 'png':
                                $('#loadingpdf').addClass('d-none')
                                $('#gambar').removeClass('d-none')
                                $('#changeimage').attr("src",
                                    "http://edutirta.test/" + img);
                                break;
                            case 'jpeg':
                                $('#loadingpdf').addClass('d-none')
                                $('#gambar').removeClass('d-none')
                                $('#changeimage').attr("src",
                                    "http://edutirta.test/" + img);
                                break;
                            case 'jpg':
                                $('#loadingpdf').addClass('d-none')
                                $('#gambar').removeClass('d-none')
                                $('#changeimage').attr("src",
                                    "http://edutirta.test/" + img);
                                break;
                            case 'mp4':
                                $('#loadingpdf').addClass('d-none')
                                $('.mediaplayer').removeClass('d-none')
                                // player.play();
                                // $('#mediadetail').attr("src",
                                //     "http://edutirta.test/" + img);
                                src = "http://edutirta.test/" + img;
                                type = "video/mp4";
                                poster = "";
                                // alert(player)

                                player.source = {
                                    type: 'video',
                                    title: 'Example title',
                                    sources: [{
                                        src: src,
                                        type: type,
                                        size: 720
                                    }],
                                    poster: poster
                                };

                                // player.play();
                                break;
                            case 'pdf':
                                url = "http://edutirta.test/" + img;
                                pageNum = 1;

                                pdfjsLib.getDocument(url).promise.then(function(pdfDoc_) {
                                    $('#loadingpdf').addClass('d-none')
                                    $('#filepdf').removeClass('d-none')
                                    pdfDoc = pdfDoc_;
                                    document.getElementById('page_count').textContent = pdfDoc.numPages;

                                    // Initial/first page rendering
                                    var loadingTask = renderPage(pageNum);
                                    loadingTask.promise.then(function(pdf) {
                                        alert('asd')
                                    });
                                });
                                break;
                            default:
                                ele.innerHTML = 'File type: Unknown';
                        }
                    }
                });
            });
        </script>
    @endpush


@endsection
