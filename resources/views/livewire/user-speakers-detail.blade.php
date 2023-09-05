<div>
    <div class="mb-4">
        @can('create', App\Models\Speaker::class)
        <button class="btn btn-primary" wire:click="newSpeaker">
            <i class="icon ion-md-add"></i>
            @lang('crud.common.new')
        </button>
        @endcan @can('delete-any', App\Models\Speaker::class)
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

    <x-modal id="user-speakers-modal" wire:model="showingModal">
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
                            name="speaker.name"
                            label="Name"
                            wire:model="speaker.name"
                            maxlength="255"
                            placeholder="Name"
                        ></x-inputs.text>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.text
                            name="speaker.organizer"
                            label="Organizer"
                            wire:model="speaker.organizer"
                            maxlength="255"
                            placeholder="Organizer"
                        ></x-inputs.text>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.number
                            name="speaker.year"
                            label="Year"
                            wire:model="speaker.year"
                            max="255"
                            placeholder="Year"
                        ></x-inputs.number>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.text
                            name="speaker.address"
                            label="Address"
                            wire:model="speaker.address"
                            maxlength="255"
                            placeholder="Address"
                        ></x-inputs.text>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.textarea
                            name="speaker.description"
                            label="Description"
                            wire:model="speaker.description"
                            maxlength="255"
                        ></x-inputs.textarea>
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
                        @lang('crud.user_speakers.inputs.name')
                    </th>
                    <th class="text-left">
                        @lang('crud.user_speakers.inputs.organizer')
                    </th>
                    <th class="text-right">
                        @lang('crud.user_speakers.inputs.year')
                    </th>
                    <th class="text-left">
                        @lang('crud.user_speakers.inputs.address')
                    </th>
                    <th class="text-left">
                        @lang('crud.user_speakers.inputs.description')
                    </th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="text-gray-600">
                @foreach ($speakers as $speaker)
                <tr class="hover:bg-gray-100">
                    <td class="text-left">
                        <input
                            type="checkbox"
                            value="{{ $speaker->id }}"
                            wire:model="selected"
                        />
                    </td>
                    <td class="text-left">{{ $speaker->name ?? '-' }}</td>
                    <td class="text-left">{{ $speaker->organizer ?? '-' }}</td>
                    <td class="text-right">{{ $speaker->year ?? '-' }}</td>
                    <td class="text-left">{{ $speaker->address ?? '-' }}</td>
                    <td class="text-left">
                        {{ $speaker->description ?? '-' }}
                    </td>
                    <td class="text-right" style="width: 134px;">
                        <div
                            role="group"
                            aria-label="Row Actions"
                            class="relative inline-flex align-middle"
                        >
                            @can('update', $speaker)
                            <button
                                type="button"
                                class="btn btn-light"
                                wire:click="editSpeaker({{ $speaker->id }})"
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
                    <td colspan="6">{{ $speakers->render() }}</td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
