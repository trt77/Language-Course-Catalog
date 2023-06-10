<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add new facility') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('facilities.partials.add-facility-form')
                </div>
            </div>
        </div>
        \n
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white my-auto dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="w-full">
                    @include('facilities.partials.index-add-facility-form')
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
