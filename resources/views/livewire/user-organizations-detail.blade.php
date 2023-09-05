<div>
    <div class="mb-4">
        @can('create', App\Models\Organization::class)
        <button class="btn btn-primary" wire:click="newOrganization">
            <i class="icon ion-md-add"></i>
            @lang('crud.common.new')
        </button>
        @endcan @can('delete-any', App\Models\Organization::class)
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

    <x-modal id="user-organizations-modal" wire:model="showingModal">
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
                            name="organization.name"
                            label="Name"
                            wire:model="organization.name"
                            maxlength="255"
                            placeholder="Name"
                        ></x-inputs.text>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.text
                            name="organization.position"
                            label="Position"
                            wire:model="organization.position"
                            maxlength="255"
                            placeholder="Position"
                        ></x-inputs.text>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.date
                            name="organizationStart"
                            label="Start"
                            wire:model="organizationStart"
                            max="255"
                        ></x-inputs.date>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.date
                            name="organizationEnd"
                            label="End"
                            wire:model="organizationEnd"
                            max="255"
                        ></x-inputs.date>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.textarea
                            name="organization.description"
                            label="Description"
                            wire:model="organization.description"
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
                        @lang('crud.user_organizations.inputs.name')
                    </th>
                    <th class="text-left">
                        @lang('crud.user_organizations.inputs.position')
                    </th>
                    <th class="text-left">
                        @lang('crud.user_organizations.inputs.start')
                    </th>
                    <th class="text-left">
                        @lang('crud.user_organizations.inputs.end')
                    </th>
                    <th class="text-left">
                        @lang('crud.user_organizations.inputs.description')
                    </th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="text-gray-600">
                @foreach ($organizations as $organization)
                <tr class="hover:bg-gray-100">
                    <td class="text-left">
                        <input
                            type="checkbox"
                            value="{{ $organization->id }}"
                            wire:model="selected"
                        />
                    </td>
                    <td class="text-left">{{ $organization->name ?? '-' }}</td>
                    <td class="text-left">
                        {{ $organization->position ?? '-' }}
                    </td>
                    <td class="text-left">{{ $organization->start ?? '-' }}</td>
                    <td class="text-left">{{ $organization->end ?? '-' }}</td>
                    <td class="text-left">
                        {{ $organization->description ?? '-' }}
                    </td>
                    <td class="text-right" style="width: 134px;">
                        <div
                            role="group"
                            aria-label="Row Actions"
                            class="relative inline-flex align-middle"
                        >
                            @can('update', $organization)
                            <button
                                type="button"
                                class="btn btn-light"
                                wire:click="editOrganization({{ $organization->id }})"
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
                    <td colspan="6">{{ $organizations->render() }}</td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
