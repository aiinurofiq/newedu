@php $editing = isset($lTransaction) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="uuid"
            label="Uuid"
            :value="old('uuid', ($editing ? $lTransaction->uuid : ''))"
            maxlength="255"
            placeholder="Uuid"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="user_id" label="User" required>
            @php $selected = old('user_id', ($editing ? $lTransaction->user_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the User</option>
            @foreach($users as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="learning_id" label="Learning" required>
            @php $selected = old('learning_id', ($editing ? $lTransaction->learning_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Learning</option>
            @foreach($learnings as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="lpayment_id" label="Lpayment" required>
            @php $selected = old('lpayment_id', ($editing ? $lTransaction->lpayment_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Lpayment</option>
            @foreach($lpayments as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="coupon_id" label="Coupon" required>
            @php $selected = old('coupon_id', ($editing ? $lTransaction->coupon_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Coupon</option>
            @foreach($coupons as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.number
            name="totalamount"
            label="Totalamount"
            :value="old('totalamount', ($editing ? $lTransaction->totalamount : ''))"
            max="255"
            step="0.01"
            placeholder="Totalamount"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="status" label="Status">
            @php $selected = old('status', ($editing ? $lTransaction->status : '0')) @endphp
            <option value="0" {{ $selected == '0' ? 'selected' : '' }} >0</option>
            <option value="2" {{ $selected == '2' ? 'selected' : '' }} >1</option>
        </x-inputs.select>
    </x-inputs.group>
</div>
