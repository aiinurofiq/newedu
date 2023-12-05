@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('divisions.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.divisions.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.divisions.inputs.name')</h5>
                    <span>{{ $division->name ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.divisions.inputs.subdivisi')</h5>
                    <span>{{ $division->subdivisi ?? '-' }}</span>
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('divisions.index') }}" class="btn btn-light">
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\Division::class)
                <a href="{{ route('divisions.create') }}" class="btn btn-light">
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection
