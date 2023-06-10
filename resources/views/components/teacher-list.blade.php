@props(['teachers'])

<div class="flex flex-col md:flex-row">
    <div class="w-full md:w-1/2 p-4">
        <div class="w-full overflow-hidden rounded-lg shadow-md">
            <div class="w-full overflow-x-auto table-scroll">
                <table class="w-full bg-white dark:bg-gray-900">
                    <thead>
                    <tr class="text-gray-400 dark:text-gray-300 text-left text-sm leading-4 tracking-wide uppercase bg-gray-800 dark:bg-gray-400">
                        <th class="px-4 py-2">
                            <a href="{{ route('teachers.index', array_merge(request()->except(['sort', 'order']), ['sort' => 'name', 'order' => request('sort') === 'name' && request('order') === 'asc' ? 'desc' : 'asc'])) }}">Name &uarr;&darr;</a>
                        </th>
                        <th class="px-4 py-2">
                            <a href="{{ route('teachers.index', array_merge(request()->except(['sort', 'order']), ['sort' => 'surname', 'order' => request('sort') === 'surname' && request('order') === 'asc' ? 'desc' : 'asc'])) }}">Surname &uarr;&darr;</a>
                        </th>
                        <th class="px-4 py-2">
                            <a href="{{ route('teachers.index', array_merge(request()->except(['sort', 'order']), ['sort' => 'education', 'order' => request('sort') === 'education' && request('order') === 'asc' ? 'desc' : 'asc'])) }}">Education &uarr;&darr;</a>
                        </th>
                        <th class="px-4 py-2">Phone</th>
                        <th class="px-4 py-2">
                            <a href="{{ route('teachers.index', array_merge(request()->except(['sort', 'order']), ['sort' => 'email', 'order' => request('sort') === 'email' && request('order') === 'asc' ? 'desc' : 'asc'])) }}">Email &uarr;&darr;</a>
                        </th>
                        @auth
                            <th class="px-4 py-2">Actions</th>
                        @endauth
                    </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200">
                    @foreach($teachers as $teacher)
                        <tr class="{{ $loop->iteration % 2 == 0 ? 'bg-gray-400 dark:bg-gray-300' : 'bg-gray-100 dark:bg-gray-700' }}">
                            <td class="px-4 py-2 whitespace-nowrap text-gray-400">{{ $teacher->name }}</td>
                            <td class="px-4 py-2 whitespace-nowrap text-gray-400">{{ $teacher->surname }}</td>
                            <td class="px-4 py-2 whitespace-nowrap text-gray-400">{{ $teacher->education }}</td>
                            <td class="px-4 py-2 whitespace-nowrap text-gray-400">{{ $teacher->phone }}</td>
                            <td class="px-4 py-2 whitespace-nowrap text-gray-400">{{ $teacher->email }}</td>
                            @auth
                                <td class="px-4 py-2 whitespace-nowrap text-gray-200">
                                    <a href="{{ route('teachers.show', $teacher) }}" class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded">Teacher's Page</a>
                                    @if(auth()->user()->isAdmin())
                                        <a href="{{ route('teachers.edit', $teacher) }}" class="bg-green-500 hover:bg-green-700 text-white py-2 px-4 rounded">Update</a>
                                    @endif
                                </td>
                            @endauth
                        </tr>
                    @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>
    <div class="w-full md:w-1/2 p-4">
        <div class="text-gray-200 dark:text-gray-300">
            <h2 class="text-xl font-semibold mb-2">Welcome to the Teachers Directory!</h2>
            <p>This is your go-to resource for exploring all the instructors. The table here lists all our teachers, along with key information about them. You can quickly check out their names, education background and contact details. Want to arrange the teachers by name, surname, education, or email? No problem! You can sort the table with a simple click on the column headers. Look for the ↑↓ symbols next to the column names. Want to learn more about a particular teacher? Each teacher in the list comes with a 'Teacher's Page' link under 'Actions'. Click it to navigate to their dedicated page, where you can view more detailed information about them and the courses they teach. Take your time to get to know our teachers. Explore their profiles, see what courses they offer, and make your learning journey better by choosing the instructors who resonate with you the most.
            </p>
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
