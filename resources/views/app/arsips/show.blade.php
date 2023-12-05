@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('arsips.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.arsips.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.arsips.inputs.name')</h5>
                    <span>{{ $arsip->name ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.arsips.inputs.file')</h5>
                    @if($arsip->file)
                    <a href="{{ asset(\Storage::url($arsip->file)) }}" target="blank"
                        ><i class="icon ion-md-download"></i>&nbsp;Download</a
                    >
                    @else - @endif
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.arsips.inputs.kodeklasifikasi')</h5>
                    <span>{{ $arsip->kodeklasifikasi ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.arsips.inputs.jwp_aktif')</h5>
                    <span>{{ $arsip->jwp_aktif ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.arsips.inputs.jwp_inaktif')</h5>
                    <span>{{ $arsip->jwp_inaktif ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.arsips.inputs.ha_internal')</h5>
                    <span>{{ $arsip->ha_internal ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.arsips.inputs.ha_eksternal')</h5>
                    <span>{{ $arsip->ha_eksternal ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.arsips.inputs.keterangan_id')</h5>
                    <span>{{ optional($arsip->keterangan)->name ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.arsips.inputs.jenisarsip_id')</h5>
                    <span
                        >@if(!empty($arsip->jenisarsip->jenis))
                        {{ $arsip->jenisarsip->jenis }}
                        @else
                        @endif
                        @if(!empty($arsip->jenisarsip->subjenis))
                        -
                        {{ $arsip->jenisarsip->subjenis }}
                        @else
                        @endif
                        @if(!empty($arsip->jenisarsip->subsubjenis))
                        -
                        {{ $arsip->jenisarsip->subsubjenis }}
                        @else
                        @endif</span
                    >
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.arsips.inputs.kkeamanan_id')</h5>
                    <span>{{ optional($arsip->kkeamanan)->name ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.arsips.inputs.dasarpertimbangan_id')</h5>
                    <span
                        >{{ optional($arsip->dasarpertimbangan)->name ?? '-'
                        }}</span
                    >
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.arsips.inputs.user_id')</h5>
                    <span>{{ optional($arsip->user)->name ?? '-' }}</span>
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('arsips.index') }}" class="btn btn-light">
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\Arsip::class)
                <a href="{{ route('arsips.create') }}" class="btn btn-light">
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection
