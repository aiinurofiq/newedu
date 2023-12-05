<div>
    <div class="mb-4">
        @can('create', App\Models\Position::class)
        <button class="btn btn-primary" wire:click="newPosition">
            <i class="icon ion-md-add"></i>
            @lang('crud.common.new')
        </button>
        @endcan @can('delete-any', App\Models\Position::class)
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

    <x-modal id="user-positions-modal" wire:model="showingModal">
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
                            name="position.name"
                            label="Name"
                            wire:model="position.name"
                            maxlength="255"
                            placeholder="Name"
                        ></x-inputs.text>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.date
                            name="positionStart"
                            label="Start"
                            wire:model="positionStart"
                            max="255"
                        ></x-inputs.date>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.date
                            name="positionEnd"
                            label="End"
                            wire:model="positionEnd"
                            max="255"
                        ></x-inputs.date>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.select
                            name="position.fieldofposition_id"
                            label="Fieldofposition"
                            wire:model="position.fieldofposition_id"
                        >
                            <option value="null" disabled>Please select the Fieldofposition</option>
                            @foreach($fieldofpositionsForSelect as $value => $label)
                            <option value="{{ $value }}"  >{{ $label }}</option>
                            @endforeach
                        </x-inputs.select>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.select
                            name="position.division_id"
                            label="Division"
                            wire:model="position.division_id"
                        >
                            <option value="null" disabled>Please select the Division</option>
                            @foreach($divisionsForSelect as $value => $label)
                            <option value="{{ $value }}"  >{{ $label }}</option>
                            @endforeach
                        </x-inputs.select>
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
                        @lang('crud.user_positions.inputs.name')
                    </th>
                    <th class="text-left">
                        @lang('crud.user_positions.inputs.start')
                    </th>
                    <th class="text-left">
                        @lang('crud.user_positions.inputs.end')
                    </th>
                    <th class="text-left">
                        @lang('crud.user_positions.inputs.fieldofposition_id')
                    </th>
                    <th class="text-left">
                        @lang('crud.user_positions.inputs.division_id')
                    </th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="text-gray-600">
                @foreach ($positions as $position)
                <tr class="hover:bg-gray-100">
                    <td class="text-left">
                        <input
                            type="checkbox"
                            value="{{ $position->id }}"
                            wire:model="selected"
                        />
                    </td>
                    <td class="text-left">{{ $position->name ?? '-' }}</td>
                    <td class="text-left">{{ $position->start ?? '-' }}</td>
                    <td class="text-left">{{ $position->end ?? '-' }}</td>
                    <td class="text-left">
                        {{ optional($position->fieldofposition)->name ?? '-' }}
                    </td>
                    <td class="text-left">
                        {{ optional($position->division)->name ?? '-' }}
                    </td>
                    <td class="text-right" style="width: 134px;">
                        <div
                            role="group"
                            aria-label="Row Actions"
                            class="relative inline-flex align-middle"
                        >
                            @can('update', $position)
                            <button
                                type="button"
                                class="btn btn-light"
                                wire:click="editPosition({{ $position->id }})"
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
                    <td colspan="6">{{ $positions->render() }}</td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
