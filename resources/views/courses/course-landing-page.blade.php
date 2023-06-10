<x-app-layout>
    <section>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Course page') }}
            </h2>
        </x-slot>

        @props(['course'])

        <div class="flex flex-wrap justify-center items-center my-6">
            <!-- Info -->
            <div class="w-full md:w-1/2 p-4 text-center">
                <h2 class="text-3xl font-semibold text-gray-800 dark:text-gray-200">{{ $course->name }}</h2>
                <p class="text-xl text-gray-800 dark:text-gray-200">Level: {{ $course->level }}</p>
                <p class="text-xl text-gray-800 dark:text-gray-200">Language: {{ $course->language }}</p>
            </div>
            <!-- Schedule -->
            <div class="w-full md:w-1/2 p-4">
                <div class="w-full h-auto overflow-hidden rounded-lg shadow-md flex justify-center items-center bg-gray-100 dark:bg-gray-700 p-6">
                    <div class="text-center">
                        <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-200">Schedule</h2>
                        @if($course->schedule)
                            <p class="text-lg text-gray-800 dark:text-gray-200">Start date: {{ $course->schedule->start_date }}</p>
                            <p class="text-lg text-gray-800 dark:text-gray-200">End date: {{ $course->schedule->end_date }}</p>
                            <p class="text-lg text-gray-800 dark:text-gray-200">Days: {{ implode(', ', $course->schedule->days_of_week) }}</p>
                            <p class="text-lg text-gray-800 dark:text-gray-200">Time: {{ $course->schedule->time }}</p>
                            <p class="text-lg text-gray-800 dark:text-gray-200">Duration: {{ $course->schedule->duration }} minutes</p>
                            <p class="text-lg text-gray-800 dark:text-gray-200">Location: {{ $course->schedule->facility->name }}, {{ $course->schedule->facility->address }}</p>
                        @else
                            <p class="text-lg text-gray-800 dark:text-gray-200">No schedule set for this course.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="flex flex-wrap justify-center items-center my-6">
            <div class="w-full md:w-1/2 p-4 text-center rounded-lg bg-gray-100 dark:bg-gray-700">
                <h2 class="text-3xl font-semibold text-gray-800 dark:text-gray-200">Teacher of this course:</h2>
                <p class="text-xl text-gray-800 dark:text-gray-200">
                    Name:
                    @if($course->teacher)
                        {{ $course->teacher->name }} {{ $course->teacher->surname }}
                    @else
                        <span class="text-coral-500">No teacher set</span>
                    @endif
                </p>
                @if($course->teacher && $course->teacher->email)
                    <p class="text-xl text-gray-800 dark:text-gray-200">Email:
                        <a href="mailto:{{ $course->teacher->email }}" class="text-white underline text-xl">
                            {{ $course->teacher->email }}
                        </a>
                    </p>
                @endif
            </div>
            <div class="w-full md:w-1/2 p-4 flex justify-center items-center">
                @if($course->teacher)
                    <a href="{{ route('teachers.show', $course->teacher->id) }}" class="px-6 py-3 bg-green-500 text-white text-lg font-semibold rounded-lg shadow-md hover:bg-green-700">
                        Go to Teacher's Page
                    </a>
                @else
                    <p class="text-lg font-semibold" style="color:coral">
                        Teacher's page unavailable
                    </p>
                @endif
            </div>
        </div>

    </section>
</x-app-layout>
