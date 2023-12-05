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
                @can('create', App\Models\Knowledge::class)
                <a
                    href="{{ route('knowledges.create') }}"
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
                <h4 class="card-title">@lang('crud.knowledges.index_title')</h4>
            </div>

            <div class="table-responsive">
                <table class="table table-borderless table-hover">
                    <thead>
                        <tr>
                            <th class="text-left">
                                @lang('crud.knowledges.inputs.title')
                            </th>
                            <th class="text-left">
                                @lang('crud.knowledges.inputs.writer')
                            </th>
                            <th class="text-left">
                                @lang('crud.knowledges.inputs.abstract')
                            </th>
                            <th class="text-left">
                                @lang('crud.knowledges.inputs.status')
                            </th>
                            <th class="text-left">
                                @lang('crud.knowledges.inputs.photo')
                            </th>
                            <th class="text-left">
                                @lang('crud.knowledges.inputs.user_id')
                            </th>
                            <th class="text-left">
                                @lang('crud.knowledges.inputs.topic_id')
                            </th>
                            <th class="text-left">
                                @lang('crud.knowledges.inputs.category_id')
                            </th>
                            <th class="text-center">
                                @lang('crud.common.actions')
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($knowledges as $knowledge)
                        <tr>
                            <td>{{ $knowledge->title ?? '-' }}</td>
                            <td>{{ $knowledge->writer ?? '-' }}</td>
                            <td>{{ $knowledge->abstract ?? '-' }}</td>
                            <td>{{ $knowledge->status ?? '-' }}</td>
                            <td>
                                <x-partials.thumbnail
                                    src="{{ $knowledge->photo ? asset(\Storage::url($knowledge->photo)) : '' }}"
                                />
                            </td>
                            <td>
                                {{ optional($knowledge->user)->name ?? '-' }}
                            </td>
                            <td>
                                {{ optional($knowledge->topic)->name ?? '-' }}
                            </td>
                            <td>
                                {{ optional($knowledge->category)->name ?? '-'
                                }}
                            </td>
                            <td class="text-center" style="width: 134px;">
                                <div
                                    role="group"
                                    aria-label="Row Actions"
                                    class="btn-group"
                                >
                                    @can('update', $knowledge)
                                    <a
                                        href="{{ route('knowledges.edit', $knowledge) }}"
                                    >
                                        <button
                                            type="button"
                                            class="btn btn-light"
                                        >
                                            <i class="icon ion-md-create"></i>
                                        </button>
                                    </a>
                                    @endcan @can('view', $knowledge)
                                    <a
                                        href="{{ route('knowledges.show', $knowledge) }}"
                                    >
                                        <button
                                            type="button"
                                            class="btn btn-light"
                                        >
                                            <i class="icon ion-md-eye"></i>
                                        </button>
                                    </a>
                                    @endcan @can('delete', $knowledge)
                                    <form
                                        action="{{ route('knowledges.destroy', $knowledge) }}"
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
                            <td colspan="9">
                                @lang('crud.common.no_items_found')
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="9">{!! $knowledges->render() !!}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
