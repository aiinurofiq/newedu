@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('l-transactions.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.l_transactions.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.l_transactions.inputs.uuid')</h5>
                    <span>{{ $lTransaction->uuid ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.l_transactions.inputs.user_id')</h5>
                    <span
                        >{{ optional($lTransaction->user)->name ?? '-' }}</span
                    >
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.l_transactions.inputs.learning_id')</h5>
                    <span
                        >{{ optional($lTransaction->learning)->title ?? '-'
                        }}</span
                    >
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.l_transactions.inputs.lpayment_id')</h5>
                    <span
                        >{{ optional($lTransaction->lpayment)->name ?? '-'
                        }}</span
                    >
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.l_transactions.inputs.coupon_id')</h5>
                    <span
                        >{{ optional($lTransaction->coupon)->code ?? '-'
                        }}</span
                    >
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.l_transactions.inputs.totalamount')</h5>
                    <span>{{ $lTransaction->totalamount ?? '-' }}</span>
                </div>
            </div>

            <div class="mt-4">
                <a
                    href="{{ route('l-transactions.index') }}"
                    class="btn btn-light"
                >
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\LTransaction::class)
                <a
                    href="{{ route('l-transactions.create') }}"
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
