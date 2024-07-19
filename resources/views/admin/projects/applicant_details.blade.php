<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Applicant Details') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-col p-10 overflow-hidden bg-white shadow-sm sm:rounded-lg gap-y-5">

                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="w-full px-5 py-3 text-white bg-red-500 rounded-3xl">
                            {{ $error }}
                        </div>
                    @endforeach
                @endif

                @if ($projectApplicant->project->has_finished)
                    <span class="w-full p-5 font-bold text-white bg-green-500 rounded-2xl">
                        Projek telah selesai, Revenue sudah diberikan kepada Freelancer
                    </span>
                @endif

                <div class="flex flex-row justify-between item-card gap-y-10 md:items-center">
                    <div class="flex flex-row items-center gap-x-3">
                        <img src="{{ Storage::url($projectApplicant->project->thumbnail) }}" alt=""
                            class="rounded-2xl object-cover w-[120px] h-[90px]">
                        <div class="flex flex-col">
                            <h3 class="text-xl font-bold text-indigo-950">{{ $projectApplicant->project->name }}</h3>
                            <p class="text-sm text-slate-500">{{ $projectApplicant->project->category->name }}</p>
                        </div>
                    </div>
                </div>

                <hr class="my-5">

                <h3 class="text-xl font-bold text-indigo-950">Applicants</h3>

                <div class="flex flex-row items-center justify-between">
                    <div class="flex flex-row items-center gap-x-3">
                        <img src="{{ Storage::url($projectApplicant->freelancer->avatar) }}" alt=""
                            class="rounded-full object-cover w-[70px] h-[70px]">
                        <div class="flex flex-col">
                            <h3 class="text-xl font-bold text-indigo-950">{{ $projectApplicant->freelancer->name }}</h3>
                            <p class="text-sm text-slate-500">{{ $projectApplicant->freelancer->occupation }}</p>
                        </div>
                    </div>

                    @if ($projectApplicant->status == 'Hired')
                        <span class="px-3 py-2 text-sm font-bold text-white bg-green-500 rounded-full w-fit">
                            HIRED
                        </span>
                    @elseif($projectApplicant->status == 'Waiting')
                        <span class="px-3 py-2 text-sm font-bold text-white bg-orange-500 rounded-full w-fit">
                            WAITING FOR APPROVAL
                        </span>
                    @elseif($projectApplicant->status == 'Rejected')
                        <span class="px-3 py-2 text-sm font-bold text-white bg-red-500 rounded-full w-fit">
                            REJECTED
                        </span>
                    @endif

                </div>

                <h3 class="mt-5 text-xl font-bold text-indigo-950">Message</h3>
                <p>
                    {{ $projectApplicant->message }}
                </p>

                @if ($projectApplicant->status == 'Hired')
                    <hr class="my-5">
                    <h3 class="text-xl font-bold text-indigo-950">Setup Meeting with Freelancer</h3>
                    <div class="flex flex-row items-center px-5 py-3 border gap-x-4 border-slate-200 w-fit rounded-2xl">
                        <svg width="38" height="38" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path opacity="0.58" d="M24 0H0V24H24V0Z" fill="white" />
                            <path opacity="0.4"
                                d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z"
                                fill="#292D32" />
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M6.25 9.67976V12.4798C6.25 14.0198 7.50001 15.2598 9.04001 15.2498L12.72 15.2198C13.23 15.2198 13.64 14.7998 13.64 14.2998V11.5298C13.64 9.99977 12.4 8.75977 10.87 8.75977H7.17999C6.65999 8.75977 6.25 9.16976 6.25 9.67976Z"
                                fill="#292D32" />
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M17.75 10.0196V13.9996C17.75 14.4296 17.27 14.6896 16.91 14.4496L14.99 13.1696C14.84 13.0696 14.75 12.8996 14.75 12.7196V11.2996C14.75 11.1196 14.84 10.9496 14.99 10.8496L16.91 9.56964C17.27 9.32964 17.75 9.58963 17.75 10.0196Z"
                                fill="#292D32" />
                        </svg>
                        <p class="text-lg font-bold text-indigo-950">{{ $projectApplicant->freelancer->email }}</p>

                    </div>
                @elseif($projectApplicant->status == 'Waiting')
                    {{-- <form method="POST" action="{{route('admin.reply_applicant.update', $projectApplicant->id)}}" enctype="multipart/form-data">
                    @csrf

                    <button type="submit" class="w-full px-6 py-4 mt-2 font-bold text-white bg-indigo-700 rounded-full">
                        Approve & Hire Now
                    </button>
                </form> --}}
                    <form method="POST" action="{{ route('admin.project_applicants.update', $projectApplicant->id) }}"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <button type="submit"
                            class="w-full px-6 py-4 mt-2 font-bold text-white bg-indigo-700 rounded-full">
                            Approve & Hire Now
                        </button>
                    </form>
                @endif

                @if ($projectApplicant->project->has_started)
                    @if ($projectApplicant->status == 'Hired')
                        @if (!$projectApplicant->project->has_finished)
                            <hr class="my-5">
                            <form method="POST"
                                action="{{ route('admin.complete_project.store', $projectApplicant->id) }}"
                                enctype="multipart/form-data">
                                @csrf

                                <button type="submit"
                                    class="w-full px-6 py-4 font-bold text-white bg-green-500 rounded-full">
                                    Mark as Completed
                                </button>
                            </form>
                        @endif
                    @endif
                @endif

            </div>
        </div>
    </div>
</x-app-layout>
