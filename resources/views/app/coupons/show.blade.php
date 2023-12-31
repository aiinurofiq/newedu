@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('coupons.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.coupons.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.coupons.inputs.code')</h5>
                    <span>{{ $coupon->code ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.coupons.inputs.cutprice')</h5>
                    <span>{{ $coupon->cutprice ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.coupons.inputs.typecut')</h5>
                    <span>{{ $coupon->typecut ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.coupons.inputs.maxcut')</h5>
                    <span>{{ $coupon->maxcut ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.coupons.inputs.maxusage')</h5>
                    <span>{{ $coupon->maxusage ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.coupons.inputs.expireddate')</h5>
                    <span>{{ $coupon->expireddate ?? '-' }}</span>
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('coupons.index') }}" class="btn btn-light">
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\Coupon::class)
                <a href="{{ route('coupons.create') }}" class="btn btn-light">
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection
