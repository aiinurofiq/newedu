@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('users.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.users.edit_title')
            </h4>

            <x-form
                method="PUT"
                action="{{ route('users.update', $user) }}"
                has-files
                class="mt-4"
            >
                @include('app.users.form-inputs')

                <div class="mt-4">
                    <a href="{{ route('users.index') }}" class="btn btn-light">
                        <i class="icon ion-md-return-left text-primary"></i>
                        @lang('crud.common.back')
                    </a>

                    <a href="{{ route('users.create') }}" class="btn btn-light">
                        <i class="icon ion-md-add text-primary"></i>
                        @lang('crud.common.create')
                    </a>

                    <button type="submit" class="btn btn-primary float-right">
                        <i class="icon ion-md-save"></i>
                        @lang('crud.common.update')
                    </button>
                </div>
            </x-form>
        </div>
    </div>

    @can('view-any', App\Models\Social::class)
    <div class="card mt-4">
        <div class="card-body">
            <h4 class="card-title w-100 mb-2">Media Sosial</h4>

            <livewire:user-socials-detail :user="$user" />
        </div>
    </div>
    @endcan @can('view-any', App\Models\Kid::class)
    <div class="card mt-4">
        <div class="card-body">
            <h4 class="card-title w-100 mb-2">Keluarga (Anak)</h4>

            <livewire:user-kids-detail :user="$user" />
        </div>
    </div>
    @endcan @can('view-any', App\Models\Wifhus::class)
    <div class="card mt-4">
        <div class="card-body">
            <h4 class="card-title w-100 mb-2">Keluarga (Suami/Istri)</h4>

            <livewire:user-wifhuses-detail :user="$user" />
        </div>
    </div>
    @endcan @can('view-any', App\Models\Speaker::class)
    <div class="card mt-4">
        <div class="card-body">
            <h4 class="card-title w-100 mb-2">Riwayat menjadi Narasumber</h4>

            <livewire:user-speakers-detail :user="$user" />
        </div>
    </div>
    @endcan @can('view-any', App\Models\Eduhistory::class)
    <div class="card mt-4">
        <div class="card-body">
            <h4 class="card-title w-100 mb-2">Riwayat Pendidikan</h4>

            <livewire:user-eduhistories-detail :user="$user" />
        </div>
    </div>
    @endcan @can('view-any', App\Models\Award::class)
    <div class="card mt-4">
        <div class="card-body">
            <h4 class="card-title w-100 mb-2">Riwayat Penghargaan</h4>

            <livewire:user-awards-detail :user="$user" />
        </div>
    </div>
    @endcan @can('view-any', App\Models\Organization::class)
    <div class="card mt-4">
        <div class="card-body">
            <h4 class="card-title w-100 mb-2">Riwayat Keorganisasian</h4>

            <livewire:user-organizations-detail :user="$user" />
        </div>
    </div>
    @endcan @can('view-any', App\Models\Position::class)
    <div class="card mt-4">
        <div class="card-body">
            <h4 class="card-title w-100 mb-2">Riwayat Jabatan</h4>

            <livewire:user-positions-detail :user="$user" />
        </div>
    </div>
    @endcan
</div>
@endsection
