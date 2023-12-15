<div class="container mx-auto">
    {{-- The whole world belongs to you. --}}
    {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}

    <div class="max-w-sm md:w-80 py-6 px-3 sm:px-0 mx-auto sm:mx-0">
        <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
        <div class="relative">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                </svg>
            </div>
            <input wire:model.live.debounce.500ms='search' type="search" id="default-search"
                class="block w-full p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Search ..." required>
        </div>
    </div>

    @include('livewire.includes.flash-message' , ['show' => $showAlert])

    <div class="grid grid-cols-1 sm:grid-cols-3 md:grid-cols-4 gap-7 px-3 sm:px-0 sm:mt-5">
        @foreach ($this->jobs as $job)
            <div
                class="relative max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 ">
                <div
                    class="absolute left-1/2 top-0 -translate-x-1/2 -translate-y-1/2 rounded-full w-10 h-10 shadow flex justify-center items-center bg-white">
                    @if ($job->user->profile_photo_path !== null)
                        <img class="w-6 h-6 rounded-full" src="{{ asset('storage/' . $job->user->profile_photo_path) }}"
                            alt="">
                    @else
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21" />
                        </svg>
                    @endif
                </div>

                <div class="p-6">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $job->name }}
                    </h5>
                    @foreach ($job->tags as $tag)
                        <span
                            class="bg-gray-200 text-gray-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full dark:bg-gray-700 dark:text-gray-300">{{ $tag }}</span>
                    @endforeach

                    {{-- @dd($job->applications->count()) --}}

                    <button wire:click='apply({{ $job->id }})'
                        {{ $job->applications->contains('id', auth()->id()) ? 'disabled' : '' }}
                        class="disabled:bg-slate-700 flex items-center mt-3 px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        {{ $job->applications->contains('id', auth()->id()) ? 'Applied' : 'Apply Now' }}
                        <svg class="w-3.5 h-3.5 ml-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 14 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M1 5h12m0 0L9 1m4 4L9 9" />
                        </svg>
                    </button>

                </div>
            </div>
        @endforeach
        <button></>
    </div>
    @if ($this->jobs->hasMorePages())
            {{ $this->jobs->links() }}
    @endif

</div>
