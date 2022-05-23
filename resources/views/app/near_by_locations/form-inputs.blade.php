@php $editing = isset($nearByLocation) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full lg:w-6/12">
        <x-inputs.textarea name="img" label="Img" maxlength="255" required
            >{{ old('img', ($editing ? $nearByLocation->img : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="w-full lg:w-6/12">
        <x-inputs.textarea name="name" label="Name" maxlength="255" required
            >{{ old('name', ($editing ? $nearByLocation->name : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="w-full lg:w-4/12">
        <x-inputs.number
            name="order"
            label="Order"
            value="{{ old('order', ($editing ? $nearByLocation->order : '')) }}"
            max="255"
            placeholder="Order"
        ></x-inputs.number>
    </x-inputs.group>
</div>
