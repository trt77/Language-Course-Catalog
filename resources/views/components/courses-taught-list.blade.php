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
                                        <form action="{{ auth()->user()->favourites->contains($course->id) ? route('favourites.destroy', $course) : route('favourites.store', $course) }}" method="POST" class="inline">
                                            @csrf
                                            @if (auth()->user()->favourites->contains($course->id))
                                                @method('DELETE')
                                                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white py-2 px-4 rounded">Take star</button><a href="{{ route('courses.show', $course) }}" class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded">Course Page</a>
                                            @else
                                                <button type="submit" class="bg-green-500 hover:bg-green-700 text-white py-2 px-4 rounded">Give star</button><a href="{{ route('courses.show', $course) }}" class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded">Course Page</a>
                                            @endif
                                        </form>
                                        <a href="{{ route('courses.edit', $course) }}" class="bg-green-500 hover:bg-green-700 text-white py-2 px-4 rounded">Update</a>
                                        <a href="{{ route('schedules.edit', $course) }}" class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded">Set Schedule</a>
                                    @else
                                        <form action="{{ auth()->user()->favourites->contains($course->id) ? route('favourites.destroy', $course) : route('favourites.store', $course) }}" method="POST" class="inline">
                                            @csrf
                                            @if (auth()->user()->favourites->contains($course->id))
                                                @method('DELETE')
                                                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white py-2 px-4 rounded">Take star</button><a href="{{ route('courses.show', $course) }}" class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded">Course Page</a>
                                            @else
                                                <button type="submit" class="bg-green-500 hover:bg-green-700 text-white py-2 px-4 rounded">Give star</button><a href="{{ route('courses.show', $course) }}" class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded">Course Page</a>
                                            @endif
                                        </form>
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
                                    <a href="{{ route('login-redirect') }}" class="bg-green-500 hover:bg-green-700 text-white py-2 px-4 rounded">Give star</a>
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
