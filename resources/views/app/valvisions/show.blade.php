@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('valvisions.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.valvisions.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.valvisions.inputs.value')</h5>
                    <span>{{ $valvision->value ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.valvisions.inputs.vision')</h5>
                    <span>{{ $valvision->vision ?? '-' }}</span>
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('valvisions.index') }}" class="btn btn-light">
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\Valvision::class)
                <a
                    href="{{ route('valvisions.create') }}"
                    class="btn btn-light"
                >
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection
