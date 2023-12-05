<div>
    <div class="mb-4">
        @can('create', App\Models\Module::class)
        <button class="btn btn-primary" wire:click="newModule">
            <i class="icon ion-md-add"></i>
            @lang('crud.common.new')
        </button>
        @endcan @can('delete-any', App\Models\Module::class)
        <button
            class="btn btn-danger"
             {{ empty($selected) ? 'disabled' : '' }} 
            onclick="confirm('Are you sure?') || event.stopImmediatePropagation()"
            wire:click="destroySelected"
        >
            <i class="icon ion-md-trash"></i>
            @lang('crud.common.delete_selected')
        </button>
        @endcan
    </div>

    <x-modal id="section-modules-modal" wire:model="showingModal">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ $modalTitle }}</h5>
                <button
                    type="button"
                    class="close"
                    data-dismiss="modal"
                    aria-label="Close"
                >
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div>
                    <x-inputs.group class="col-sm-12">
                        <x-inputs.text
                            name="module.title"
                            label="Title"
                            wire:model="module.title"
                            maxlength="255"
                            placeholder="Title"
                        ></x-inputs.text>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.partials.label
                            name="moduleFile"
                            label="File"
                        ></x-inputs.partials.label
                        ><br />

                        <input
                            type="file"
                            name="moduleFile"
                            id="moduleFile{{ $uploadIteration }}"
                            wire:model="moduleFile"
                            class="form-control-file"
                        />

                        @if($editing && $module->file)
                        <div class="mt-2">
                            <a
                                href="{{ asset(\Storage::url($module->file)) }}"
                                target="_blank"
                                ><i class="icon ion-md-download"></i
                                >&nbsp;Download</a
                            >
                        </div>
                        @endif @error('moduleFile')
                        @include('components.inputs.partials.error') @enderror
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.text
                            name="module.videoembed"
                            label="Videoembed"
                            wire:model="module.videoembed"
                            maxlength="255"
                            placeholder="Videoembed"
                        ></x-inputs.text>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.textarea
                            name="module.text"
                            label="Text"
                            wire:model="module.text"
                            maxlength="255"
                        ></x-inputs.textarea>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.textarea
                            name="module.description"
                            label="Description"
                            wire:model="module.description"
                            maxlength="255"
                        ></x-inputs.textarea>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.number
                            name="module.duration"
                            label="Duration"
                            wire:model="module.duration"
                            max="255"
                            placeholder="Duration"
                        ></x-inputs.number>
                    </x-inputs.group>
                </div>
            </div>

            @if($editing) @endif

            <div class="modal-footer">
                <button
                    type="button"
                    class="btn btn-light float-left"
                    wire:click="$toggle('showingModal')"
                >
                    <i class="icon ion-md-close"></i>
                    @lang('crud.common.cancel')
                </button>

                <button type="button" class="btn btn-primary" wire:click="save">
                    <i class="icon ion-md-save"></i>
                    @lang('crud.common.save')
                </button>
            </div>
        </div>
    </x-modal>

    <div class="table-responsive">
        <table class="table table-borderless table-hover">
            <thead>
                <tr>
                    <th>
                        <input
                            type="checkbox"
                            wire:model="allSelected"
                            wire:click="toggleFullSelection"
                            title="{{ trans('crud.common.select_all') }}"
                        />
                    </th>
                    <th class="text-left">
                        @lang('crud.section_modules.inputs.title')
                    </th>
                    <th class="text-left">
                        @lang('crud.section_modules.inputs.file')
                    </th>
                    <th class="text-left">
                        @lang('crud.section_modules.inputs.videoembed')
                    </th>
                    <th class="text-left">
                        @lang('crud.section_modules.inputs.text')
                    </th>
                    <th class="text-left">
                        @lang('crud.section_modules.inputs.description')
                    </th>
                    <th class="text-right">
                        @lang('crud.section_modules.inputs.duration')
                    </th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="text-gray-600">
                @foreach ($modules as $module)
                <tr class="hover:bg-gray-100">
                    <td class="text-left">
                        <input
                            type="checkbox"
                            value="{{ $module->id }}"
                            wire:model="selected"
                        />
                    </td>
                    <td class="text-left">{{ $module->title ?? '-' }}</td>
                    <td class="text-left">
                        @if($module->file)
                        <a
                            href="{{ asset(\Storage::url($module->file)) }}"
                            target="blank"
                            ><i class="icon ion-md-download"></i
                            >&nbsp;Download</a
                        >
                        @else - @endif
                    </td>
                    <td class="text-left">{{ $module->videoembed ?? '-' }}</td>
                    <td class="text-left">{{ $module->text ?? '-' }}</td>
                    <td class="text-left">{{ $module->description ?? '-' }}</td>
                    <td class="text-right">{{ $module->duration ?? '-' }}</td>
                    <td class="text-right" style="width: 134px;">
                        <div
                            role="group"
                            aria-label="Row Actions"
                            class="relative inline-flex align-middle"
                        >
                            @can('update', $module)
                            <button
                                type="button"
                                class="btn btn-light"
                                wire:click="editModule({{ $module->id }})"
                            >
                                <i class="icon ion-md-create"></i>
                            </button>
                            @endcan
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="7">{{ $modules->render() }}</td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
