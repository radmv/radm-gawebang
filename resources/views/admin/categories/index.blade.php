<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Manage Categories') }}
            </h2>
            <a href="{{ route('admin.categories.create') }}"
                class="px-6 py-4 font-bold text-white bg-indigo-700 rounded-full">
                Add New
            </a>
        </div>
    </x-slot>

    <x-content-container>
        <x-table>
            <x-table.thead>
                <tr>
                    <x-table.th>#</x-table.th>
                    <x-table.th>Name</x-table.th>
                    <x-table.th>Date</x-table.th>
                    <x-table.th></x-table.th>
                </tr>
            </x-table.thead>
            <x-table.tbody>
                @foreach ($categories as $category)
                    <tr>
                        <x-table.td>
                            <img src="{{ Storage::url($category->icon) }}" alt=""
                                class="rounded-2xl object-cover w-[90px] h-[90px]">
                        </x-table.td>
                        <x-table.td>
                            <h3 class="text-xl font-bold text-indigo-950">{{ $category->name }}</h3>
                        </x-table.td>
                        <x-table.td>
                            <h3 class="text-xl font-bold text-indigo-950">
                                {{ $category->created_at->format('M d, Y') }}
                            </h3>
                        </x-table.td>
                        <x-table.td>
                            <div class="flex-row items-center justify-end hidden md:flex gap-x-3">
                                <a href="{{ route('admin.categories.edit', $category) }}"
                                    class="px-6 py-4 font-bold text-white bg-indigo-700 rounded-full">
                                    Edit
                                </a>
                                <form action="{{ route('admin.categories.destroy', $category) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="px-6 py-4 font-bold text-white bg-red-700 rounded-full">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </x-table.td>
                    </tr>
                @endforeach
            </x-table.tbody>
        </x-table>
        <div class="mt-6">
            {{ $categories->links() }}
        </div>
    </x-content-container>
</x-app-layout>
