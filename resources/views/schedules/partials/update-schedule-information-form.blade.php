<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Course Schedule Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Update this course's schedule information.") }}
        </p>
    </header>

    <form method="post"
          action="{{ $course->schedule ? route('schedules.update', $course) : route('schedules.store', $course) }}"
          class="mt-6 space-y-6">
        @csrf
        @if ($course->schedule)
            @method('put')
        @endif

        <div>
            <x-input-label for="start_date" :value="__('Start Date')" />
            <x-text-input id="start_date" name="start_date" type="date" class="mt-1 block w-full" :value="old('start_date', optional($course->schedule)->start_date)" required />
            <x-input-error class="mt-2" :messages="$errors->get('start_date')" />
        </div>

        <div>
            <x-input-label for="end_date" :value="__('End Date')" />
            <x-text-input id="end_date" name="end_date" type="date" class="mt-1 block w-full" :value="old('end_date', optional($course->schedule)->end_date)" required />
            <x-input-error class="mt-2" :messages="$errors->get('end_date')" />
        </div>

        <div>
            <x-input-label for="time" :value="__('Time')" />
            <x-text-input id="time" name="time" type="time" class="mt-1 block w-full" :value="old('time', optional($course->schedule)->time)" required />
            <x-input-error class="mt-2" :messages="$errors->get('time')" />
        </div>

        <div>
            <x-input-label for="duration" :value="__('Duration in minutes')" />
            <x-text-input id="duration" name="duration" type="number" class="mt-1 block w-full" :value="old('duration', optional($course->schedule)->duration)" required />
            <x-input-error class="mt-2" :messages="$errors->get('duration')" />
        </div>

        <div>
            <x-input-label for="days_of_week" :value="__('Days of Week')" />

            @php
                $days = ['mon', 'tue', 'wed', 'thu', 'fri', 'sat', 'sun'];
                $selectedDays = (array) old('days_of_week', optional($course->schedule)->days_of_week);
            @endphp

            @foreach ($days as $day)
                <div>
                    <input id="{{ $day }}" name="days_of_week[]" type="checkbox" value="{{ $day }}" {{ in_array($day, $selectedDays) ? 'checked' : '' }}/>
                    <label class="text-gray-400" for="{{ $day }}">{{ ucfirst($day) }}</label>
                </div>
            @endforeach

            <x-input-error class="mt-2" :messages="$errors->get('days_of_week')" />
        </div>


        <div>
            <x-input-label for="facility_id" :value="__('Facility')" />

            <select id="facility_id" name="facility_id" class="mt-1 block w-full">
                <option value="">{{ __('Select a facility...') }}</option>
                @foreach ($facilities as $facility)
                    <option value="{{ $facility->id }}" {{ old('facility_id', optional($course->schedule)->facility_id) == $facility->id ? 'selected' : '' }}>{{ $facility->name }} - {{ $facility->address }}</option>
                @endforeach
            </select>

            <x-input-error class="mt-2" :messages="$errors->get('facility_id')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'schedule-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
