@props(['users'])

<div class="flex flex-col md:flex-row">
    <div class="w-full md:w-1/2 p-4">
        <div class="w-full overflow-hidden rounded-lg shadow-md">
            <div class="w-full overflow-x-auto table-scroll">
                <table class="w-full bg-white dark:bg-gray-900">
                    <thead>
                    <tr class="text-gray-400 dark:text-gray-300 text-left text-sm leading-4 tracking-wide uppercase bg-gray-800 dark:bg-gray-400">
                        <th class="px-4 py-2">Name</th>
                        <th class="px-4 py-2">Email</th>
                        <th class="px-4 py-2">Role</th>
                        @auth
                            <th class="px-4 py-2">Actions</th>
                        @endauth
                    </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200">
                    @foreach($users as $user)
                        <tr class="{{ $loop->iteration % 2 == 0 ? 'bg-gray-400 dark:bg-gray-300' : 'bg-gray-100 dark:bg-gray-700' }}">
                            <td class="px-4 py-2 whitespace-nowrap text-gray-400">{{ $user->name }}</td>
                            <td class="px-4 py-2 whitespace-nowrap text-gray-400">{{ $user->email }}</td>
                            <td class="px-4 py-2 whitespace-nowrap text-gray-400">{{ $user->role }}</td>
                            @auth
                                <td class="px-4 py-2 whitespace-nowrap text-gray-200">
                                    @if(auth()->user()->isAdmin())
                                        <a href="{{ route('users.edit', $user) }}" class="bg-green-500 hover:bg-green-700 text-white py-2 px-4 rounded">Update</a>
                                        <a href="{{ route('attended-by-user', $user) }}" class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded">View Attended Courses</a>
                                        <a href="{{ route('favourited-by-user', $user) }}" class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded">View Favourite Courses</a>
                                        <form action="{{ route('users.destroy', $user) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white py-1 px-2 rounded">Delete</button>
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
        <div class="text-gray-200 dark:text-gray-300">
            <h2 class="text-xl font-semibold mb-2">User Management System - Administrative Dashboard</h2>
            <p>
                In the "Manage Users" view, administrators can maintain a smooth user experience. This control panel enables modifications to user information, ensuring profiles stay current and accurate. Plus, if needed, admins can completely remove user accounts along with all their data.
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
