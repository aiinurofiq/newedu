@extends('layouts-landing.app')
@section('content-landing')
    <main>
        <section class="py-0 pb-lg-5">
            <div class="container">
                <div class="row g-3">
                    <div class="col-12">
                        <div class="card overflow-hidden h-200px h-xl-600px rounded-3">
                            <img src="{{ $learns->image ? asset(\Storage::url($learns->image)) : '' }}" alt="">
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
                                    {{ $learns->title }}
                                </h1>
                                <ul class="list-inline mb-0">
                                    <li class="list-inline-item h6 me-3 mb-1 mb-sm-0">
                                        <i class="fa-solid fa-circle-check"></i>
                                        <i
                                            class="fas fa-clipboard-check text-warning me-2"></i>{{ $learns->categorylearn->name }}
                                    </li>
                                    <li class="list-inline-item h6 me-3 mb-1 mb-sm-0">
                                        <i class="fas fa-user-graduate text-orange me-2"></i>By: {{ $learns->user->name }}
                                    </li>
                                    <li class="list-inline-item h6 me-3 mb-1 mb-sm-0">
                                        <i
                                            class="fas fa-clock text-orange me-2"></i>{{ $learns->created_at->format('d F Y') }}
                                    </li>
                                </ul>
                            </div>
                            <div class="col-8">
                                <div class="tab-content pt-4 px-3">
                                    <div class="tab-pane fade show active" id="course-pills-1" role="tabpanel"
                                        aria-labelledby="course-pills-tab-1">
                                        <h5 class="mb-3">Abstract Knowledge</h5>
                                        <p class="mb-3">
                                            {{ $learns->description }}
                                        </p>
                                    </div>
                                </div>
                                <div class="tab-content pt-4 px-3 d-none" id="course-pills-tabContent">
                                    <h5 class="mb-3" id='titlemodules'>Abstract Knowledge</h5>
                                    <div id="gambar" class="d-none">
                                        <img id='changeimage'
                                            src="{{ $learns->image ? asset(\Storage::url($learns->image)) : '' }}" alt="">
                                    </div>
                                    <iframe id="youtube" class="d-none" width="100%" height="500"
                                        src="https://www.youtube.com/embed/0clqrvUTCRk?si=eovY5H6cpPLb2mBs"
                                        title="YouTube video player" frameborder="0"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                        allowfullscreen></iframe>
                                    <div id="filepdf" class="d-none text-center">
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
                                <h4 class="mb-3">Modules</h4>
                                <div class="accordion accordion-icon accordion-bg-light" id="accordionExample2">
                                    @foreach ($section as $item)
                                        <div class="accordion-item mb-3">
                                            <h6 class="accordion-header font-base ">
                                                <a class="accordion-button fw-bold rounded collapsed d-block @if ($loop->index == 0) pertama @endif"
                                                    id="heading-{{ $item->id }}" href="#collapse-{{ $item->id }}"
                                                    data-bs-toggle="collapse"
                                                    data-bs-target="#collapse-{{ $item->id }}" aria-expanded="false"
                                                    aria-controls="collapse-{{ $item->id }}">
                                                    <span class="mb-0">{{ $item->title }}</span>
                                                    <span class="small d-block mt-1">({{ $item->modules->count() }}
                                                        Modules)</span>
                                                </a>
                                            </h6>
                                            <div id="collapse-{{ $item->id }}" class="accordion-collapse collapse"
                                                aria-labelledby="heading-{{ $item->id }}"
                                                data-bs-parent="#accordionExample2">
                                                <div class="accordion-body mt-3">
                                                    <div class="vstack gap-3">
                                                        @foreach ($item->modules as $items)
                                                            <div id="header-{{ $items->id }}" class='header'>
                                                                <div
                                                                    class="d-flex justify-content-between align-items-center">
                                                                    <div class="position-relative d-flex align-items-center changeimg"
                                                                        @if ($loop->index == 0) id="pertama" @endif
                                                                        data-id="{{ $items->id }}"
                                                                        data-img="{{ $items->file }}"
                                                                        data-url="{{ $items->videoembed }}"
                                                                        data-title="{{ $item->title }}"
                                                                        data-subtitle="{{ $items->title }}"
                                                                        data-description="{{ $items->description }}"
                                                                        data-duration="{{ $items->description }}">
                                                                        <div href="#" id="btn-{{ $items->id }}"
                                                                            class="btn btn-danger-soft btn-round btn-sm mb-0 ">
                                                                            <i class="fas fa-play me-0"></i>
                                                                        </div>
                                                                        <span
                                                                            class="d-inline-block text-truncate ms-2 mb-0 h6 fw-light w-200px">{{ $items->title }}</span>
                                                                    </div>
                                                                    {{-- <p class="mb-0 text-truncate"
                                                                        id='duration-{{ $items->id }}'>
                                                                        {{ $items->duration }}S
                                                                    </p> --}}
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="mt-4">
                                    <h4 class="mb-3">Quiz</h4>
                                    <div class="d-grid gap-2">
                                        <a href="{{ route('my-quiz') }}" class="btn btn-success" type="button"><i
                                                class="bi bi-question-circle-fill"></i> Take Quiz</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    @push('script')
        <script>
            var pdfDoc = null,
                pageNum = 1,
                pageRendering = false,
                pageNumPending = null,
                scale = 1,
                canvas = document.getElementById('the-canvas'),
                ctx = canvas.getContext('2d');
            // var url = 'http://edutirta.test/storage/.pdf';
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
                    $('#course-pills-tabContent').removeClass('d-none')
                    $('.btn-round').removeClass('btn-success')
                    $('.btn-round').addClass('btn-danger-soft')
                    $('.header').removeClass("p-2 bg-success bg-opacity-10 rounded-3")
                    $('#gambar').addClass('d-none')
                    $('#youtuber').addClass('d-none')
                    $('#filepdf').addClass('d-none')
                    $('.mediaplayer').addClass('d-none')
                    let dataIdheader = $(this).attr("data-id");
                    let dataId = $(this).attr("data-img");
                    let videoembed = $(this).attr("data-url");
                    let title = $(this).attr("data-title");
                    let subtitle = $(this).attr("data-subtitle");
                    let description = $(this).attr("data-description");
                    let duration = $(this).attr("data-duration");
                    $("#header-" + dataIdheader).toggleClass("p-2 bg-success bg-opacity-10 rounded-3")
                    // $("#duration-" + dataIdheader).html("Playing")
                    // alert("#btn-"+dataIdheader)
                    $("#btn-" + dataIdheader).removeClass("btn-danger-soft")
                    $("#btn-" + dataIdheader).addClass("btn-success")
                    $('#titlemodules').html(title + ' - ' + subtitle)
                    $('#descriptionmodules').html(description)
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
                                $('#gambar').removeClass('d-none')
                                $('#changeimage').attr("src",
                                    "http://edutirta.test/" + img);
                                break;
                            case 'jpeg':
                                $('#gambar').removeClass('d-none')
                                $('#changeimage').attr("src",
                                    "http://edutirta.test/" + img);
                                break;
                            case 'jpg':
                                $('#gambar').removeClass('d-none')
                                $('#changeimage').attr("src",
                                    "http://edutirta.test/" + img);
                                break;
                            case 'mp4':
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
                                $('#filepdf').removeClass('d-none')
                                url = "http://edutirta.test/" + img;
                                pageNum = 1;

                                pdfjsLib.getDocument(url).promise.then(function(pdfDoc_) {
                                    pdfDoc = pdfDoc_;
                                    document.getElementById('page_count').textContent = pdfDoc.numPages;

                                    // Initial/first page rendering
                                    renderPage(pageNum);
                                });
                                break;
                            default:
                                ele.innerHTML = 'File type: Unknown';
                        }
                    }
                });
                setTimeout(
                    function() {
                        $(".pertama").click();
                        $("#pertama").click();
                    }, 2000);
            });
        </script>
    @endpush
    
@endsection
