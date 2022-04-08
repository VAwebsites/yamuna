@php $editing = isset($homepageBanner) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.select
            name="homepage_setting_id"
            label="Homepage Setting"
            required
        >
            @php $selected = old('homepage_setting_id', ($editing ? $homepageBanner->homepage_setting_id : '1')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Homepage Setting</option>
            @foreach($homepageSettings as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <div
            x-data="imageViewer('{{ $editing && $homepageBanner->banner ? \Storage::url($homepageBanner->banner) : '' }}')"
        >
            <x-inputs.partials.label
                name="banner"
                label="Banner"
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
                    name="banner"
                    id="banner"
                    @change="fileChosen"
                />
            </div>

            @error('banner') @include('components.inputs.partials.error')
            @enderror
        </div>
    </x-inputs.group>
</div>
