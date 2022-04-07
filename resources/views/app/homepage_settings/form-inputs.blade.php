@php $editing = isset($homepageSetting) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.partials.label
            name="logo"
            label="Logo"
        ></x-inputs.partials.label
        ><br />

        <input type="file" name="logo" id="logo" class="form-control-file" />

        @if($editing && $homepageSetting->logo)
        <div class="mt-2">
            <a
                href="{{ \Storage::url($homepageSetting->logo) }}"
                target="_blank"
                ><i class="icon ion-md-download"></i>&nbsp;Download</a
            >
        </div>
        @endif @error('logo') @include('components.inputs.partials.error')
        @enderror
    </x-inputs.group>

    <x-inputs.group class="w-full lg:w-6/12">
        <x-inputs.text
            name="project_title"
            label="Project Title"
            value="{{ old('project_title', ($editing ? $homepageSetting->project_title : '')) }}"
            maxlength="255"
            placeholder="Project Title"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full lg:w-6/12">
        <x-inputs.text
            name="project_location"
            label="Project Location"
            value="{{ old('project_location', ($editing ? $homepageSetting->project_location : '')) }}"
            maxlength="255"
            placeholder="Project Location"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.textarea name="rera_number" label="Rera Number" required
            >{{ old('rera_number', ($editing ? $homepageSetting->rera_number :
            '')) }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.partials.label
            name="brochure"
            label="Brochure"
        ></x-inputs.partials.label
        ><br />

        <input
            type="file"
            name="brochure"
            id="brochure"
            class="form-control-file"
        />

        @if($editing && $homepageSetting->brochure)
        <div class="mt-2">
            <a
                href="{{ \Storage::url($homepageSetting->brochure) }}"
                target="_blank"
                ><i class="icon ion-md-download"></i>&nbsp;Download</a
            >
        </div>
        @endif @error('brochure') @include('components.inputs.partials.error')
        @enderror
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="youtube_link"
            label="Youtube Link"
            value="{{ old('youtube_link', ($editing ? $homepageSetting->youtube_link : '')) }}"
            maxlength="255"
            placeholder="Youtube Link"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.textarea
            name="project_overview"
            label="Project Overview"
            maxlength="255"
            required
            >{{ old('project_overview', ($editing ?
            $homepageSetting->project_overview : '')) }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="w-full lg:w-6/12">
        <x-inputs.text
            name="project_type"
            label="Project Type"
            value="{{ old('project_type', ($editing ? $homepageSetting->project_type : '')) }}"
            maxlength="255"
            placeholder="Project Type"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full lg:w-6/12">
        <x-inputs.text
            name="project_status"
            label="Project Status"
            value="{{ old('project_status', ($editing ? $homepageSetting->project_status : '')) }}"
            maxlength="255"
            placeholder="Project Status"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="address_line_1"
            label="Address Line 1"
            value="{{ old('address_line_1', ($editing ? $homepageSetting->address_line_1 : '')) }}"
            maxlength="255"
            placeholder="Address Line 1"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="address_line_2"
            label="Address Line 2"
            value="{{ old('address_line_2', ($editing ? $homepageSetting->address_line_2 : '')) }}"
            maxlength="255"
            placeholder="Address Line 2"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full lg:w-6/12">
        <x-inputs.text
            name="contact_number"
            label="Contact Number"
            value="{{ old('contact_number', ($editing ? $homepageSetting->contact_number : '')) }}"
            maxlength="255"
            placeholder="Contact Number"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full lg:w-6/12">
        <x-inputs.text
            name="email"
            label="Email"
            value="{{ old('email', ($editing ? $homepageSetting->email : '')) }}"
            maxlength="255"
            placeholder="Email"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.textarea name="footer_description" label="Footer Description"
            >{{ old('footer_description', ($editing ?
            $homepageSetting->footer_description : '')) }}</x-inputs.textarea
        >
    </x-inputs.group>
</div>
