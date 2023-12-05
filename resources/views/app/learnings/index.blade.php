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
                @can('create', App\Models\Learning::class)
                <a
                    href="{{ route('learnings.create') }}"
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
                <h4 class="card-title">@lang('crud.learnings.index_title')</h4>
            </div>

            <div class="table-responsive">
                <table class="table table-borderless table-hover">
                    <thead>
                        <tr>
                            <th class="text-left">
                                @lang('crud.learnings.inputs.title')
                            </th>
                            <th class="text-left">
                                @lang('crud.learnings.inputs.image')
                            </th>
                            <th class="text-left">
                                @lang('crud.learnings.inputs.description')
                            </th>
                            <th class="text-left">
                                @lang('crud.learnings.inputs.type')
                            </th>
                            <th class="text-right">
                                @lang('crud.learnings.inputs.price')
                            </th>
                            <th class="text-left">
                                @lang('crud.learnings.inputs.user_id')
                            </th>
                            <th class="text-left">
                                @lang('crud.learnings.inputs.categorylearn_id')
                            </th>
                            <th class="text-left">
                                @lang('crud.learnings.inputs.level')
                            </th>
                            <th class="text-left">
                                @lang('crud.learnings.inputs.ispublic')
                            </th>
                            <th class="text-center">
                                @lang('crud.common.actions')
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($learnings as $learning)
                        <tr>
                            <td>{{ $learning->title ?? '-' }}</td>
                            <td>
                                <x-partials.thumbnail
                                    src="{{ $learning->image ? asset(\Storage::url($learning->image)) : '' }}"
                                />
                            </td>
                            <td>{{ $learning->description ?? '-' }}</td>
                            <td>{{ $learning->type ?? '-' }}</td>
                            <td>{{ $learning->price ?? '-' }}</td>
                            <td>
                                {{ optional($learning->user)->name ?? '-' }}
                            </td>
                            <td>
                                {{ optional($learning->categorylearn)->name ??
                                '-' }}
                            </td>
                            <td>{{ $learning->level ?? '-' }}</td>
                            <td>{{ $learning->ispublic ?? '-' }}</td>
                            <td class="text-center" style="width: 134px;">
                                <div
                                    role="group"
                                    aria-label="Row Actions"
                                    class="btn-group"
                                >
                                    @can('update', $learning)
                                    <a
                                        href="{{ route('learnings.edit', $learning) }}"
                                    >
                                        <button
                                            type="button"
                                            class="btn btn-light"
                                        >
                                            <i class="icon ion-md-create"></i>
                                        </button>
                                    </a>
                                    @endcan @can('view', $learning)
                                    <a
                                        href="{{ route('learnings.show', $learning) }}"
                                    >
                                        <button
                                            type="button"
                                            class="btn btn-light"
                                        >
                                            <i class="icon ion-md-eye"></i>
                                        </button>
                                    </a>
                                    @endcan @can('delete', $learning)
                                    <form
                                        action="{{ route('learnings.destroy', $learning) }}"
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
                            <td colspan="10">
                                @lang('crud.common.no_items_found')
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="10">{!! $learnings->render() !!}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
