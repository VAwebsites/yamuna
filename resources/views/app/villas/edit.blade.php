<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          
            @if (array_key_exists('PRODUCT_TYPE', $_SERVER)) 
            Edit {{$_SERVER['PRODUCT_TYPE']}}
            @else
            @lang('crud.villas.edit_title')
            @endif
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-partials.card>
                <x-slot name="title">
                    <a href="{{ route('villas.index') }}" class="mr-4"
                        ><i class="mr-1 icon ion-md-arrow-back"></i
                    ></a>
                </x-slot>

                <x-form
                    method="PUT"
                    action="{{ route('villas.update', $villa) }}"
                    has-files
                    class="mt-4"
                >
                    @include('app.villas.form-inputs')

                    <div class="mt-10">
                        <a href="{{ route('villas.index') }}" class="button">
                            <i
                                class="
                                    mr-1
                                    icon
                                    ion-md-return-left
                                    text-primary
                                "
                            ></i>
                            @lang('crud.common.back')
                        </a>

                        <a href="{{ route('villas.create') }}" class="button">
                            <i class="mr-1 icon ion-md-add text-primary"></i>
                            @lang('crud.common.create')
                        </a>

                        <button
                            type="submit"
                            class="button button-primary float-right"
                        >
                            <i class="mr-1 icon ion-md-save"></i>
                            @lang('crud.common.update')
                        </button>
                    </div>
                </x-form>
            </x-partials.card>

            @can('view-any', App\Models\VillaImage::class)
            <x-partials.card class="mt-5">
                <x-slot name="title"> Villa Images </x-slot>

                <livewire:villa-villa-images-detail :villa="$villa" />
            </x-partials.card>
            @endcan
        </div>
    </div>
</x-app-layout>
