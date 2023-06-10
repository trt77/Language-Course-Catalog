<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Course') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                        {{ __('Course deletion successful.') }}
                    </h2>
                    <p class="text-lg text-gray-600 dark:text-gray-400" id="timer">
                        {{ __('You will be redirected in 3 seconds...') }}
                    </p>
                </div>
            </div>
        </div>
    </div>
    <script>
        let seconds = 3;
        const myElement = document.getElementById('timer');

        const interval = setInterval(() => {
            seconds--;
            myElement.textContent = `You will be redirected in ${seconds} seconds...`;
            if (seconds === 0) {
                clearInterval(interval);
                window.location.href = "{{ route('dashboard') }}";
            }
        }, 1000);
    </script>
</x-app-layout>
