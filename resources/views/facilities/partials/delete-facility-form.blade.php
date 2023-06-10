<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Delete Facility') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Once the facility is deleted, all of its resources and data will be permanently deleted. Before deleting the facility, please download any data or information that you wish to retain.') }}
        </p>
    </header>

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-facility-deletion')"
    >{{ __('Delete Facility') }}</x-danger-button>

    <x-modal name="confirm-facility-deletion" focusable>
        <form method="post" action="{{ route('facilities.destroy', $facility) }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Are you sure you want to delete this facility?') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ __('Once the facility is deleted, all of its resources and data will be permanently deleted. Please confirm you would like to permanently delete this facility.') }}
            </p>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-danger-button class="ml-3">
                    {{ __('Delete Facility') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
