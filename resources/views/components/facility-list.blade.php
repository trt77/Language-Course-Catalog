@props(['facilities'])

<div class="flex flex-col md:flex-row">
    <div class="w-full md:w-1/2 p-4">
        <div class="w-full overflow-hidden rounded-lg shadow-md">
            <div class="w-full overflow-x-auto table-scroll">
                <table class="w-full bg-white dark:bg-gray-900">
                    <thead>
                    <tr class="text-gray-400 dark:text-gray-300 text-left text-sm leading-4 tracking-wide uppercase bg-gray-800 dark:bg-gray-400">
                        <th class="px-4 py-2">
                            <a href="{{ route('facilities.index', array_merge(request()->except(['sort', 'order']), ['sort' => 'name', 'order' => request('sort') === 'name' && request('order') === 'asc' ? 'desc' : 'asc'])) }}">Name &uarr;&darr;</a>
                        </th>
                        <th class="px-4 py-2">
                            <a href="{{ route('facilities.index', array_merge(request()->except(['sort', 'order']), ['sort' => 'address', 'order' => request('sort') === 'address' && request('order') === 'asc' ? 'desc' : 'asc'])) }}">Address &uarr;&darr;</a>
                        </th>
                        @auth
                            <th class="px-4 py-2">Actions</th>
                        @endauth
                    </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200">
                    @foreach($facilities as $facility)
                        <tr class="{{ $loop->iteration % 2 == 0 ? 'bg-gray-400 dark:bg-gray-300' : 'bg-gray-100 dark:bg-gray-700' }}">
                            <td class="px-4 py-2 whitespace-nowrap text-gray-400">{{ $facility->name }}</td>
                            <td class="px-4 py-2 whitespace-nowrap text-gray-400">{{ $facility->address }}</td>
                            @auth
                                <td class="px-4 py-2 whitespace-nowrap text-gray-200">
                                    @if(auth()->user()->isAdmin())
                                        <a href="{{ route('facilities.edit', $facility) }}" class="bg-green-500 hover:bg-green-700 text-white py-2 px-4 rounded">Update</a>
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
