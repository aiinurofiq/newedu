@extends('layouts-landing.app')
@section('content-landing')
<main>
    <section class="py-0 pb-lg-5">
      <div class="container">
        <div class="row g-3">
          <div class="col-12">
              <div class="card overflow-hidden h-200px h-xl-600px rounded-3">
                  <img src="{{ $knows->photo ? \Storage::url($knows->photo) : '' }}" alt="">
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
                  {{$knows->title}}
                </h1>
                <ul class="list-inline mb-0">
                  <li class="list-inline-item h6 me-3 mb-1 mb-sm-0">
                    <i class="fa-solid fa-circle-check"></i>
                    <i class="fas fa-clipboard-check text-warning me-2"></i>{{$knows->category->name}}
                  </li>
                  <li class="list-inline-item h6 me-3 mb-1 mb-sm-0">
                    <i class="fas fa-clipboard-check text-success me-2"></i>{{$knows->topic->name}}
                  </li>
                  <li class="list-inline-item h6 me-3 mb-1 mb-sm-0">
                    <i class="fas fa-user-graduate text-orange me-2"></i>By: {{$knows->writer}}
                  </li>
                  <li class="list-inline-item h6 me-3 mb-1 mb-sm-0">
                    <i class="fas fa-clock text-orange me-2"></i>Created at: {{$knows->created_at}}
                  </li>
                </ul>
              </div>
              <div class="col-12">
                <div
                  class="tab-content pt-4 px-3"
                  id="course-pills-tabContent">
                  <div
                    class="tab-pane fade show active"
                    id="course-pills-1"
                    role="tabpanel"
                    aria-labelledby="course-pills-tab-1">
                    <h5 class="mb-3">Knowledge Abstrak</h5>
                    <p class="mb-3">
                      {{$knows->abstract}}
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-12">
            <div class="offcanvas-body p-lg-0">
              {{-- Report --}}
              @if(!empty($report->file))
              <div class="col">
                <div class="accordion accordion-icon accordion-bg-light" id="accordionExample2">
                  <div class="accordion-item mb-3">
                    <h6 class="accordion-header font-base" id="heading-1">
                      <a class="accordion-button fw-bold rounded collapsed d-block" href="#collapse-1" data-bs-toggle="collapse" data-bs-target="#collapse-1" aria-expanded="false" aria-controls="collapse-1">
                        <span class="mb-0">Report</span>
                        <span class="small d-block mt-1"> @if ($report) ({{ $report->where('knowledge_id', $knows->id)->count() }} File) @else (0 File) @endif </span>
                      </a>
                    </h6>
                    <div id="collapse-1" class="accordion-collapse collapse" aria-labelledby="heading-1" data-bs-parent="#accordionExample2">
                      <div class="accordion-body mt-3">
                        <div class="vstack gap-3">
                          <div class="overflow-hidden">
                            <div class="progress-bar bg-primary aos" role="progressbar" data-aos="slide-right" data-aos-delay="200" data-aos-duration="1000" data-aos-easing="ease-in-out" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center"> @if ($report) <div>
                            <button id="prev-report" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 mt-4">Previous</button>
                            <button id="next-report" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 mt-4">Next</button> &nbsp; &nbsp; <span>Page: <span id="page_num-report"></span> / <span id="page_count-report"></span>
                            </span>
                          </div>
                          <div style="max-height: 1080px; overflow-y: auto;">
                            <canvas id="the-canvas-report"></canvas>
                          </div> @else Data Belum Tersedia @endif
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              @endif
              {{-- Jurnal --}}
              @if(!empty($jurnal->file))
              <div class="col">
                <div class="accordion accordion-icon accordion-bg-light" id="accordionExample2">
                  <div class="accordion-item mb-3">
                    <h6 class="accordion-header font-base" id="heading-1">
                      <a class="accordion-button fw-bold rounded collapsed d-block" href="#collapse-2" data-bs-toggle="collapse" data-bs-target="#collapse-2" aria-expanded="false" aria-controls="collapse-2">
                        <span class="mb-0">Jurnal</span>
                        <span class="small d-block mt-1"> @if ($jurnal) ({{ $jurnal->where('knowledge_id', $knows->id)->count() }} File) @else (0 File) @endif </span>
                      </a>
                    </h6>
                    <div id="collapse-2" class="accordion-collapse collapse" aria-labelledby="heading-1" data-bs-parent="#accordionExample2">
                      <div class="accordion-body mt-3">
                        <div class="vstack gap-3">
                          <div class="overflow-hidden">
                            <div class="progress-bar bg-primary aos" role="progressbar" data-aos="slide-right" data-aos-delay="200" data-aos-duration="1000" data-aos-easing="ease-in-out" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center"> @if ($jurnal) <div>
                            <button id="prev-jurnal" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 mt-4">Previous</button>
                            <button id="next-jurnal" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 mt-4">Next</button> &nbsp; &nbsp; <span>Page: <span id="page_num-jurnal"></span> / <span id="page_count-jurnal"></span>
                            </span>
                          </div>
                          <div style="max-height: 1080px; overflow-y: auto;">
                            <canvas id="the-canvas-jurnal"></canvas>
                          </div> @else Data Belum Tersedia @endif
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              @endif
              {{-- Exsum --}}
              @if(!empty($exsum->file))
              <div class="col">
                <div class="accordion accordion-icon accordion-bg-light" id="accordionExample2">
                  <div class="accordion-item mb-3">
                    <h6 class="accordion-header font-base" id="heading-1">
                      <a class="accordion-button fw-bold rounded collapsed d-block" href="#collapse-3" data-bs-toggle="collapse" data-bs-target="#collapse-3" aria-expanded="false" aria-controls="collapse-3">
                        <span class="mb-0">Exsum</span>
                        <span class="small d-block mt-1"> @if ($exsum) ({{ $exsum->where('knowledge_id', $knows->id)->count() }} File) @else (0 File) @endif </span>
                      </a>
                    </h6>
                    <div id="collapse-3" class="accordion-collapse collapse" aria-labelledby="heading-1" data-bs-parent="#accordionExample2">
                      <div class="accordion-body mt-3">
                        <div class="vstack gap-3">
                          <div class="overflow-hidden">
                            <div class="progress-bar bg-primary aos" role="progressbar" data-aos="slide-right" data-aos-delay="200" data-aos-duration="1000" data-aos-easing="ease-in-out" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center"> @if ($exsum) <div>
                            <button id="prev-exsum" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 mt-4">Previous</button>
                            <button id="next-exsum" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 mt-4">Next</button> &nbsp; &nbsp; <span>Page: <span id="page_num-exsum"></span> / <span id="page_count-exsum"></span>
                            </span>
                          </div>
                          <div style="max-height: 1080px; overflow-y: auto;">
                            <canvas id="the-canvas-exsum"></canvas>
                          </div> @else Data Belum Tersedia @endif
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              @endif
              {{-- Explanation --}}
              @if(!empty($explanation->file))
              <div class="col">
                <div class="accordion accordion-icon accordion-bg-light" id="accordionExample2">
                  <div class="accordion-item mb-3">
                    <h6 class="accordion-header font-base" id="heading-1">
                      <a class="accordion-button fw-bold rounded collapsed d-block" href="#collapse-4" data-bs-toggle="collapse" data-bs-target="#collapse-4" aria-expanded="false" aria-controls="collapse-4">
                        <span class="mb-0">Explanation</span>
                        <span class="small d-block mt-1"> @if ($explanation) ({{ $explanation->where('knowledge_id', $knows->id)->count() }} File) @else (0 File) @endif </span>
                      </a>
                    </h6>
                    <div id="collapse-4" class="accordion-collapse collapse" aria-labelledby="heading-1" data-bs-parent="#accordionExample2">
                      <div class="accordion-body mt-3">
                        <div class="vstack gap-3">
                          <div class="overflow-hidden">
                            <div class="progress-bar bg-primary aos" role="progressbar" data-aos="slide-right" data-aos-delay="200" data-aos-duration="1000" data-aos-easing="ease-in-out" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center"> @if ($explanation) <div>
                            <button id="prev-explanation" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 mt-4">Previous</button>
                            <button id="next-explanation" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 mt-4">Next</button> &nbsp; &nbsp; <span>Page: <span id="page_num-explanation"></span> / <span id="page_count-explanation"></span>
                            </span>
                          </div>
                          <div style="max-height: 1080px; overflow-y: auto;">
                            <canvas id="the-canvas-explanation"></canvas>
                          </div> @else Data Belum Tersedia @endif
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              @endif
                 
            </div>
          </div>
        </div>
      </div>
    </section>
