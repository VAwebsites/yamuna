@php $editing = isset($nearByLocation) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <div
            x-data="imageViewer('{{ $editing && $nearByLocation->img ? \Storage::url($nearByLocation->img) : '' }}')"
        >
            <x-inputs.partials.label
                name="img"
                label="Img"
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
                <input type="file" name="img" id="img" @change="fileChosen" />
            </div>

            @error('img') @include('components.inputs.partials.error') @enderror
        </div>
    </x-inputs.group>

    <x-inputs.group class="w-full lg:w-6/12">
        <x-inputs.text
            name="name"
            label="Name"
            value="{{ old('name', ($editing ? $nearByLocation->name : '')) }}"
            maxlength="255"
            placeholder="Name"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full lg:w-6/12">
        <x-inputs.number
            name="order"
            label="Order"
            value="{{ old('order', ($editing ? $nearByLocation->order : '')) }}"
            placeholder="Order"
        ></x-inputs.number>
    </x-inputs.group>
</div>
