<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('New Course Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Enter the new course's information.") }}
        </p>
    </header>

    <form method="post" action="{{ route('courses.store') }}" class="mt-6 space-y-6">
        @csrf

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name')" required autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="level" :value="__('Level')" />
            <x-text-input id="level" name="level" type="text" class="mt-1 block w-full" :value="old('level')" required autocomplete="level" />
            <x-input-error class="mt-2" :messages="$errors->get('level')" />
        </div>

        <div>
            <x-input-label for="language" :value="__('Language')" />
            <x-text-input id="language" name="language" type="text" class="mt-1 block w-full" :value="old('language')" required autocomplete="language" />
            <x-input-error class="mt-2" :messages="$errors->get('language')" />
        </div>

        <div>
            <x-input-label for="teacher_id" :value="__('Teacher')" />

            <select id="teacher_id" name="teacher_id" class="mt-1 block w-full">
                <option value="">{{ __('Select a teacher...') }}</option>
                <option value="null">{{ __('(None)') }}</option>
                @foreach ($teachers as $teacher)
                    <option value="{{ $teacher->id }}">{{ $teacher->name }} {{ $teacher->surname }} - email:&nbsp {{ $teacher->email }}</option>
                @endforeach
            </select>

            <x-input-error class="mt-2" :messages="$errors->get('teacher_id')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'course-created')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Course Created Successfully.') }}</p>
            @endif
        </div>
    </form>
</section>
