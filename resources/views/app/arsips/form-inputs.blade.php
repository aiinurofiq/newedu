@php $editing = isset($arsip) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="name"
            label="Name"
            :value="old('name', ($editing ? $arsip->name : ''))"
            maxlength="255"
            placeholder="Name"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.partials.label
            name="file"
            label="File"
        ></x-inputs.partials.label
        ><br />

        <input type="file" name="file" id="file" class="form-control-file" />

        @if($editing && $arsip->file)
        <div class="mt-2">
            <a href="{{ asset(\Storage::url($arsip->file)) }}" target="_blank"
                ><i class="icon ion-md-download"></i>&nbsp;Download</a
            >
        </div>
        @endif @error('file') @include('components.inputs.partials.error')
        @enderror
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="kodeklasifikasi"
            label="Kode klasifikasi"
            :value="old('kodeklasifikasi', ($editing ? $arsip->kodeklasifikasi : ''))"
            maxlength="255"
            placeholder="Kode klasifikasi"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="jwp_aktif"
            label="Jangka Waktu Penyimpanan Aktif"
            :value="old('jwp_aktif', ($editing ? $arsip->jwp_aktif : ''))"
            maxlength="255"
            placeholder="Jangka Waktu Penyimpanan Aktif"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="jwp_inaktif"
            label="Jangka Waktu Penyimpanan Inaktif"
            :value="old('jwp_inaktif', ($editing ? $arsip->jwp_inaktif : ''))"
            maxlength="255"
            placeholder="Jangka Waktu Penyimpanan Inaktif"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="ha_internal"
            label="Hak Akses Internal"
            :value="old('ha_internal', ($editing ? $arsip->ha_internal : ''))"
            maxlength="255"
            placeholder="Hak Akses Internal"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="ha_eksternal"
            label="Hak Akses Eksternal"
            :value="old('ha_eksternal', ($editing ? $arsip->ha_eksternal : ''))"
            maxlength="255"
            placeholder="Hak Akses Eksternal"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="keterangan_id" label="Keterangan" required>
            @php $selected = old('keterangan_id', ($editing ? $arsip->keterangan_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Keterangan</option>
            @foreach($keterangans as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="jenisarsip_id" label="Jenis Arsip" required>
            @php $selected = old('jenisarsip_id', ($editing ? $arsip->jenisarsip_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Jenisarsip</option>
            @foreach($jenisarsips as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >
                @if(!empty($label->jenis))
                {{ $label->jenis }}
                @else
                @endif
                @if(!empty($label->subjenis))
                - {{ $label->subjenis }}
                @else
                @endif
                @if(!empty($label->subsubjenis))
                - {{ $label->subsubjenis }}
                @else
                @endif    
            </option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="kkeamanan_id" label="Klasifikasi Keamanan" required>
            @php $selected = old('kkeamanan_id', ($editing ? $arsip->kkeamanan_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Kkeamanan</option>
            @foreach($kkeamanans as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select
            name="dasarpertimbangan_id"
            label="Dasarpertimbangan"
            required
        >
            @php $selected = old('dasarpertimbangan_id', ($editing ? $arsip->dasarpertimbangan_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Dasarpertimbangan</option>
            @foreach($dasarpertimbangans as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="user_id" label="User" required>
            @php $selected = old('user_id', ($editing ? $arsip->user_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the User</option>
            @foreach($users as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
</div>
