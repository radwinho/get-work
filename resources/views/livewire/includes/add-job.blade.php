<div
    class="fixed inset-y-[65px] inset-x-0 w-full bottom-0 overflow-auto bg-slate-600 bg-opacity-50 flex justify-center items-center">
    <div class="w-11/12 md:w-1/2 mx-auto shadow rounded bg-white dark:bg-slate-800 p-8">
        <form class="relative">
            <div class="absolute -top-4 -right-4">
                <svg x-on:click='createFrom = false' xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke-width="1.5" stroke="currentColor"
                    class="w-6 h-6 cursor-pointer bg-slate-300 hover:bg-slate-400 hover:text-white rounded">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </div>
            <div class="mb-6 border-b border-slate-300 dark:border-slate-50 pb-3">
                <h1 class="text-xl dark:text-white font-bold">Add Job</h1>
            </div>
            <div class="mb-6">
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Job
                    name</label>
                <input wire:model='createForm.name' type="text" id="name" autocomplete="no"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                @error('createForm.name')
                    <span class="mt-1 text-sm text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-6">
                <label for="location" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Job
                    location</label>
                <input wire:model='createForm.location' type="text" id="location" autocomplete="no"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    >

                @error('createForm.location')
                    <span class="mt-1 text-sm text-red-500">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="mb-6">
                <label for="Type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Job
                    type</label>

                <select name="type" id="type" wire:model='createForm.type'
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    required>
                    <option value="FullTime">Full Time</option>
                    <option value="PartTime">Part Time</option>
                </select>

            </div>

            <div x-data="{ tags: [], newTag: '', inputName: '' }">

                <label for="Type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Job
                    Tags</label>

                <input
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 mb-3"
                    placeholder="Add tag..."
                    @keydown.enter.prevent="if (newTag.trim() !== '' && !tags.includes(newTag)) tags.push(newTag.trim()); newTag = ''"
                    x-model="newTag">

                <template x-for="tag in tags">
                    <input type="hidden" x-bind:name="inputName + '[]'" x-bind:value="tag">
                </template>

                {{-- <div class="max-w-sm w-full mx-auto"> --}}
                <div>
                    <div class="flex justify-start flex-wrap gap-4">
                        <template x-for="tag in tags" :key="tag">
                            <span class="flex bg-sky-600 text-white relative rounded pt-2">
                                <span x-text="tag" class="py-2 px-5"></span>
                                <button type="button"
                                    class="flex items-center justify-center text-red-500 bg-gray-100 absolute top-1 right-1 rounded-full h-4 w-4"
                                    @click="tags = tags.filter(i => i !== tag)">
                                    &times;
                                </button>
                            </span>
                        </template>
                    </div>

                </div>
                <button type="button" x-on:click="$wire.save(tags), tags = [] "
                    class="text-white dark:text-black font-bold bg-emerald-700 hover:bg-emerald-800 dark:bg-white dark:hover:bg-white/80 dark:focus:ring-slate-00 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center mt-3">Submit</button>
            </div>
        </form>
    </div>
</div>
