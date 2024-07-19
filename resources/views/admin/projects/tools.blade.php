<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Project Tools') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-col p-10 overflow-hidden bg-white shadow-sm sm:rounded-lg gap-y-5">

                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="w-full px-5 py-3 text-white bg-red-500 rounded-3xl">
                            {{ $error }}
                        </div>
                    @endforeach
                @endif

                <div class="flex flex-row justify-between item-card gap-y-10 md:items-center">
                    <div class="flex flex-row items-center gap-x-3">
                        <img src="{{ Storage::url($project->thumbnail) }}" alt=""
                            class="rounded-2xl object-cover w-[120px] h-[90px]">
                        <div class="flex flex-col">
                            <h3 class="text-xl font-bold text-indigo-950">{{ $project->name }}</h3>
                            <p class="text-sm text-slate-500">{{ $project->category->name }}</p>
                        </div>
                    </div>
                </div>
                <hr class="my-5">

                <h3 class="text-xl font-bold text-indigo-950">Add Tools</h3>

                <form method="POST" action="{{ route('admin.projects.tools.store', $project->id) }}"
                    enctype="multipart/form-data">
                    @csrf

                    <div>
                        <x-input-label for="tools" :value="__('tools')" />

                        <select name="tool_id" id="tool_id"
                            class="w-full py-3 pl-3 border rounded-lg border-slate-300">
                            <option value="">Choose Tool</option>
                            @foreach ($tools as $tool)
                                <option value="{{ $tool->id }}">{{ $tool->name }}</option>
                            @endforeach
                        </select>

                        <x-input-error :messages="$errors->get('category')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end mt-4">

                        <button type="submit" class="px-6 py-4 font-bold text-white bg-indigo-700 rounded-full">
                            Add Tool
                        </button>
                    </div>
                </form>

                <hr class="my-5">

                <h3 class="text-xl font-bold text-indigo-950">Tools</h3>

                @forelse ($project->tools as $tool)
                    <div class="flex flex-row justify-between bg-red">
                        <div class="flex flex-row items-center gap-x-3">
                            <img src="{{ Storage::url($tool->icon) }}" alt=""
                                class="rounded-2xl object-cover w-[90px] h-[90px]">
                            <div class="flex flex-col">
                                <h3 class="text-xl font-bold text-indigo-950">{{ $tool->name }}</h3>
                            </div>
                        </div>
                        <div class="flex flex-row items-center gap-x-3">
                            <form action="{{ route('admin.project_tools.destroy', $tool->pivot->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-6 py-4 font-bold text-white bg-red-700 rounded-full">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>

                @empty
                    <p>Belum ada tools pada projek ini</p>
                @endforelse

            </div>
        </div>
    </div>
</x-app-layout>
