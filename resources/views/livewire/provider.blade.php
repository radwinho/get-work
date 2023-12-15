<div x-data="{ createFrom: @entangle('createForm.showCreate') , updateFrom: @entangle('updateForm.showUpdate') }"
    class="relative overflow-x-auto shadow-md sm:rounded-lg container mx-auto bg-white dark:bg-gray-700 p-4 mt-3">
    <div class="flex items-center justify-between pb-4">
        <label for="table-search" class="sr-only">Search</label>
        <div class="relative w-3/4">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor"
                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                        clip-rule="evenodd"></path>
                </svg>
            </div>
            <input wire:model.live='search' type="text" id="table-search"
                class="w-60 md:w-80 p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Search for items">
        </div>
        <button x-on:click="createFrom = !createFrom"
            class="bg-gradient-to-r text-slate-50 from-purple-400 to-blue-400 dark:bg-slate-50 dark:hover:dark:bg-slate-50/80 p-2 rounded">Add
            Job
        </button>
    </div>
    
    @include('livewire.includes.flash-message' , ['show' => $showAlert])

    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Name
                </th>
                <th scope="col" class="px-6 py-3">
                    Location
                </th>
                <th scope="col" class="px-6 py-3">
                    Type
                </th>
                <th scope="col" class="px-6 py-3">
                    Tags
                </th>
                <th scope="col" class="px-6 py-3">
                    Action
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($this->jobs as $job)
                <tr
                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $job->name }}
                    </th>
                    <td class="px-6 py-4">
                        {{ $job->location }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $job->type }}
                    </td>
                    <td class="px-6 py-4">
                        @foreach ($job->tags as $tag)
                            <span class="bg-gradient-to-r text-slate-50 from-purple-400 to-blue-400 px-2 py-1 rounded">{{ $tag }}</span>
                        @endforeach

                    </td>
                    <td class="px-6 py-4">
                        <button x-on:click='$wire.setToUpdate({{ $job->id }}) , updateFrom = true' type="button" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="pt-4">
        {{ $this->jobs->links() }}
    </div>

    <div x-show='createFrom' x-transition>
        @include('livewire.includes.add-job')
    </div>

    <div x-show='updateFrom' x-transition>
        @include('livewire.includes.update-job')
    </div>
</div>
