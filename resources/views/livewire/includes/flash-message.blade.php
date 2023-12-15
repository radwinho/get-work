@if (session()->has('success'))
    <div x-data="{ showSession: {{ $show }} }" x-show='showSession' x-transtion.duration.500ms
        class="bg-slate-100 text-slate-700 shadow font-semibold p-2 mb-10 rounded relative">
        <div class="flex justify-center items-center absolute inset-y-0 right-1 cursor-pointer">
            <svg x-on:click='showSession = false' xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>

        </div>
        {{ session('success') }}
    </div>
@endif
