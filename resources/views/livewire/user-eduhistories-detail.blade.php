<div>
    <div class="mb-4">
        @can('create', App\Models\Eduhistory::class)
        <button class="btn btn-primary" wire:click="newEduhistory">
            <i class="icon ion-md-add"></i>
            @lang('crud.common.new')
        </button>
        @endcan @can('delete-any', App\Models\Eduhistory::class)
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

    <x-modal id="user-eduhistories-modal" wire:model="showingModal">
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
                        <x-inputs.select
                            name="eduhistory.education_id"
                            label="Education"
                            wire:model="eduhistory.education_id"
                        >
                            <option value="null" disabled>Please select the Education</option>
                            @foreach($educationsForSelect as $value => $label)
                            <option value="{{ $value }}"  >{{ $label }}</option>
                            @endforeach
                        </x-inputs.select>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.text
                            name="eduhistory.major"
                            label="Major"
                            wire:model="eduhistory.major"
                            maxlength="255"
                            placeholder="Major"
                        ></x-inputs.text>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.select
                            name="eduhistory.university_id"
                            label="University"
                            wire:model="eduhistory.university_id"
                        >
                            <option value="null" disabled>Please select the University</option>
                            @foreach($universitiesForSelect as $value => $label)
                            <option value="{{ $value }}"  >{{ $label }}</option>
                            @endforeach
                        </x-inputs.select>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.select
                            name="eduhistory.city_id"
                            label="City"
                            wire:model="eduhistory.city_id"
                        >
                            <option value="null" disabled>Please select the City</option>
                            @foreach($citiesForSelect as $value => $label)
                            <option value="{{ $value }}"  >{{ $label }}</option>
                            @endforeach
                        </x-inputs.select>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.number
                            name="eduhistory.year"
                            label="Year"
                            wire:model="eduhistory.year"
                            max="255"
                            placeholder="Year"
                        ></x-inputs.number>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.textarea
                            name="eduhistory.description"
                            label="Description"
                            wire:model="eduhistory.description"
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
                        @lang('crud.user_eduhistories.inputs.education_id')
                    </th>
                    <th class="text-left">
                        @lang('crud.user_eduhistories.inputs.major')
                    </th>
                    <th class="text-left">
                        @lang('crud.user_eduhistories.inputs.university_id')
                    </th>
                    <th class="text-left">
                        @lang('crud.user_eduhistories.inputs.city_id')
                    </th>
                    <th class="text-right">
                        @lang('crud.user_eduhistories.inputs.year')
                    </th>
                    <th class="text-left">
                        @lang('crud.user_eduhistories.inputs.description')
                    </th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="text-gray-600">
                @foreach ($eduhistories as $eduhistory)
                <tr class="hover:bg-gray-100">
                    <td class="text-left">
                        <input
                            type="checkbox"
                            value="{{ $eduhistory->id }}"
                            wire:model="selected"
                        />
                    </td>
                    <td class="text-left">
                        {{ optional($eduhistory->education)->name ?? '-' }}
                    </td>
                    <td class="text-left">{{ $eduhistory->major ?? '-' }}</td>
                    <td class="text-left">
                        {{ optional($eduhistory->university)->name ?? '-' }}
                    </td>
                    <td class="text-left">
                        {{ optional($eduhistory->city)->name ?? '-' }}
                    </td>
                    <td class="text-right">{{ $eduhistory->year ?? '-' }}</td>
                    <td class="text-left">
                        {{ $eduhistory->description ?? '-' }}
                    </td>
                    <td class="text-right" style="width: 134px;">
                        <div
                            role="group"
                            aria-label="Row Actions"
                            class="relative inline-flex align-middle"
                        >
                            @can('update', $eduhistory)
                            <button
                                type="button"
                                class="btn btn-light"
                                wire:click="editEduhistory({{ $eduhistory->id }})"
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
                    <td colspan="7">{{ $eduhistories->render() }}</td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
