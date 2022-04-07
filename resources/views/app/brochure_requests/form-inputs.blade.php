@php $editing = isset($brochureRequest) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full lg:w-6/12">
        <x-inputs.text
            name="name"
            label="Name"
            value="{{ old('name', ($editing ? $brochureRequest->name : '')) }}"
            maxlength="255"
            placeholder="Name"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full lg:w-6/12">
        <x-inputs.email
            name="email"
            label="Email"
            value="{{ old('email', ($editing ? $brochureRequest->email : '')) }}"
            maxlength="255"
            placeholder="Email"
        ></x-inputs.email>
    </x-inputs.group>

    <x-inputs.group class="w-full lg:w-6/12">
        <x-inputs.text
            name="phone"
            label="Phone"
            value="{{ old('phone', ($editing ? $brochureRequest->phone : '')) }}"
            maxlength="255"
            placeholder="Phone"
        ></x-inputs.text>
    </x-inputs.group>
</div>
