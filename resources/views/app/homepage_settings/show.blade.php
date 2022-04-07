<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.homepage_settings.show_title')
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-partials.card>
                <x-slot name="title">
                    <a
                        href="{{ route('homepage-settings.index') }}"
                        class="mr-4"
                        ><i class="mr-1 icon ion-md-arrow-back"></i
                    ></a>
                </x-slot>

                <div class="mt-4 px-4">
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.homepage_settings.inputs.logo')
                        </h5>
                        @if($homepageSetting->logo)
                        <a
                            href="{{ \Storage::url($homepageSetting->logo) }}"
                            target="blank"
                            ><i class="mr-1 icon ion-md-download"></i
                            >&nbsp;Download</a
                        >
                        @else - @endif
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.homepage_settings.inputs.project_title')
                        </h5>
                        <span
                            >{{ $homepageSetting->project_title ?? '-' }}</span
                        >
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.homepage_settings.inputs.project_location')
                        </h5>
                        <span
                            >{{ $homepageSetting->project_location ?? '-'
                            }}</span
                        >
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.homepage_settings.inputs.rera_number')
                        </h5>
                        <span>{{ $homepageSetting->rera_number ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.homepage_settings.inputs.brochure')
                        </h5>
                        @if($homepageSetting->brochure)
                        <a
                            href="{{ \Storage::url($homepageSetting->brochure) }}"
                            target="blank"
                            ><i class="mr-1 icon ion-md-download"></i
                            >&nbsp;Download</a
                        >
                        @else - @endif
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.homepage_settings.inputs.youtube_link')
                        </h5>
                        <span>{{ $homepageSetting->youtube_link ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.homepage_settings.inputs.project_overview')
                        </h5>
                        <span
                            >{{ $homepageSetting->project_overview ?? '-'
                            }}</span
                        >
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.homepage_settings.inputs.project_type')
                        </h5>
                        <span>{{ $homepageSetting->project_type ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.homepage_settings.inputs.project_status')
                        </h5>
                        <span
                            >{{ $homepageSetting->project_status ?? '-' }}</span
                        >
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.homepage_settings.inputs.address_line_1')
                        </h5>
                        <span
                            >{{ $homepageSetting->address_line_1 ?? '-' }}</span
                        >
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.homepage_settings.inputs.address_line_2')
                        </h5>
                        <span
                            >{{ $homepageSetting->address_line_2 ?? '-' }}</span
                        >
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.homepage_settings.inputs.contact_number')
                        </h5>
                        <span
                            >{{ $homepageSetting->contact_number ?? '-' }}</span
                        >
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.homepage_settings.inputs.email')
                        </h5>
                        <span>{{ $homepageSetting->email ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.homepage_settings.inputs.footer_description')
                        </h5>
                        <span
                            >{{ $homepageSetting->footer_description ?? '-'
                            }}</span
                        >
                    </div>
                </div>

                <div class="mt-10">
                    <a
                        href="{{ route('homepage-settings.index') }}"
                        class="button"
                    >
                        <i class="mr-1 icon ion-md-return-left"></i>
                        @lang('crud.common.back')
                    </a>

                    @can('create', App\Models\HomepageSetting::class)
                    <a
                        href="{{ route('homepage-settings.create') }}"
                        class="button"
                    >
                        <i class="mr-1 icon ion-md-add"></i>
                        @lang('crud.common.create')
                    </a>
                    @endcan
                </div>
            </x-partials.card>
        </div>
    </div>
</x-app-layout>
