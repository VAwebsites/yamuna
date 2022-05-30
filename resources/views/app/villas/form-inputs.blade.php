@php $editing = isset($villa) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <div
            x-data="imageViewer('{{ $editing && $villa->thumbnail ? \Storage::url($villa->thumbnail) : '' }}')"
        >
            <x-inputs.partials.label
                name="thumbnail"
                label="Thumbnail"
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
                    name="thumbnail"
                    id="thumbnail"
                    @change="fileChosen"
                />
            </div>

            @error('thumbnail') @include('components.inputs.partials.error')
            @enderror
        </div>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.textarea
            name="description"
            label="Description"
            maxlength="255"
            >{{ old('description', ($editing ? $villa->description : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="w-full lg:w-4/12">
        <x-inputs.number
            name="bhk"
            label="Bhk"
            value="{{ old('bhk', ($editing ? $villa->bhk : '')) }}"
            placeholder="Bhk"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full lg:w-4/12">
        <x-inputs.number
            name="sq_feet"
            label="Sq Feet"
            value="{{ old('sq_feet', ($editing ? $villa->sq_feet : '')) }}"
            step="0.01"
            placeholder="Sq Feet"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full lg:w-4/12">
        <x-inputs.number
            name="land_size"
            label="Land Size"
            value="{{ old('land_size', ($editing ? $villa->land_size : '')) }}"
            step="0.01"
            placeholder="Land Size"
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full lg:w-4/12">
        <x-inputs.text
            name="price"
            label="Price"
            value="{{ old('price', ($editing ? $villa->price : '')) }}"
            step="0.01"
            placeholder="Price"
        ></x-inputs.text>
    </x-inputs.group>
</div>
