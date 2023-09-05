<div>
    <div class="mb-4">
        @can('create', App\Models\Wifhus::class)
        <button class="btn btn-primary" wire:click="newWifhus">
            <i class="icon ion-md-add"></i>
            @lang('crud.common.new')
        </button>
        @endcan @can('delete-any', App\Models\Wifhus::class)
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

    <x-modal id="user-wifhuses-modal" wire:model="showingModal">
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
                            name="wifhus.name"
                            label="Name"
                            wire:model="wifhus.name"
                            maxlength="255"
                            placeholder="Name"
                        ></x-inputs.text>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.select
                            name="wifhus.city_id"
                            label="City"
                            wire:model="wifhus.city_id"
                        >
                            <option value="null" disabled>Please select the City</option>
                            @foreach($citiesForSelect as $value => $label)
                            <option value="{{ $value }}"  >{{ $label }}</option>
                            @endforeach
                        </x-inputs.select>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.date
                            name="wifhusBirth"
                            label="Birth"
                            wire:model="wifhusBirth"
                            max="255"
                        ></x-inputs.date>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.select
                            name="wifhus.gender_id"
                            label="Gender"
                            wire:model="wifhus.gender_id"
                        >
                            <option value="null" disabled>Please select the Gender</option>
                            @foreach($gendersForSelect as $value => $label)
                            <option value="{{ $value }}"  >{{ $label }}</option>
                            @endforeach
                        </x-inputs.select>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.select
                            name="wifhus.as"
                            label="As"
                            wire:model="wifhus.as"
                        >
                            <option value="1" {{ $selected == '1' ? 'selected' : '' }} >1</option>
                            <option value="2" {{ $selected == '2' ? 'selected' : '' }} >2</option>
                        </x-inputs.select>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.text
                            name="wifhus.job"
                            label="Job"
                            wire:model="wifhus.job"
                            maxlength="255"
                            placeholder="Job"
                        ></x-inputs.text>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.textarea
                            name="wifhus.description"
                            label="Description"
                            wire:model="wifhus.description"
                            maxlength="255"
                        ></x-inputs.textarea>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.date
                            name="wifhusMaritaldate"
                            label="Maritaldate"
                            wire:model="wifhusMaritaldate"
                            max="255"
                        ></x-inputs.date>
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
                        @lang('crud.user_wifhuses.inputs.name')
                    </th>
                    <th class="text-left">
                        @lang('crud.user_wifhuses.inputs.city_id')
                    </th>
                    <th class="text-left">
                        @lang('crud.user_wifhuses.inputs.birth')
                    </th>
                    <th class="text-left">
                        @lang('crud.user_wifhuses.inputs.gender_id')
                    </th>
                    <th class="text-left">
                        @lang('crud.user_wifhuses.inputs.as')
                    </th>
                    <th class="text-left">
                        @lang('crud.user_wifhuses.inputs.job')
                    </th>
                    <th class="text-left">
                        @lang('crud.user_wifhuses.inputs.description')
                    </th>
                    <th class="text-left">
                        @lang('crud.user_wifhuses.inputs.maritaldate')
                    </th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="text-gray-600">
                @foreach ($wifhuses as $wifhus)
                <tr class="hover:bg-gray-100">
                    <td class="text-left">
                        <input
                            type="checkbox"
                            value="{{ $wifhus->id }}"
                            wire:model="selected"
                        />
                    </td>
                    <td class="text-left">{{ $wifhus->name ?? '-' }}</td>
                    <td class="text-left">
                        {{ optional($wifhus->city)->name ?? '-' }}
                    </td>
                    <td class="text-left">{{ $wifhus->birth ?? '-' }}</td>
                    <td class="text-left">
                        {{ optional($wifhus->gender)->name ?? '-' }}
                    </td>
                    <td class="text-left">{{ $wifhus->as ?? '-' }}</td>
                    <td class="text-left">{{ $wifhus->job ?? '-' }}</td>
                    <td class="text-left">{{ $wifhus->description ?? '-' }}</td>
                    <td class="text-left">{{ $wifhus->maritaldate ?? '-' }}</td>
                    <td class="text-right" style="width: 134px;">
                        <div
                            role="group"
                            aria-label="Row Actions"
                            class="relative inline-flex align-middle"
                        >
                            @can('update', $wifhus)
                            <button
                                type="button"
                                class="btn btn-light"
                                wire:click="editWifhus({{ $wifhus->id }})"
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
                    <td colspan="9">{{ $wifhuses->render() }}</td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
