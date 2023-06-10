<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Delete Course') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Once the course is deleted, all of its resources and data will be permanently deleted. Before deleting the course, please download any data or information that you wish to retain.') }}
        </p>
    </header>

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-course-deletion')"
    >{{ __('Delete Course') }}</x-danger-button>

    <x-modal name="confirm-course-deletion" focusable>
        <form method="post" action="{{ route('courses.destroy', $course) }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Are you sure you want to delete this course?') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ __('Once the course is deleted, all of its resources and data will be permanently deleted. Please confirm you would like to permanently delete this course.') }}
            </p>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-danger-button class="ml-3">
                    {{ __('Delete Course') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
