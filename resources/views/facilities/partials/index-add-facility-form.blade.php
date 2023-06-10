@props(['$facilities'])

<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('View all currently added Facilities') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("You're free to view all the currently added facilities in this table. You can update each added facility as well as delete chosen facility data altogether.") }}
        </p>
    </header>

    <x-facility-list :facilities="$facilities"></x-facility-list>

</section>
