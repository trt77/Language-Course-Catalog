<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight text-center">
            {{ __('Welcome to the Language Course Catalog') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 bg-dots-darker">
            <div class="filter-container bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6 mt-6 grid grid-cols-2 gap-6 md:grid-cols-4">

                <div class="mx-auto w-full sm:mx-4 md:mx-8 lg:mx-16">
                    <button id="toggleButton" class="btn-blue rounded-lg" onclick="toggleForm()">Toggle Filters</button>
                </div>

                <div id="filterForm" style="display: none;">
                    <div class=" px-4 py-2">
                        <form method="GET" action="{{ route('courses.index') }}" class="col-span-2 md:col-span-4">
                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                                <div>
                                    <label for="teacher" class="dark:text-gray-200">Teacher:</label>
                                    <select name="teacher" id="teacher">
                                        <option value="">Select a teacher</option>
                                        @foreach ($teachers as $teacher)
                                            <option value="{{ $teacher->id }}">{{ $teacher->name }} {{ $teacher->surname }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label for="facility" class="dark:text-gray-200">Facility:</label>
                                    <select name="facility" id="facility">
                                        <option value="">Select a facility</option>
                                        @foreach ($facilities as $facility)
                                            <option value="{{ $facility->id }}">{{ $facility->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label for="level" class="dark:text-gray-200">Level:</label>
                                    <input type="text" name="level" id="level" placeholder="Enter course level">
                                </div>
                                <div>
                                    <label for="language" class="dark:text-gray-200">Language:</label>
                                    <input type="text" name="language" id="language" placeholder="Enter course language">
                                </div>
                                <div>
                                    <label for="name" class="dark:text-gray-200">Name:</label>
                                    <input type="text" name="name" id="name" placeholder="Enter course name">
                                </div>
                                <div>
                                    <label for="start_date" class="dark:text-gray-200">Start Date:</label>
                                    <input type="date" name="start_date" id="start_date">
                                </div>
                                <div>
                                    <label for="end_date" class="dark:text-gray-200">End Date:</label>
                                    <input type="date" name="end_date" id="end_date">
                                </div>
                                <div>
                                    <span class="dark:text-gray-200">Days of Week:</span>
                                    <div class="grid grid-cols-2 md:grid-cols-4 gap-2 mt-2 text-gray-400">
                                        <label for="mon"><input type="checkbox" id="mon" name="days_of_week[]" value="mon"> Mon</label>
                                        <label for="tue"><input type="checkbox" id="tue" name="days_of_week[]" value="tue"> Tue</label>
                                        <label for="wed"><input type="checkbox" id="wed" name="days_of_week[]" value="wed"> Wed</label>
                                        <label for="thu"><input type="checkbox" id="thu" name="days_of_week[]" value="thu"> Thu</label>
                                        <label for="fri"><input type="checkbox" id="fri" name="days_of_week[]" value="fri"> Fri</label>
                                        <label for="sat"><input type="checkbox" id="sat" name="days_of_week[]" value="sat"> Sat</label>
                                        <label for="sun"><input type="checkbox" id="sun" name="days_of_week[]" value="sun"> Sun</label>
                                    </div>
                                </div>
                                <div>
                                    <label for="exclusively" class="dark:text-gray-200">
                                        <input type="checkbox" id="exclusively" name="exclusively"> Find courses that take place exclusively on the weekdays selected
                                    </label>
                                </div>
                                <div class="text-right mt-2">
                                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded">Sort</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
            <x-course-list :courses="$courses" />
        </div>
    </div>
</x-app-layout>

<style>

    .invisible {
        --tw-bg-opacity: 1;
        background-color: rgb(17 24 39 / var(--tw-bg-opacity));
    }

    .non-invisible {
        --tw-bg-opacity: 1;
        background-color: rgb(31 41 55 / var(--tw-bg-opacity));
    }

    .btn-blue {
        background-color: rgba(10, 224, 224, 0.36);
        border: none;
        color: white;
        padding: 15px 32px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 4px 2px;
        cursor: pointer;
    }
</style>

<script>
    function toggleForm() {
        var form = document.getElementById('filterForm');
        if (form.style.display === "none") {
            form.style.display = "block";
        } else {
            form.style.display = "none";
        }
    }
</script>
