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
                @can('create', App\Models\LTransaction::class)
                <a
                    href="{{ route('l-transactions.create') }}"
                    class="btn btn-primary"
                >
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div style="display: flex; justify-content: space-between;">
                <h4 class="card-title">
                    @lang('crud.l_transactions.index_title')
                </h4>
            </div>

            <div class="table-responsive">
                <table class="table table-borderless table-hover">
                    <thead>
                        <tr>
                            <th class="text-left">
                                @lang('crud.l_transactions.inputs.uuid')
                            </th>
                            <th class="text-left">
                                @lang('crud.l_transactions.inputs.user_id')
                            </th>
                            <th class="text-left">
                                @lang('crud.l_transactions.inputs.learning_id')
                            </th>
                            <th class="text-left">
                                @lang('crud.l_transactions.inputs.lpayment_id')
                            </th>
                            <th class="text-left">
                                @lang('crud.l_transactions.inputs.coupon_id')
                            </th>
                            <th class="text-right">
                                @lang('crud.l_transactions.inputs.totalamount')
                            </th>
                            <th class="text-right">
                                @lang('crud.l_transactions.inputs.status')
                            </th>
                            <th class="text-center">
                                @lang('crud.common.actions')
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($lTransactions as $lTransaction)
                        <tr>
                            <td>{{ $lTransaction->uuid ?? '-' }}</td>
                            <td>
                                {{ optional($lTransaction->user)->name ?? '-' }}
                            </td>
                            <td>
                                {{ optional($lTransaction->learning)->title ??
                                '-' }}
                            </td>
                            <td>
                                {{ optional($lTransaction->lpayment)->name ??
                                '-' }}
                            </td>
                            <td>
                                {{ optional($lTransaction->coupon)->code ?? '-'
                                }}
                            </td>
                            <td>{{ $lTransaction->totalamount ?? '-' }}</td>
                            <td>
                                {{ $lTransaction->status ?? '0' }}
                            </td>
                            <td class="text-center" style="width: 134px;">
                                <div
                                    role="group"
                                    aria-label="Row Actions"
                                    class="btn-group"
                                >
                                    @can('update', $lTransaction)
                                    <a
                                        href="{{ route('l-transactions.edit', $lTransaction) }}"
                                    >
                                        <button
                                            type="button"
                                            class="btn btn-light"
                                        >
                                            <i class="icon ion-md-create"></i>
                                        </button>
                                    </a>
                                    @endcan @can('view', $lTransaction)
                                    <a
                                        href="{{ route('l-transactions.show', $lTransaction) }}"
                                    >
                                        <button
                                            type="button"
                                            class="btn btn-light"
                                        >
                                            <i class="icon ion-md-eye"></i>
                                        </button>
                                    </a>
                                    @endcan @can('delete', $lTransaction)
                                    <form
                                        action="{{ route('l-transactions.destroy', $lTransaction) }}"
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
                            <td colspan="7">
                                @lang('crud.common.no_items_found')
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="7">
                                {!! $lTransactions->render() !!}
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
