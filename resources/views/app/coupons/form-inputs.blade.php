@php $editing = isset($coupon) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="code"
            label="Code"
            :value="old('code', ($editing ? $coupon->code : ''))"
            maxlength="255"
            placeholder="Code"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.number
            name="cutprice"
            label="Cutprice"
            :value="old('cutprice', ($editing ? $coupon->cutprice : ''))"
            max="255"
            step="0.01"
            placeholder="Cutprice"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="typecut" label="Typecut">
            @php $selected = old('typecut', ($editing ? $coupon->typecut : '')) @endphp
            <option value="percentage" {{ $selected == 'percentage' ? 'selected' : '' }} >Percentage</option>
            <option value="nominal" {{ $selected == 'nominal' ? 'selected' : '' }} >Nominal</option>
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.number
            name="maxcut"
            label="Maxcut"
            :value="old('maxcut', ($editing ? $coupon->maxcut : ''))"
            max="255"
            step="0.01"
            placeholder="Maxcut"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.number
            name="maxusage"
            label="Maxusage"
            :value="old('maxusage', ($editing ? $coupon->maxusage : ''))"
            max="255"
            placeholder="Maxusage"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.date
            name="expireddate"
            label="Expireddate"
            value="{{ old('expireddate', ($editing ? optional($coupon->expireddate)->format('Y-m-d') : '')) }}"
            max="255"
            required
        ></x-inputs.date>
    </x-inputs.group>
</div>
