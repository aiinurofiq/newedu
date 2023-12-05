<div>
    <div class="mb-4">
        @can('create', App\Models\Section::class)
        <button class="btn btn-primary" wire:click="newSection">
            <i class="icon ion-md-add"></i>
            @lang('crud.common.new')
        </button>
        @endcan @can('delete-any', App\Models\Section::class)
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

    <x-modal id="learning-sections-modal" wire:model="showingModal">
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
                            name="section.title"
                            label="Title"
                            wire:model="section.title"
                            maxlength="255"
                            placeholder="Title"
                        ></x-inputs.text>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <div
                            image-url="{{ $editing && $section->image ? asset(\Storage::url($section->image)) : '' }}"
                            x-data="imageViewer()"
                            @refresh.window="refreshUrl()"
                        >
                            <x-inputs.partials.label
                                name="sectionImage"
                                label="Image"
                            ></x-inputs.partials.label
                            ><br />

                            <!-- Show the image -->
                            <template x-if="imageUrl">
                                <img
                                    :src="imageUrl"
                                    class="
                                        object-cover
                                        rounded
                                        border border-gray-200
                                    "
                                    style="width: 100px; height: 100px;"
                                />
                            </template>

                            <!-- Show the gray box when image is not available -->
                            <template x-if="!imageUrl">
                                <div
                                    class="
                                        border
                                        rounded
                                        border-gray-200
                                        bg-gray-100
                                    "
                                    style="width: 100px; height: 100px;"
                                ></div>
                            </template>

                            <div class="mt-2">
                                <input
                                    type="file"
                                    name="sectionImage"
                                    id="sectionImage{{ $uploadIteration }}"
                                    wire:model="sectionImage"
                                    @change="fileChosen"
                                />
                            </div>

                            @error('sectionImage')
                            @include('components.inputs.partials.error')
                            @enderror
                        </div>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.textarea
                            name="section.description"
                            label="Description"
                            wire:model="section.description"
                            maxlength="255"
                        ></x-inputs.textarea>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.select
                            name="section.hquiz"
                            label="Hquiz"
                            wire:model="section.hquiz"
                        >
                            <option value="0" {{ $selected == '0' ? 'selected' : '' }} >0</option>
                            <option value="1" {{ $selected == '1' ? 'selected' : '' }} >1</option>
                        </x-inputs.select>
                    </x-inputs.group>
                </div>
            </div>

            @if($editing) @can('view-any', App\Models\Module::class)
            <div class="card mt-4">
                <div class="card-body">
                    <h6 class="card-title">Modules</h6>

                    <livewire:section-modules-detail :section="$section" />
                </div>
            </div>
            @endcan @can('view-any', App\Models\Quiz::class)
            <div class="card mt-4">
                <div class="card-body">
                    <h6 class="card-title">Quizzes</h6>

                    <livewire:section-quizzes-detail :section="$section" />
                </div>
            </div>
            @endcan @endif

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
                        @lang('crud.learning_sections.inputs.title')
                    </th>
                    <th class="text-left">
                        @lang('crud.learning_sections.inputs.image')
                    </th>
                    <th class="text-left">
                        @lang('crud.learning_sections.inputs.description')
                    </th>
                    <th class="text-left">
                        @lang('crud.learning_sections.inputs.hquiz')
                    </th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="text-gray-600">
                @foreach ($sections as $section)
                <tr class="hover:bg-gray-100">
                    <td class="text-left">
                        <input
                            type="checkbox"
                            value="{{ $section->id }}"
                            wire:model="selected"
                        />
                    </td>
                    <td class="text-left">{{ $section->title ?? '-' }}</td>
                    <td class="text-left">
                        <x-partials.thumbnail
                            src="{{ $section->image ? asset(\Storage::url($section->image)) : '' }}"
                        />
                    </td>
                    <td class="text-left">
                        {{ $section->description ?? '-' }}
                    </td>
                    <td class="text-left">{{ $section->hquiz ?? '-' }}</td>
                    <td class="text-right" style="width: 134px;">
                        <div
                            role="group"
                            aria-label="Row Actions"
                            class="relative inline-flex align-middle"
                        >
                            @can('update', $section)
                            <button
                                type="button"
                                class="btn btn-light"
                                wire:click="editSection({{ $section->id }})"
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
                    <td colspan="5">{{ $sections->render() }}</td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
