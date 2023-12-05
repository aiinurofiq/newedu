@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('knowledges.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.knowledges.edit_title')
            </h4>

            <x-form
                method="PUT"
                action="{{ route('knowledges.update', $knowledge) }}"
                has-files
                class="mt-4"
            >
                @include('app.knowledges.form-inputs')

                <div class="mt-4">
                    <a
                        href="{{ route('knowledges.index') }}"
                        class="btn btn-light"
                    >
                        <i class="icon ion-md-return-left text-primary"></i>
                        @lang('crud.common.back')
                    </a>

                    <a
                        href="{{ route('knowledges.create') }}"
                        class="btn btn-light"
                    >
                        <i class="icon ion-md-add text-primary"></i>
                        @lang('crud.common.create')
                    </a>

                    <button type="submit" class="btn btn-primary float-right">
                        <i class="icon ion-md-save"></i>
                        @lang('crud.common.update')
                    </button>
                </div>
            </x-form>
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
