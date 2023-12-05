@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('lpayments.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.lpayments.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.lpayments.inputs.name')</h5>
                    <span>{{ $lpayment->name ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.lpayments.inputs.accnumber')</h5>
                    <span>{{ $lpayment->accnumber ?? '-' }}</span>
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('lpayments.index') }}" class="btn btn-light">
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\Lpayment::class)
                <a href="{{ route('lpayments.create') }}" class="btn btn-light">
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection
