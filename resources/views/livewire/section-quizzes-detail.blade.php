<div>
    <div class="mb-4">
        @can('create', App\Models\Quiz::class)
        <button class="btn btn-primary" wire:click="newQuiz">
            <i class="icon ion-md-add"></i>
            @lang('crud.common.new')
        </button>
        @endcan @can('delete-any', App\Models\Quiz::class)
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

    <x-modal id="section-quizzes-modal" wire:model="showingModal">
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
                            name="quiz.category"
                            label="Category"
                            wire:model="quiz.category"
                        >
                            <option value="0" {{ $selected == '0' ? 'selected' : '' }} >0</option>
                            <option value="1" {{ $selected == '1' ? 'selected' : '' }} >1</option>
                            <option value="2" {{ $selected == '2' ? 'selected' : '' }} >2</option>
                            <option value="3" {{ $selected == '3' ? 'selected' : '' }} >3</option>
                        </x-inputs.select>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.number
                            name="quiz.passinggrade"
                            label="Passinggrade"
                            wire:model="quiz.passinggrade"
                            max="255"
                            step="0.01"
                            placeholder="Passinggrade"
                        ></x-inputs.number>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.number
                            name="quiz.sumvalue"
                            label="Sumvalue"
                            wire:model="quiz.sumvalue"
                            max="255"
                            step="0.01"
                            placeholder="Sumvalue"
                        ></x-inputs.number>
                    </x-inputs.group>

                    <x-inputs.group class="col-sm-12">
                        <x-inputs.textarea
                            name="quiz.description"
                            label="Description"
                            wire:model="quiz.description"
                            maxlength="255"
                        ></x-inputs.textarea>
                    </x-inputs.group>
                </div>
            </div>

            @if($editing) @can('view-any', App\Models\Question::class)
            <div class="card mt-4">
                <div class="card-body">
                    <h6 class="card-title">Questions</h6>

                    <livewire:quiz-questions-detail :quiz="$quiz" />
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
                        @lang('crud.section_quizzes.inputs.category')
                    </th>
                    <th class="text-right">
                        @lang('crud.section_quizzes.inputs.passinggrade')
                    </th>
                    <th class="text-right">
                        @lang('crud.section_quizzes.inputs.sumvalue')
                    </th>
                    <th class="text-left">
                        @lang('crud.section_quizzes.inputs.description')
                    </th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="text-gray-600">
                @foreach ($quizzes as $quiz)
                <tr class="hover:bg-gray-100">
                    <td class="text-left">
                        <input
                            type="checkbox"
                            value="{{ $quiz->id }}"
                            wire:model="selected"
                        />
                    </td>
                    <td class="text-left">{{ $quiz->category ?? '-' }}</td>
                    <td class="text-right">{{ $quiz->passinggrade ?? '-' }}</td>
                    <td class="text-right">{{ $quiz->sumvalue ?? '-' }}</td>
                    <td class="text-left">{{ $quiz->description ?? '-' }}</td>
                    <td class="text-right" style="width: 134px;">
                        <div
                            role="group"
                            aria-label="Row Actions"
                            class="relative inline-flex align-middle"
                        >
                            @can('update', $quiz)
                            <button
                                type="button"
                                class="btn btn-light"
                                wire:click="editQuiz({{ $quiz->id }})"
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
                    <td colspan="5">{{ $quizzes->render() }}</td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
