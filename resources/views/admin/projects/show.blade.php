<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Project Details') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
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
                    <div class="flex flex-row items-center gap-x-3">
                        <a href="{{ route('front.details', $project->slug) }}"
                            class="px-6 py-4 font-bold text-white bg-orange-500 rounded-full">
                            Preview
                        </a>
                        <a href="{{ route('admin.projects.tools', $project) }}"
                            class="px-6 py-4 font-bold text-white bg-indigo-700 rounded-full">
                            Add Tools
                        </a>
                    </div>


                </div>

                <hr class="my-5">

                <h3 class="text-xl font-bold text-indigo-950">Applicants</h3>

                @forelse ($project->applicants as $applicant)
                    <div class="flex flex-row items-center justify-between">
                        <div class="flex flex-row items-center gap-x-3">
                            <img src="{{ Storage::url($applicant->freelancer->avatar) }}" alt=""
                                class="rounded-full object-cover w-[70px] h-[70px]">
                            <div class="flex flex-col">
                                <h3 class="text-xl font-bold text-indigo-950">{{ $applicant->freelancer->name }}</h3>
                                <p class="text-sm text-slate-500">{{ $applicant->freelancer->occupation }}</p>
                            </div>
                        </div>

                        @if ($applicant->status == 'Hired')
                            <span class="px-3 py-2 text-sm font-bold text-white bg-green-500 rounded-full w-fit">
                                HIRED
                            </span>
                        @elseif($applicant->status == 'Waiting')
                            <span class="px-3 py-2 text-sm font-bold text-white bg-orange-500 rounded-full w-fit">
                                WAITING FOR APPROVAL
                            </span>
                        @elseif($applicant->status == 'Rejected')
                            <span class="px-3 py-2 text-sm font-bold text-white bg-red-500 rounded-full w-fit">
                                REJECTED
                            </span>
                        @endif

                        <div class="flex flex-row items-center gap-x-3">
                            <a href="{{ route('admin.project_applicants.show', $applicant) }}"
                                class="px-6 py-4 font-bold text-white bg-indigo-700 rounded-full">
                                Details
                            </a>
                        </div>
                    </div>

                @empty
                    <p>Belum ada applicant yang tertarik pada projek ini</p>
                @endforelse

            </div>
        </div>
    </div>
</x-app-layout>