</main>
<script src="//mozilla.github.io/pdf.js/build/pdf.js"></script>
{{-- Report --}}
@if(!empty($report->file))
<script>
  var reportUrl = '{{ url(\Storage::url($report->file)) }}';

  var pdfjsLib = window['pdfjs-dist/build/pdf'];
  pdfjsLib.GlobalWorkerOptions.workerSrc = '//mozilla.github.io/pdf.js/build/pdf.worker.js';

  var reportPdfDoc = null,
    pageNum = 1,
    pageRendering = false,
    pageNumPending = null,
    scale = 1.8;

  var reportCanvas = document.getElementById('the-canvas-report');
  var reportCtx = reportCanvas.getContext('2d');
  var reportTotalPages = 0;

  function renderPage(num, pdfDoc, canvas, ctx, pageCountElement) {
    pageRendering = true;
    pdfDoc.getPage(num).then(function(page) {
      var viewport = page.getViewport({ scale: scale });
      canvas.height = viewport.height;
      canvas.width = viewport.width;

      var renderContext = {
        canvasContext: ctx,
        viewport: viewport,
      };
      var renderTask = page.render(renderContext);

      renderTask.promise.then(function() {
        pageRendering = false;
        if (pageNumPending !== null) {
          renderPage(pageNumPending, pdfDoc, canvas, ctx, pageCountElement);
          pageNumPending = null;
        }
      });
    });

    pageCountElement.textContent = num;
  }

  function queueRenderPage(num, pdfDoc, canvas, ctx, pageCountElement) {
    if (pageRendering) {
      pageNumPending = num;
    } else {
      renderPage(num, pdfDoc, canvas, ctx, pageCountElement);
    }
  }

  function onPrevPage(event) {
    if (pageNum <= 1) {
      return;
    }
    pageNum--;
    queueRenderPage(pageNum, reportPdfDoc, reportCanvas, reportCtx, document.getElementById('page_count-report'));
  }

  function onNextPage(event) {
    if (pageNum >= reportTotalPages) {
      return;
    }
    pageNum++;
    queueRenderPage(pageNum, reportPdfDoc, reportCanvas, reportCtx, document.getElementById('page_count-report'));
  }

  function loadPdf(url, canvas, ctx, pageCountElement) {
    pdfjsLib.getDocument(url).promise.then(function(pdfDoc) {
      reportTotalPages = pdfDoc.numPages;
      pageCountElement.textContent = reportTotalPages;
      reportPdfDoc = pdfDoc;

      renderPage(pageNum, pdfDoc, canvas, ctx, pageCountElement);
    });
  }

  document.getElementById('prev-report').addEventListener('click', onPrevPage);
  document.getElementById('next-report').addEventListener('click', onNextPage);

  loadPdf(reportUrl, reportCanvas, reportCtx, document.getElementById('page_count-report'));
