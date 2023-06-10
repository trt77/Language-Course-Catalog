@props(['courses'])

<div class="flex flex-col md:flex-row">
    <div class="w-full md:w-1/2 p-4">
        <div class="w-full overflow-hidden rounded-lg shadow-md">
            <div class="w-full overflow-x-auto table-scroll">
                <table class="w-full bg-white dark:bg-gray-900">
                    <thead>
                    <tr class="text-gray-400 dark:text-gray-300 text-left text-sm leading-4 tracking-wide uppercase bg-gray-800 dark:bg-gray-400">
                        <th class="px-4 py-2">
                            <a href="{{ route('courses.mySort', array_merge(request()->except(['sort', 'order']), ['sort' => 'name', 'order' => request('sort') === 'name' && request('order') === 'asc' ? 'desc' : 'asc'])) }}">Name &uarr;&darr;</a>
                        </th>
                        <th class="px-4 py-2">
                            <a href="{{ route('courses.mySort', array_merge(request()->except(['sort', 'order']), ['sort' => 'level', 'order' => request('sort') === 'level' && request('order') === 'asc' ? 'desc' : 'asc'])) }}">Level &uarr;&darr;</a>
                        </th>
                        <th class="px-4 py-2">
                            <a href="{{ route('courses.mySort', array_merge(request()->except(['sort', 'order']), ['sort' => 'language', 'order' => request('sort') === 'language' && request('order') === 'asc' ? 'desc' : 'asc'])) }}">Language &uarr;&darr;</a>
                        </th>
                        <th class="px-4 py-2">Taught by</th>
                        @auth
                            <th class="px-4 py-2 w-1/3">Actions</th>
                        @endauth
                    </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200">
                    @foreach($courses as $course)
                        <tr class="{{ $loop->iteration % 2 == 0 ? 'bg-gray-400 dark:bg-gray-300' : 'bg-gray-100 dark:bg-gray-700' }}">
                            <td class="px-4 py-2 whitespace-nowrap text-gray-400">{{ $course->name }}</td>
                            <td class="px-4 py-2 whitespace-nowrap text-gray-400">{{ $course->level }}</td>
                            <td class="px-4 py-2 whitespace-nowrap text-gray-400">{{ $course->language }}</td>
                            <td class="px-4 py-2 whitespace-nowrap">
                                @if($course->teacher)
                                    <span class="text-gray-400">{{ $course->teacher->name }} {{ $course->teacher->surname }}</span>
                                @else
                                    <span style="color:coral">Not yet assigned</span>
                                @endif
                            </td>
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
            <h2 class="text-xl font-semibold mb-2">Welcome to your personal Course Dashboard!</h2>
            <p>Here, you'll find a compact table listing all your courses. Check out the course names, the instructors, and other relevant details at a glance! Decided that a course isn't right for you? No problem. Each course in your list comes with a 'Quit Course' option. Click it, and you're out. Remember, learning is about enjoying the journey, so feel free to pick what suits you best. Found a course you absolutely love? Give it a star! Starring a course adds it to your 'Favorites'. You can quickly access your starred courses anytime from the 'Favorites' tab at the top of the page. It's a great way to keep track of the courses that resonate with you the most. Want more details on a course? Click on the course name to go to its dedicated page. Here, you'll find comprehensive information about the course.</p>
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
