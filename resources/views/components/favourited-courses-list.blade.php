@props(['courses'])

<div class="flex flex-col md:flex-row">
    <div class="w-full md:w-1/2 p-4">
        <div class="w-full overflow-hidden rounded-lg shadow-md">
            <div class="w-full overflow-hidden rounded-lg shadow-md table-scroll">
                <table class="w-full bg-white dark:bg-gray-900">
                    <thead>
                    <tr class="text-gray-400 dark:text-gray-300 text-left text-sm leading-4 tracking-wide uppercase bg-gray-800 dark:bg-gray-400">
                        <th class="px-4 py-2">Name</th>
                        <th class="px-4 py-2">Level</th>
                        <th class="px-4 py-2">Language</th>
                        <th class="px-4 py-2">Stars</th>
                        <th class="px-4 py-2 w-1/3">Actions</th>
                    </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200">
                    @foreach($courses as $course)
                        <tr class="{{ $loop->iteration % 2 == 0 ? 'bg-gray-400 dark:bg-gray-300' : 'bg-gray-100 dark:bg-gray-700' }}">
                            <td class="px-4 py-2 whitespace-nowrap text-gray-400">{{ $course->name }}</td>
                            <td class="px-4 py-2 whitespace-nowrap text-gray-400">{{ $course->level }}</td>
                            <td class="px-4 py-2 whitespace-nowrap text-gray-400">{{ $course->language }}</td>
                            <td class="px-4 py-2 whitespace-nowrap text-gray-400">{{ $course->users_count }}</td>
                            <td class="px-4 py-2 whitespace-nowrap text-gray-200 flex justify-around">
                                <a href="{{ route('courses.edit', $course) }}" class="bg-green-500 hover:bg-green-700 text-white py-2 px-4 rounded">Update</a>
                                <a href="{{ route('schedules.edit', $course) }}" class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded">Set Schedule</a>
                                <a href="{{ route('courses.show', $course) }}" class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded">Course Page</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<style>
    .table-scroll {
        overflow-x: auto;
        overflow-y: auto;
        max-height: 400px;
        display: inline-block;
        white-space: nowrap;
    }
</style>