</script>
@endif
{{-- Jurnal --}}
@if(!empty($jurnal->file))
<script>
  var jurnalUrl = '{{ url(\Storage::url($jurnal->file)) }}';

  var pdfjsLib = window['pdfjs-dist/build/pdf'];
  pdfjsLib.GlobalWorkerOptions.workerSrc = '//mozilla.github.io/pdf.js/build/pdf.worker.js';

  var jurnalPdfDoc = null,
    pageNum = 1,
    pageRendering = false,
    pageNumPending = null,
    scale = 1.8;

  var jurnalCanvas = document.getElementById('the-canvas-jurnal');
  var jurnalCtx = jurnalCanvas.getContext('2d');
  var jurnalTotalPages = 0;

  function renderPage(num, pdfDoc, canvas, ctx, pageCountElement) {
    pageRendering = true;
    pdfDoc.getPage(num).then(function(page) {
      var viewport = page.getViewport({ scale: scale });
      canvas.height = viewport.height;
      canvas.width = viewport.width;

      var renderContext = {
        canvasContext: ctx,
        viewport: viewport,
      };
      var renderTask = page.render(renderContext);

      renderTask.promise.then(function() {
        pageRendering = false;
        if (pageNumPending !== null) {
          renderPage(pageNumPending, pdfDoc, canvas, ctx, pageCountElement);
          pageNumPending = null;
        }
      });
    });

    pageCountElement.textContent = num;
  }

  function queueRenderPage(num, pdfDoc, canvas, ctx, pageCountElement) {
    if (pageRendering) {
      pageNumPending = num;
    } else {
      renderPage(num, pdfDoc, canvas, ctx, pageCountElement);
    }
  }

  function onPrevPage(event) {
    if (pageNum <= 1) {
      return;
    }
    pageNum--;
    queueRenderPage(pageNum, jurnalPdfDoc, jurnalCanvas, jurnalCtx, document.getElementById('page_count-jurnal'));
  }

  function onNextPage(event) {
    if (pageNum >= jurnalTotalPages) {
      return;
    }
    pageNum++;
    queueRenderPage(pageNum, jurnalPdfDoc, jurnalCanvas, jurnalCtx, document.getElementById('page_count-jurnal'));
  }

  function loadPdf(url, canvas, ctx, pageCountElement) {
    pdfjsLib.getDocument(url).promise.then(function(pdfDoc) {
      jurnalTotalPages = pdfDoc.numPages;
      pageCountElement.textContent = jurnalTotalPages;
      jurnalPdfDoc = pdfDoc;

      renderPage(pageNum, pdfDoc, canvas, ctx, pageCountElement);
    });
  }

  document.getElementById('prev-jurnal').addEventListener('click', onPrevPage);
  document.getElementById('next-jurnal').addEventListener('click', onNextPage);

  loadPdf(jurnalUrl, jurnalCanvas, jurnalCtx, document.getElementById('page_count-jurnal'));
