@props(['courses'])

<div class="flex flex-col md:flex-row">
    <div class="w-full md:w-1/2 p-4">
        <div class="w-full overflow-hidden rounded-lg shadow-md">
            <div class="w-full overflow-hidden rounded-lg shadow-md table-scroll">
                <table class="w-full bg-white dark:bg-gray-900">
                    <thead>
                    <tr class="text-gray-400 dark:text-gray-300 text-left text-sm leading-4 tracking-wide uppercase bg-gray-800 dark:bg-gray-400">
                        <th class="px-4 py-2">
                            @auth
                                <a href="{{ route('courses.index', array_merge(request()->except(['sort', 'order']), ['sort' => 'name', 'order' => request('sort') === 'name' && request('order') === 'asc' ? 'desc' : 'asc'])) }}">Name &uarr;&darr;</a>
                            @else
                                <a href="{{ route('welcome.sort', array_merge(request()->except(['field', 'order']), ['field' => 'name', 'order' => request('field') === 'name' && request('order') === 'asc' ? 'desc' : 'asc'])) }}">Name &uarr;&darr;</a>
                            @endauth
                        </th>
                        <th class="px-4 py-2">
                            @auth
                                <a href="{{ route('courses.index', array_merge(request()->except(['sort', 'order']), ['sort' => 'level', 'order' => request('sort') === 'level' && request('order') === 'asc' ? 'desc' : 'asc'])) }}">Level &uarr;&darr;</a>
                            @else
                                <a href="{{ route('welcome.sort', array_merge(request()->except(['field', 'order']), ['field' => 'level', 'order' => request('field') === 'level' && request('order') === 'asc' ? 'desc' : 'asc'])) }}">Level &uarr;&darr;</a>
                            @endauth
                        </th>
                        <th class="px-4 py-2">
                            @auth
                                <a href="{{ route('courses.index', array_merge(request()->except(['sort', 'order']), ['sort' => 'language', 'order' => request('sort') === 'language' && request('order') === 'asc' ? 'desc' : 'asc'])) }}">Language &uarr;&darr;</a>
                            @else
                                <a href="{{ route('welcome.sort', array_merge(request()->except(['field', 'order']), ['field' => 'language', 'order' => request('field') === 'language' && request('order') === 'asc' ? 'desc' : 'asc'])) }}">Language &uarr;&darr;</a>
                            @endauth
                        </th>

                        <th class="px-4 py-2">Stars</th>
                        @auth
                            <th class="px-4 py-2 w-1/3">Actions</th>
                        @else
                            <th class="px-4 py-2 w-1/3">Log in to access these functions!</th>
                        @endauth
                    </tr>

                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200">
                    @foreach($courses as $course)
                        <tr class="{{ $loop->iteration % 2 == 0 ? 'bg-gray-400 dark:bg-gray-300' : 'bg-gray-100 dark:bg-gray-700' }}">
                            <td class="px-4 py-2 whitespace-nowrap text-gray-400">{{ $course->name }}</td>
                            <td class="px-4 py-2 whitespace-nowrap text-gray-400">{{ $course->level }}</td>
                            <td class="px-4 py-2 whitespace-nowrap text-gray-400">{{ $course->language }}</td>
                            <td class="px-4 py-2 whitespace-nowrap text-gray-400">{{ $course->users_count }}</td>
                            @auth
                                <td class="px-4 py-2 whitespace-nowrap text-gray-200 flex justify-around">
                                    @if(auth()->user()->isAdmin())
                                        <a href="{{ route('courses.edit', $course) }}" class="bg-green-500 hover:bg-green-700 text-white py-2 px-4 rounded">Update</a>
                                        <a href="{{ route('schedules.edit', $course) }}" class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded">Set Schedule</a>
                                        <form action="{{ auth()->user()->favourites->contains($course->id) ? route('favourites.destroy', $course) : route('favourites.store', $course) }}" method="POST" class="inline">
                                            @csrf
                                            @if (auth()->user()->favourites->contains($course->id))
                                                @method('DELETE')
                                                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white py-2 px-4 rounded">Take star</button>
                                            @else
                                                <button type="submit" class="bg-green-500 hover:bg-green-700 text-white py-2 px-4 rounded">Give star</button>
                                            @endif
                                        </form>
                                        <a href="{{ route('courses.show', $course) }}" class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded">Course Page</a>
                                        @if($course->teacher)
                                            <a href="{{ route('teachers.show', $course->teacher->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded">Teacher's Page</a>
                                        @else
                                            <span class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded" style="color: coral">No teacher set</span>
                                        @endif
                                    @else
                                        <form action="{{ auth()->user()->favourites->contains($course->id) ? route('favourites.destroy', $course) : route('favourites.store', $course) }}" method="POST" class="inline">
                                            @csrf
                                            @if (auth()->user()->favourites->contains($course->id))
                                                @method('DELETE')
                                                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white py-2 px-4 rounded">Take star</button>
                                            @else
                                                <button type="submit" class="bg-green-500 hover:bg-green-700 text-white py-2 px-4 rounded">Give star</button>
                                            @endif
                                        </form>
                                        <a href="{{ route('courses.show', $course) }}" class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded">Course Page</a>
                                        @if($course->teacher)
                                            <a href="{{ route('teachers.show', $course->teacher->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded">Teacher's Page</a>
                                        @else
                                            <span class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded" style="color: coral">No teacher set</span>
                                        @endif
                                    @endif
                                        @if(auth()->user()->courses->contains($course))
                                            <form action="{{ route('enrollments.destroy', $course) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white py-2 px-4 rounded">Quit</button>
                                            </form>
                                        @else
                                            <form action="{{ route('enrollments.store', $course) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="bg-green-500 hover:bg-green-700 text-white py-2 px-4 rounded">Enroll</button>
                                            </form>
                                        @endif


                                </td>
                            @else
                                <td class="px-4 py-2 whitespace-nowrap text-gray-200 flex justify-around">
                                    <a href="{{ route('login-redirect') }}" class="bg-green-500 hover:bg-green-700 text-white py-2 px-4 rounded">Favourite</a>
                                    <a href="{{ route('login-redirect') }}" class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded">Course Page</a>
                                    <a href="{{ route('login-redirect') }}" class="bg-green-500 hover:bg-green-700 text-white py-2 px-4 rounded">Enroll</a>
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
        <!-- Description section -->
        <div class="text-gray-200 dark:text-gray-300">
            <h2 class="text-xl font-semibold mb-2">Language Course Selection</h2>
            <p>This is our course list. Here, you can browse through a comprehensive list of all available language courses, along with their star rating (the number of users who added the course to their favourites. The courses can be sorted by their name, level, or language for your convenience. As a logged in user, you have the ability to add courses to your favourites, enroll in courses, or quit from enrolled ones. Each course has a dedicated Course Page, where you can access details about the course.</p>
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
