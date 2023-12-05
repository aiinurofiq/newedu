@php $editing = isset($valvision) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="value"
            label="Value"
            :value="old('value', ($editing ? $valvision->value : ''))"
            maxlength="255"
            placeholder="Value"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="vision"
            label="Vision"
            :value="old('vision', ($editing ? $valvision->vision : ''))"
            maxlength="255"
            placeholder="Vision"
            required
        ></x-inputs.text>
    </x-inputs.group>
</div>