</script>
@endif
{{-- Exsum --}}
@if(!empty($exsum->file))
<script>
  var exsumUrl = '{{ url(\Storage::url($exsum->file)) }}';

  var pdfjsLib = window['pdfjs-dist/build/pdf'];
  pdfjsLib.GlobalWorkerOptions.workerSrc = '//mozilla.github.io/pdf.js/build/pdf.worker.js';

  var exsumPdfDoc = null,
    pageNum = 1,
    pageRendering = false,
    pageNumPending = null,
    scale = 1.8;

  var exsumCanvas = document.getElementById('the-canvas-exsum');
  var exsumCtx = exsumCanvas.getContext('2d');
  var exsumTotalPages = 0;

  function renderPage(num, pdfDoc, canvas, ctx, pageCountElement) {
    pageRendering = true;
    pdfDoc.getPage(num).then(function(page) {
      var viewport = page.getViewport({ scale: scale });
      canvas.height = viewport.height;
      canvas.width = viewport.width;

      var renderContext = {
        canvasContext: ctx,
        viewport: viewport,
      };
      var renderTask = page.render(renderContext);

      renderTask.promise.then(function() {
        pageRendering = false;
        if (pageNumPending !== null) {
          renderPage(pageNumPending, pdfDoc, canvas, ctx, pageCountElement);
          pageNumPending = null;
        }
      });
    });

    pageCountElement.textContent = num;
  }

  function queueRenderPage(num, pdfDoc, canvas, ctx, pageCountElement) {
    if (pageRendering) {
      pageNumPending = num;
    } else {
      renderPage(num, pdfDoc, canvas, ctx, pageCountElement);
    }
  }

  function onPrevPage(event) {
    if (pageNum <= 1) {
      return;
    }
    pageNum--;
    queueRenderPage(pageNum, exsumPdfDoc, exsumCanvas, exsumCtx, document.getElementById('page_count-exsum'));
  }

  function onNextPage(event) {
    if (pageNum >= exsumTotalPages) {
      return;
    }
    pageNum++;
    queueRenderPage(pageNum, exsumPdfDoc, exsumCanvas, exsumCtx, document.getElementById('page_count-exsum'));
  }

  function loadPdf(url, canvas, ctx, pageCountElement) {
    pdfjsLib.getDocument(url).promise.then(function(pdfDoc) {
      exsumTotalPages = pdfDoc.numPages;
      pageCountElement.textContent = exsumTotalPages;
      exsumPdfDoc = pdfDoc;

      renderPage(pageNum, pdfDoc, canvas, ctx, pageCountElement);
    });
  }

  document.getElementById('prev-exsum').addEventListener('click', onPrevPage);
  document.getElementById('next-exsum').addEventListener('click', onNextPage);

  loadPdf(exsumUrl, exsumCanvas, exsumCtx, document.getElementById('page_count-exsum'));
