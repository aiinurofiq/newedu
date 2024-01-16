@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('learnings.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.learnings.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.learnings.inputs.title')</h5>
                    <span>{{ $learning->title ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.learnings.inputs.image')</h5>
                    <x-partials.thumbnail
                        src="{{ $learning->image ? asset(\Storage::url($learning->image)) : '' }}"
                        size="150"
                    />
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.learnings.inputs.description')</h5>
                    <span>{{ $learning->description ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.learnings.inputs.type')</h5>
                    <span>{{ $learning->type ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.learnings.inputs.price')</h5>
                    <span>{{ $learning->price ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.learnings.inputs.user_id')</h5>
                    <span>{{ optional($learning->user)->name ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.learnings.inputs.categorylearn_id')</h5>
                    <span
                        >{{ optional($learning->categorylearn)->name ?? '-'
                        }}</span
                    >
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.learnings.inputs.level')</h5>
                    <span>{{ $learning->level ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.learnings.inputs.ispublic')</h5>
                    <span>{{ $learning->ispublic ?? '-' }}</span>
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('learnings.index') }}" class="btn btn-light">
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\Learning::class)
                <a href="{{ route('learnings.create') }}" class="btn btn-light">
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection
