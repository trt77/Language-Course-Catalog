<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Delete Teacher') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Once the teacher is deleted, all of their resources and data will be permanently deleted. Before deleting the teacher, please download any data or information that you wish to retain.') }}
        </p>
    </header>

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-teacher-deletion')"
    >{{ __('Delete Teacher') }}</x-danger-button>

    <x-modal name="confirm-teacher-deletion" focusable>
        <form method="post" action="{{ route('teachers.destroy', $teacher) }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Are you sure you want to delete this teacher?') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ __('Once the teacher is deleted, all of their resources and data will be permanently deleted. Please confirm you would like to permanently delete this teacher.') }}
            </p>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-danger-button class="ml-3">
                    {{ __('Delete Teacher') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
