<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('My Proposals') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="flex flex-col p-10 overflow-hidden bg-white shadow-sm sm:rounded-lg gap-y-5">

                @forelse (Auth::user()->proposals as $proposal)
                    <div class="flex flex-col justify-between item-card md:flex-row gap-y-10 md:items-center">
                        <div class="flex flex-row items-center gap-x-3">
                            <img src="{{ Storage::url($proposal->project->thumbnail) }}" alt=""
                                class="rounded-2xl object-cover w-[120px] h-[90px]">
                            <div class="flex flex-col">
                                <h3 class="text-xl font-bold text-indigo-950">{{ $proposal->project->name }}</h3>
                                <p class="text-sm text-slate-500">{{ $proposal->project->category->name }}</p>
                            </div>
                        </div>

                        <div class="flex-col hidden md:flex">
                            <p class="text-sm text-slate-500">Budget</p>
                            <h3 class="text-xl font-bold text-indigo-950">Rp
                                {{ number_format($proposal->project->budget, 0, ',', '.') }}</h3>
                        </div>

                        <div class="flex-col hidden md:flex">
                            <p class="text-sm text-slate-500">Applied at</p>
                            <h3 class="text-xl font-bold text-indigo-950">
                                {{ $proposal->project->created_at->format('D m Y') }}</h3>
                        </div>

                        <div class="flex-row items-center hidden md:flex gap-x-3">
                            <a href="{{ route('dashboard.proposal_details', [$proposal->project, $proposal->id]) }}"
                                class="px-6 py-4 font-bold text-white bg-indigo-700 rounded-full">
                                Details
                            </a>
                        </div>
                    </div>

                @empty
                    <p>Anda belum mengirimkan sebuah proposal</p>
                @endforelse

            </div>
        </div>
    </div>
</x-app-layout>
