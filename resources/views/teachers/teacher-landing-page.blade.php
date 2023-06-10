<x-app-layout>
    <section>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Welcome to the Teacher\'s page') }}
            </h2>
        </x-slot>

        @props(['teacher'])

        <div class="flex flex-wrap justify-center items-center my-6">
            <!-- Info -->
            <div class="w-full md:w-1/2 p-4 text-center">
                <h2 class="text-3xl font-semibold text-gray-800 dark:text-gray-200">{{ $teacher->name }} {{ $teacher->surname }}</h2>
                <p class="text-xl text-gray-800 dark:text-gray-200">{{ $teacher->education }}</p>
                <a href="mailto:{{ $teacher->email }}" class="text-white underline text-xl">{{ $teacher->email }}</a>
            </div>
            <!-- Image -->
            <div class="w-full md:w-1/2 p-4">
                <div class="w-full h-64 overflow-hidden rounded-lg shadow-md flex justify-center items-center">
                    <img class="max-h-[50vh] max-w-[50vw] object-contain"
                         src="{{ Str::startsWith($teacher->picture, 'images') ? asset($teacher->picture) : Storage::url($teacher->picture) }}"
                         alt="{{$teacher->name}}'s photo is not available."
                         style="max-height: 50vh; max-width: 50vw; object-fit: contain;">
                </div>
            </div>
        </div>
    </section>
    <section>
    <div class="w-full md:w-1/2 p-4">
        <div class="text-gray-200 dark:text-gray-300">
            <h2 class="text-xl font-semibold mb-2">This is a list of courses that {{ $teacher->name }} {{$teacher->surname}} is currently teaching:</h2>
        </div>
    </div>
    </section>
    <section>
        <x-courses-taught-list :courses="$courses"/>
    </section>
        <div class="w-full md:w-1/2 p-4">
            <div class="text-gray-200 dark:text-gray-300">
                <p>You're free to check out the individual courses' pages, give stars and enroll in the courses of your choice!
                </p>
            </div>
        </div>
</x-app-layout>
