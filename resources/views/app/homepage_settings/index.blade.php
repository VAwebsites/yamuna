<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.homepage_settings.index_title')
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-partials.card>
                <div class="mb-5 mt-4">
                    <div class="flex flex-wrap justify-between">
                        <div class="md:w-1/2">
                            <form>
                                <div class="flex items-center w-full">
                                    <x-inputs.text
                                        name="search"
                                        value="{{ $search ?? '' }}"
                                        placeholder="{{ __('crud.common.search') }}"
                                        autocomplete="off"
                                    ></x-inputs.text>

                                    <div class="ml-1">
                                        <button
                                            type="submit"
                                            class="button button-primary"
                                        >
                                            <i class="icon ion-md-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="md:w-1/2 text-right">
                            @can('create', App\Models\HomepageSetting::class)
                            <a
                                href="{{ route('homepage-settings.create') }}"
                                class="button button-primary"
                            >
                                <i class="mr-1 icon ion-md-add"></i>
                                @lang('crud.common.create')
                            </a>
                            @endcan
                        </div>
                    </div>
                </div>

                <div class="block w-full overflow-auto scrolling-touch">
                    <table class="w-full max-w-full mb-4 bg-transparent">
                        <thead class="text-gray-700">
                            <tr>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.homepage_settings.inputs.logo')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.homepage_settings.inputs.project_title')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.homepage_settings.inputs.project_location')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.homepage_settings.inputs.rera_number')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.homepage_settings.inputs.brochure')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.homepage_settings.inputs.youtube_link')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.homepage_settings.inputs.project_overview')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.homepage_settings.inputs.project_type')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.homepage_settings.inputs.project_status')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.homepage_settings.inputs.address_line_1')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.homepage_settings.inputs.address_line_2')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.homepage_settings.inputs.contact_number')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.homepage_settings.inputs.email')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.homepage_settings.inputs.footer_description')
                                </th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600">
                            @forelse($homepageSettings as $homepageSetting)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 text-left">
                                    @if($homepageSetting->logo)
                                    <a
                                        href="{{ \Storage::url($homepageSetting->logo) }}"
                                        target="blank"
                                        ><i
                                            class="mr-1 icon ion-md-download"
                                        ></i
                                        >&nbsp;Download</a
                                    >
                                    @else - @endif
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $homepageSetting->project_title ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $homepageSetting->project_location ?? '-'
                                    }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $homepageSetting->rera_number ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    @if($homepageSetting->brochure)
                                    <a
                                        href="{{ \Storage::url($homepageSetting->brochure) }}"
                                        target="blank"
                                        ><i
                                            class="mr-1 icon ion-md-download"
                                        ></i
                                        >&nbsp;Download</a
                                    >
                                    @else - @endif
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $homepageSetting->youtube_link ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $homepageSetting->project_overview ?? '-'
                                    }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $homepageSetting->project_type ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $homepageSetting->project_status ?? '-'
                                    }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $homepageSetting->address_line_1 ?? '-'
                                    }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $homepageSetting->address_line_2 ?? '-'
                                    }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $homepageSetting->contact_number ?? '-'
                                    }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $homepageSetting->email ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $homepageSetting->footer_description ??
                                    '-' }}
                                </td>
                                <td
                                    class="px-4 py-3 text-center"
                                    style="width: 134px;"
                                >
                                    <div
                                        role="group"
                                        aria-label="Row Actions"
                                        class="
                                            relative
                                            inline-flex
                                            align-middle
                                        "
                                    >
                                        @can('update', $homepageSetting)
                                        <a
                                            href="{{ route('homepage-settings.edit', $homepageSetting) }}"
                                            class="mr-1"
                                        >
                                            <button
                                                type="button"
                                                class="button"
                                            >
                                                <i
                                                    class="icon ion-md-create"
                                                ></i>
                                            </button>
                                        </a>
                                        @endcan @can('view', $homepageSetting)
                                        <a
                                            href="{{ route('homepage-settings.show', $homepageSetting) }}"
                                            class="mr-1"
                                        >
                                            <button
                                                type="button"
                                                class="button"
                                            >
                                                <i class="icon ion-md-eye"></i>
                                            </button>
                                        </a>
                                        @endcan @can('delete', $homepageSetting)
                                        <form
                                            action="{{ route('homepage-settings.destroy', $homepageSetting) }}"
                                            method="POST"
                                            onsubmit="return confirm('{{ __('crud.common.are_you_sure') }}')"
                                        >
                                            @csrf @method('DELETE')
                                            <button
                                                type="submit"
                                                class="button"
                                            >
                                                <i
                                                    class="
                                                        icon
                                                        ion-md-trash
                                                        text-red-600
                                                    "
                                                ></i>
                                            </button>
                                        </form>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="15">
                                    @lang('crud.common.no_items_found')
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="15">
                                    <div class="mt-10 px-4">
                                        {!! $homepageSettings->render() !!}
                                    </div>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </x-partials.card>
        </div>
    </div>
</x-app-layout>