</script>
@endif
{{-- Explanation --}}
@if(!empty($explanation->file))
<script>
  var explanationUrl = '{{ url(\Storage::url($explanation->file)) }}';

  var pdfjsLib = window['pdfjs-dist/build/pdf'];
  pdfjsLib.GlobalWorkerOptions.workerSrc = '//mozilla.github.io/pdf.js/build/pdf.worker.js';

  var explanationPdfDoc = null,
    pageNum = 1,
    pageRendering = false,
    pageNumPending = null,
    scale = 1.8;

  var explanationCanvas = document.getElementById('the-canvas-explanation');
  var explanationCtx = explanationCanvas.getContext('2d');
  var explanationTotalPages = 0;

  function renderPage(num, pdfDoc, canvas, ctx, pageCountElement) {
    pageRendering = true;
    pdfDoc.getPage(num).then(function(page) {
      var viewport = page.getViewport({ scale: scale });
      canvas.height = viewport.height;
      canvas.width = viewport.width;

      var renderContext = {
        canvasContext: ctx,
        viewport: viewport,
      };
      var renderTask = page.render(renderContext);

      renderTask.promise.then(function() {
        pageRendering = false;
        if (pageNumPending !== null) {
          renderPage(pageNumPending, pdfDoc, canvas, ctx, pageCountElement);
          pageNumPending = null;
        }
      });
    });

    pageCountElement.textContent = num;
  }

  function queueRenderPage(num, pdfDoc, canvas, ctx, pageCountElement) {
    if (pageRendering) {
      pageNumPending = num;
    } else {
      renderPage(num, pdfDoc, canvas, ctx, pageCountElement);
    }
  }

  function onPrevPage(event) {
    if (pageNum <= 1) {
      return;
    }
    pageNum--;
    queueRenderPage(pageNum, explanationPdfDoc, explanationCanvas, explanationCtx, document.getElementById('page_count-explanation'));
  }

  function onNextPage(event) {
    if (pageNum >= explanationTotalPages) {
      return;
    }
    pageNum++;
    queueRenderPage(pageNum, explanationPdfDoc, explanationCanvas, explanationCtx, document.getElementById('page_count-explanation'));
  }

  function loadPdf(url, canvas, ctx, pageCountElement) {
    pdfjsLib.getDocument(url).promise.then(function(pdfDoc) {
      explanationTotalPages = pdfDoc.numPages;
      pageCountElement.textContent = explanationTotalPages;
      explanationPdfDoc = pdfDoc;

      renderPage(pageNum, pdfDoc, canvas, ctx, pageCountElement);
    });
  }

  document.getElementById('prev-explanation').addEventListener('click', onPrevPage);
  document.getElementById('next-explanation').addEventListener('click', onNextPage);

  loadPdf(explanationUrl, explanationCanvas, explanationCtx, document.getElementById('page_count-explanation'));
</script>
@endif

@endsection