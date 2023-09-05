<div>
    <div class="mb-4">
        @can('create', App\Models\Kid::class)
        <button class="btn btn-primary" wire:click="newKid">
            <i class="icon ion-md-add"></i>
            @lang('crud.common.new')
        </button>
        @endcan @can('delete-any', App\Models\Kid::class)
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

    <x-modal id="user-kids-modal" wire:model="showingModal">
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
                            name="kid.name"
                            label="Name"
                            wire:model="kid.name"
                            maxlength="255"
                            placeholder="Name"
                        ></x-inputs.text>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.select
                            name="kid.city_id"
                            label="City"
                            wire:model="kid.city_id"
                        >
                            <option value="null" disabled>Please select the City</option>
                            @foreach($citiesForSelect as $value => $label)
                            <option value="{{ $value }}"  >{{ $label }}</option>
                            @endforeach
                        </x-inputs.select>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.date
                            name="kidBirth"
                            label="Birth"
                            wire:model="kidBirth"
                            max="255"
                        ></x-inputs.date>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.select
                            name="kid.gender_id"
                            label="Gender"
                            wire:model="kid.gender_id"
                        >
                            <option value="null" disabled>Please select the Gender</option>
                            @foreach($gendersForSelect as $value => $label)
                            <option value="{{ $value }}"  >{{ $label }}</option>
                            @endforeach
                        </x-inputs.select>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.text
                            name="kid.job"
                            label="Job"
                            wire:model="kid.job"
                            maxlength="255"
                            placeholder="Job"
                        ></x-inputs.text>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.textarea
                            name="kid.description"
                            label="Description"
                            wire:model="kid.description"
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
                        @lang('crud.user_kids.inputs.name')
                    </th>
                    <th class="text-left">
                        @lang('crud.user_kids.inputs.city_id')
                    </th>
                    <th class="text-left">
                        @lang('crud.user_kids.inputs.birth')
                    </th>
                    <th class="text-left">
                        @lang('crud.user_kids.inputs.gender_id')
                    </th>
                    <th class="text-left">
                        @lang('crud.user_kids.inputs.job')
                    </th>
                    <th class="text-left">
                        @lang('crud.user_kids.inputs.description')
                    </th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="text-gray-600">
                @foreach ($kids as $kid)
                <tr class="hover:bg-gray-100">
                    <td class="text-left">
                        <input
                            type="checkbox"
                            value="{{ $kid->id }}"
                            wire:model="selected"
                        />
                    </td>
                    <td class="text-left">{{ $kid->name ?? '-' }}</td>
                    <td class="text-left">
                        {{ optional($kid->city)->name ?? '-' }}
                    </td>
                    <td class="text-left">{{ $kid->birth ?? '-' }}</td>
                    <td class="text-left">
                        {{ optional($kid->gender)->name ?? '-' }}
                    </td>
                    <td class="text-left">{{ $kid->job ?? '-' }}</td>
                    <td class="text-left">{{ $kid->description ?? '-' }}</td>
                    <td class="text-right" style="width: 134px;">
                        <div
                            role="group"
                            aria-label="Row Actions"
                            class="relative inline-flex align-middle"
                        >
                            @can('update', $kid)
                            <button
                                type="button"
                                class="btn btn-light"
                                wire:click="editKid({{ $kid->id }})"
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
                    <td colspan="7">{{ $kids->render() }}</td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
