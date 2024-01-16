@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('categorylearns.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.categorylearns.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.categorylearns.inputs.name')</h5>
                    <span>{{ $categorylearn->name ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.categorylearns.inputs.image')</h5>
                    <x-partials.thumbnail
                        src="{{ $categorylearn->image ? asset(\Storage::url($categorylearn->image)) : '' }}"
                        size="150"
                    />
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.categorylearns.inputs.description')</h5>
                    <span>{{ $categorylearn->description ?? '-' }}</span>
                </div>
            </div>

            <div class="mt-4">
                <a
                    href="{{ route('categorylearns.index') }}"
                    class="btn btn-light"
                >
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\Categorylearn::class)
                <a
                    href="{{ route('categorylearns.create') }}"
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
