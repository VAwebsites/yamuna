@php $editing = isset($image) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <div
            x-data="imageViewer('{{ $editing && $image->img_path ? \Storage::url($image->img_path) : '' }}')"
        >
            <x-inputs.partials.label
                name="img_path"
                label="Img Path"
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
                    name="img_path"
                    id="img_path"
                    @change="fileChosen"
                />
            </div>

            @error('img_path') @include('components.inputs.partials.error')
            @enderror
        </div>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="order"
            label="Order"
            value="{{ old('order', ($editing ? $image->order : '')) }}"
            placeholder="Order"
            required
        ></x-inputs.number>
    </x-inputs.group>
</div>
