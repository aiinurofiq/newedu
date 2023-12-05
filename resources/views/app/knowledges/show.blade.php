@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('knowledges.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.knowledges.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.knowledges.inputs.title')</h5>
                    <span>{{ $knowledge->title ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.knowledges.inputs.writer')</h5>
                    <span>{{ $knowledge->writer ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.knowledges.inputs.abstract')</h5>
                    <span>{{ $knowledge->abstract ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.knowledges.inputs.status')</h5>
                    <span>{{ $knowledge->status ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.knowledges.inputs.photo')</h5>
                    <x-partials.thumbnail
                        src="{{ $knowledge->photo ? asset(\Storage::url($knowledge->photo)) : '' }}"
                        size="150"
                    />
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.knowledges.inputs.user_id')</h5>
                    <span>{{ optional($knowledge->user)->name ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.knowledges.inputs.topic_id')</h5>
                    <span>{{ optional($knowledge->topic)->name ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.knowledges.inputs.category_id')</h5>
                    <span
                        >{{ optional($knowledge->category)->name ?? '-' }}</span
                    >
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('knowledges.index') }}" class="btn btn-light">
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\Knowledge::class)
                <a
                    href="{{ route('knowledges.create') }}"
                    class="btn btn-light"
                >
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>

    @can('view-any', App\Models\Report::class)
    <div class="card mt-4">
        <div class="card-body">
            <h4 class="card-title w-100 mb-2">Reports</h4>

            <livewire:knowledge-reports-detail :knowledge="$knowledge" />
        </div>
    </div>
    @endcan @can('view-any', App\Models\Explanation::class)
    <div class="card mt-4">
        <div class="card-body">
            <h4 class="card-title w-100 mb-2">Explanations</h4>

            <livewire:knowledge-explanations-detail :knowledge="$knowledge" />
        </div>
    </div>
    @endcan @can('view-any', App\Models\Jurnal::class)
    <div class="card mt-4">
        <div class="card-body">
            <h4 class="card-title w-100 mb-2">Jurnals</h4>

            <livewire:knowledge-jurnals-detail :knowledge="$knowledge" />
        </div>
    </div>
    @endcan @can('view-any', App\Models\Exsum::class)
    <div class="card mt-4">
        <div class="card-body">
            <h4 class="card-title w-100 mb-2">Exsums</h4>

            <livewire:knowledge-exsums-detail :knowledge="$knowledge" />
        </div>
    </div>
    @endcan
</div>
@endsection
