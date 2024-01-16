@php $editing = isset($user) @endphp

<div class="row">
    @if($editing)
    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="uuid"
            label="Uuid"
            :value="old('uuid', ($editing ? $user->uuid : ''))"
            maxlength="255"
            placeholder="Uuid"
        ></x-inputs.text>
    </x-inputs.group>
    @endif

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="kopeg"
            label="Kode Pegawai"
            :value="old('kopeg', ($editing ? $user->kopeg : ''))"
            maxlength="255"
            placeholder="Kode Pegawai"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="nik"
            label="Nomor Induk Kependudukan"
            :value="old('nik', ($editing ? $user->nik : ''))"
            maxlength="255"
            placeholder="Nomor Induk Kependudukan"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="name"
            label="Nama Lengkap"
            :value="old('name', ($editing ? $user->name : ''))"
            maxlength="255"
            placeholder="Nama Lengkap"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="city_id" label="Kota Kelahiran" required>
            @php $selected = old('city_id', ($editing ? $user->city_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Pilih Salah Satu Kota Kelahiran</option>
            @foreach($cities as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.date
            name="birth"
            label="Tanggal Lahir"
            value="{{ old('birth', ($editing ? optional($user->birth)->format('Y-m-d') : '')) }}"
            max="255"
            required
        ></x-inputs.date>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="gender_id" label="Jenis Kelamin" required>
            @php $selected = old('gender_id', ($editing ? $user->gender_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Pilih Salah Satu Jenis Kelamin</option>
            @foreach($genders as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="religion_id" label="Agama" required>
            @php $selected = old('religion_id', ($editing ? $user->religion_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Pilih Salah Satu Agama</option>
            @foreach($religions as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="address"
            label="Alamat Lengkap"
            :value="old('address', ($editing ? $user->address : ''))"
            maxlength="255"
            placeholder="Alamat Lengkap"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="phone"
            label="No. Telepon"
            :value="old('phone', ($editing ? $user->phone : ''))"
            maxlength="255"
            placeholder="No. Telepon"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.email
            name="email"
            label="Alamat Email"
            :value="old('email', ($editing ? $user->email : ''))"
            maxlength="255"
            placeholder="Alamat Email"
            required
        ></x-inputs.email>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="npwp"
            label="Nomor NPWP"
            :value="old('npwp', ($editing ? $user->npwp : ''))"
            maxlength="255"
            placeholder="Nomor NPWP"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="tribe_id" label="Suku" required>
            @php $selected = old('tribe_id', ($editing ? $user->tribe_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Pilih Salah Satu Suku</option>
            @foreach($tribes as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="bloodtype_id" label="Golongan Darah" required>
            @php $selected = old('bloodtype_id', ($editing ? $user->bloodtype_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Golongan Darah</option>
            @foreach($bloodtypes as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="marital_id" label="Status Pernikahan" required>
            @php $selected = old('marital_id', ($editing ? $user->marital_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Pilih Salah Satu Status Pernikahan</option>
            @foreach($maritals as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.password
            name="password"
            label="Password"
            maxlength="255"
            placeholder="Password"
            :required="!$editing"
        ></x-inputs.password>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <div
            x-data="imageViewer('{{ $editing && $user->profile_photo_path ? asset(\Storage::url($user->profile_photo_path)) : '' }}')"
        >
            <x-inputs.partials.label
                name="profile_photo_path"
                label="Foto Profil"
            ></x-inputs.partials.label
            ><br />

            <!-- Show the image -->
            <template x-if="imageUrl">
                <img
                    :src="imageUrl"
                    class="object-cover rounded border border-gray-200"
                    style="width: 100px; height: 100px;"
                />
            </template>

            <!-- Show the gray box when image is not available -->
            <template x-if="!imageUrl">
                <div
                    class="border rounded border-gray-200 bg-gray-100"
                    style="width: 100px; height: 100px;"
                ></div>
            </template>

            <div class="mt-2">
                <input
                    type="file"
                    name="profile_photo_path"
                    id="profile_photo_path"
                    @change="fileChosen"
                />
            </div>

            @error('profile_photo_path')
            @include('components.inputs.partials.error') @enderror
        </div>
    </x-inputs.group>

    <div class="form-group col-sm-12 mt-4">
        <h4>Assign @lang('crud.bumnsectors.name')</h4>

        @foreach ($bumnsectors as $bumnsector)
        <div>
            <x-inputs.checkbox
                id="bumnsector{{ $bumnsector->id }}"
                name="bumnsectors[]"
                label="{{ ucfirst($bumnsector->name) }}"
                value="{{ $bumnsector->id }}"
                :checked="isset($user) ? $user->bumnsectors()->where('id', $bumnsector->id)->exists() : false"
                :add-hidden-value="false"
            ></x-inputs.checkbox>
        </div>
        @endforeach
    </div>
    <div class="form-group col-sm-12 mt-4">
        <h4>Assign @lang('crud.bumnclasses.name')</h4>

        @foreach ($bumnclasses as $bumnclass)
        <div>
            <x-inputs.checkbox
                id="bumnclass{{ $bumnclass->id }}"
                name="bumnclasses[]"
                label="{{ ucfirst($bumnclass->name) }}"
                value="{{ $bumnclass->id }}"
                :checked="isset($user) ? $user->bumnclasses()->where('id', $bumnclass->id)->exists() : false"
                :add-hidden-value="false"
            ></x-inputs.checkbox>
        </div>
        @endforeach
    </div>

    <div class="form-group col-sm-12 mt-4">
        <h4>Assign @lang('crud.roles.name')</h4>

        @foreach ($roles as $role)
        <div>
            <x-inputs.checkbox
                id="role{{ $role->id }}"
                name="roles[]"
                label="{{ ucfirst($role->name) }}"
                value="{{ $role->id }}"
                :checked="isset($user) ? $user->hasRole($role) : false"
                :add-hidden-value="false"
            ></x-inputs.checkbox>
        </div>
        @endforeach
    </div>
</div>
