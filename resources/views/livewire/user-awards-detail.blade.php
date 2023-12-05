<div>
    <div class="mb-4">
        @can('create', App\Models\Award::class)
        <button class="btn btn-primary" wire:click="newAward">
            <i class="icon ion-md-add"></i>
            @lang('crud.common.new')
        </button>
        @endcan @can('delete-any', App\Models\Award::class)
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

    <x-modal id="user-awards-modal" wire:model="showingModal">
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
                            name="award.name"
                            label="Name"
                            wire:model="award.name"
                            maxlength="255"
                            placeholder="Name"
                        ></x-inputs.text>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.text
                            name="award.from"
                            label="From"
                            wire:model="award.from"
                            maxlength="255"
                            placeholder="From"
                        ></x-inputs.text>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.number
                            name="award.year"
                            label="Year"
                            wire:model="award.year"
                            max="255"
                            placeholder="Year"
                        ></x-inputs.number>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.select
                            name="award.scale"
                            label="Scale"
                            wire:model="award.scale"
                        >
                            <option value="1" {{ $selected == '1' ? 'selected' : '' }} >1</option>
                            <option value="2" {{ $selected == '2' ? 'selected' : '' }} >2</option>
                            <option value="3" {{ $selected == '3' ? 'selected' : '' }} >3</option>
                            <option value="4" {{ $selected == '4' ? 'selected' : '' }} >4</option>
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
                        @lang('crud.user_awards.inputs.name')
                    </th>
                    <th class="text-left">
                        @lang('crud.user_awards.inputs.from')
                    </th>
                    <th class="text-right">
                        @lang('crud.user_awards.inputs.year')
                    </th>
                    <th class="text-left">
                        @lang('crud.user_awards.inputs.scale')
                    </th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="text-gray-600">
                @foreach ($awards as $award)
                <tr class="hover:bg-gray-100">
                    <td class="text-left">
                        <input
                            type="checkbox"
                            value="{{ $award->id }}"
                            wire:model="selected"
                        />
                    </td>
                    <td class="text-left">{{ $award->name ?? '-' }}</td>
                    <td class="text-left">{{ $award->from ?? '-' }}</td>
                    <td class="text-right">{{ $award->year ?? '-' }}</td>
                    <td class="text-left">{{ $award->scale ?? '-' }}</td>
                    <td class="text-right" style="width: 134px;">
                        <div
                            role="group"
                            aria-label="Row Actions"
                            class="relative inline-flex align-middle"
                        >
                            @can('update', $award)
                            <button
                                type="button"
                                class="btn btn-light"
                                wire:click="editAward({{ $award->id }})"
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
                    <td colspan="5">{{ $awards->render() }}</td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
