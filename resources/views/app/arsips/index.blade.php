@extends('layouts.app')

@section('content')
<div class="container">
    <div class="searchbar mt-0 mb-4">
        <div class="row">
            <div class="col-md-6">
                <form>
                    <div class="input-group">
                        <input
                            id="indexSearch"
                            type="text"
                            name="search"
                            placeholder="{{ __('crud.common.search') }}"
                            value="{{ $search ?? '' }}"
                            class="form-control"
                            autocomplete="off"
                        />
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-primary">
                                <i class="icon ion-md-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-6 text-right">
                @can('create', App\Models\Arsip::class)
                <a href="{{ route('arsips.create') }}" class="btn btn-primary">
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div style="display: flex; justify-content: space-between;">
                <h4 class="card-title">@lang('crud.arsips.index_title')</h4>
            </div>

            <div class="table-responsive">
                <table class="table table-borderless table-hover">
                    <thead>
                        <tr>
                            <th class="text-left">
                                @lang('crud.arsips.inputs.name')
                            </th>
                            <th class="text-left">
                                @lang('crud.arsips.inputs.file')
                            </th>
                            <th class="text-left">
                                @lang('crud.arsips.inputs.kodeklasifikasi')
                            </th>
                            <th class="text-left">
                                @lang('crud.arsips.inputs.jwp_aktif')
                            </th>
                            <th class="text-left">
                                @lang('crud.arsips.inputs.jwp_inaktif')
                            </th>
                            <th class="text-left">
                                @lang('crud.arsips.inputs.ha_internal')
                            </th>
                            <th class="text-left">
                                @lang('crud.arsips.inputs.ha_eksternal')
                            </th>
                            <th class="text-left">
                                @lang('crud.arsips.inputs.keterangan_id')
                            </th>
                            <th class="text-left">
                                @lang('crud.arsips.inputs.jenisarsip_id')
                            </th>
                            <th class="text-left">
                                @lang('crud.arsips.inputs.kkeamanan_id')
                            </th>
                            <th class="text-left">
                                @lang('crud.arsips.inputs.dasarpertimbangan_id')
                            </th>
                            <th class="text-left">
                                @lang('crud.arsips.inputs.user_id')
                            </th>
                            <th class="text-center">
                                @lang('crud.common.actions')
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($arsips as $arsip)
                        <tr>
                            <td>{{ $arsip->name ?? '-' }}</td>
                            <td>
                                @if($arsip->file)
                                <a
                                    href="{{ asset(\Storage::url($arsip->file)) }}"
                                    target="blank"
                                    ><i class="icon ion-md-download"></i
                                    >&nbsp;Download</a
                                >
                                @else - @endif
                            </td>
                            <td>{{ $arsip->kodeklasifikasi ?? '-' }}</td>
                            <td>{{ $arsip->jwp_aktif ?? '-' }}</td>
                            <td>{{ $arsip->jwp_inaktif ?? '-' }}</td>
                            <td>{{ $arsip->ha_internal ?? '-' }}</td>
                            <td>{{ $arsip->ha_eksternal ?? '-' }}</td>
                            <td>
                                {{ optional($arsip->keterangan)->name ?? '-' }}
                            </td>
                            <td>
                                @if(!empty($arsip->jenisarsip->jenis))
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
                                @endif
                            </td>
                            <td>
                                {{ optional($arsip->kkeamanan)->name ?? '-' }}
                            </td>
                            <td>
                                {{ optional($arsip->dasarpertimbangan)->name ??
                                '-' }}
                            </td>
                            <td>{{ optional($arsip->user)->name ?? '-' }}</td>
                            <td class="text-center" style="width: 134px;">
                                <div
                                    role="group"
                                    aria-label="Row Actions"
                                    class="btn-group"
                                >
                                    @can('update', $arsip)
                                    <a
                                        href="{{ route('arsips.edit', $arsip) }}"
                                    >
                                        <button
                                            type="button"
                                            class="btn btn-light"
                                        >
                                            <i class="icon ion-md-create"></i>
                                        </button>
                                    </a>
                                    @endcan @can('view', $arsip)
                                    <a
                                        href="{{ route('arsips.show', $arsip) }}"
                                    >
                                        <button
                                            type="button"
                                            class="btn btn-light"
                                        >
                                            <i class="icon ion-md-eye"></i>
                                        </button>
                                    </a>
                                    @endcan @can('delete', $arsip)
                                    <form
                                        action="{{ route('arsips.destroy', $arsip) }}"
                                        method="POST"
                                        onsubmit="return confirm('{{ __('crud.common.are_you_sure') }}')"
                                    >
                                        @csrf @method('DELETE')
                                        <button
                                            type="submit"
                                            class="btn btn-light text-danger"
                                        >
                                            <i class="icon ion-md-trash"></i>
                                        </button>
                                    </form>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="13">
                                @lang('crud.common.no_items_found')
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="13">{!! $arsips->render() !!}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
