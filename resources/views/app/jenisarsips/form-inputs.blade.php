@php $editing = isset($jenisarsip) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="jenis"
            label="Jenis"
            :value="old('jenis', ($editing ? $jenisarsip->jenis : ''))"
            maxlength="255"
            placeholder="Jenis"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="subjenis"
            label="Subjenis"
            :value="old('subjenis', ($editing ? $jenisarsip->subjenis : ''))"
            maxlength="255"
            placeholder="Subjenis"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="subsubjenis"
            label="Subsubjenis"
            :value="old('subsubjenis', ($editing ? $jenisarsip->subsubjenis : ''))"
            maxlength="255"
            placeholder="Subsubjenis"
        ></x-inputs.text>
    </x-inputs.group>
</div>
