<div>
    <div class="max-w-[1200px]">
        <!-- Card -->
        <div class="flex flex-col">
            <div class="-m-1.5 overflow-x-auto">
                <div class="p-1.5 max-w-[1200px] align-middle">
                    <div
                        class="bg-white border border-gray-200 rounded-xl shadow-2xs overflow-hidden dark:bg-neutral-900 dark:border-neutral-700">
                        <!-- Header -->
                        <div
                            class="px-6 py-8 flex justify-between items-center border-b border-gray-200 dark:border-neutral-700">

                            <div>
                                <h2 class="text-xl font-semibold text-gray-800 dark:text-neutral-200">
                                    Students
                                </h2>
                                <p class="text-sm text-gray-600 dark:text-neutral-400">
                                    Students overview
                                </p>
                            </div>

                            @can('add.student')
                                <div>
                                    <div class="inline-flex gap-x-2">

                                        <a wire:navigate
                                            class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-hidden focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none"
                                            href="{{ route('student.create') }}">
                                            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24"
                                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M5 12h14" />
                                                <path d="M12 5v14" />
                                            </svg>
                                            Create
                                        </a>
                                    </div>
                                </div>
                            @endcan

                        </div>
                        <!-- End Header -->

                        <!-- Table -->
                        <table class="w-full table-auto divide-y divide-gray-200 dark:divide-neutral-700">
                            <thead
                                class="bg-gray-50 divide-y divide-gray-200 dark:bg-neutral-800 dark:divide-neutral-700">
                                <tr>
                                    <th class="px-6 py-3 text-start border-s border-gray-200 dark:border-neutral-700">
                                        <span
                                            class="text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">
                                            Student Name
                                        </span>
                                    </th>

                                    <th class="px-6 py-3 text-start">
                                        <span
                                            class="text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">
                                            Contact Number
                                        </span>
                                    </th>

                                    <th class="px-6 py-3 text-start">
                                        <span
                                            class="text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">
                                            Email
                                        </span>
                                    </th>

                                    <th class="px-6 py-3 text-start">
                                        <span
                                            class="text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">
                                            Grade
                                        </span>
                                    </th>

                                    <th class="py-3 text-end sm:pr-[37px]" colspan="2">
                                        <span
                                            class="text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">
                                            Action
                                        </span>
                                    </th>


                                </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                                @foreach ($role_students as $student)
                                    <tr>
                                        <td class="h-px w-auto whitespace-nowrap">
                                            <div class="px-6 py-2">
                                                <span class="font-semibold text-sm text-gray-800 dark:text-neutral-200">
                                                    {{ $student->name }}
                                                </span>
                                            </div>
                                        </td>

                                        <td class="h-px w-auto whitespace-nowrap">
                                            <div class="px-6 py-2">
                                                <span
                                                    class="text-sm text-gray-800 dark:text-neutral-200">{{ $student->student->phone ?? '' }}</span>
                                            </div>
                                        </td>

                                        <td class="h-px w-auto whitespace-nowrap">
                                            <div class="px-6 py-2">
                                                <span
                                                    class="text-sm text-gray-800 dark:text-neutral-200">{{ $student->email }}</span>
                                            </div>
                                        </td>

                                        <td class="h-px w-auto whitespace-nowrap">
                                            <div class="px-6 py-2">
                                                <span class="text-sm text-gray-800 dark:text-neutral-200">
                                                    {{ optional(optional($student->student)->grade)->name ?? 'N/A' }}
                                                </span>
                                            </div>
                                        </td>

                                        <td class="h-px w-auto whitespace-nowrap text-end">
                                            <div class="flex items-center justify-end gap-2 px-6 py-2">

                                                @can('edit.student')
                                                    <a wire:navigate href="{{ route('student.edit', $student->id) }}"
                                                        class="cursor-pointer flex justify-center items-center gap-2 size-8 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-hidden focus:bg-blue-700">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                            class="size-4">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                                        </svg>
                                                    </a>
                                                    @endif

                                                    @can('delete.student')
                                                    <button wire:click="$set('confirmingDelete', {{ $student->id }})"
                                                        type="button"
                                                        class="cursor-pointer flex justify-center items-center gap-2 size-8 text-sm font-medium rounded-lg border border-transparent bg-red-600 text-white hover:bg-red-700 focus:outline-hidden focus:bg-red-700">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                            class="size-4">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                        </svg>
                                                    </button>
                                                    @endcan
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>
                            <!-- End Table -->

                            <!-- Footer -->
                            <div
                                class="text-end w-full px-6  grid gap-3 py-[3px] border-t border-gray-200 dark:border-neutral-700">

                                <div>
                                    <div class="inline-flex gap-x-2 py-[10px]">
                                        <button type="button"
                                            class="cursor-pointer py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700">
                                            <svg class="shrink-0 size-2" xmlns="http://www.w3.org/2000/svg" width="24"
                                                height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="m15 18-6-6 6-6" />
                                            </svg>
                                            Prev
                                        </button>

                                        <button type="button"
                                            class="cursor-pointer py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700">
                                            Next
                                            <svg class="shrink-0 size-2" xmlns="http://www.w3.org/2000/svg" width="24"
                                                height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="m9 18 6-6-6-6" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <!-- End Footer -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Card -->
        </div>

        @if ($confirmingDelete)
            <div class="fixed inset-0 flex items-center justify-center ">
                <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4">Are you sure?</h2>
                    <p class="text-sm text-gray-600 mb-6">This action cannot be undone.</p>

                    <div class="flex justify-end space-x-3">
                        <button wire:click="$set('confirmingDelete', null)"
                            class="px-4 py-2 text-sm bg-gray-400 hover:bg-gray-500 rounded cursor-pointer">
                            Cancel
                        </button>

                        <button wire:click="confirmDelete"
                            class="px-4 py-2 text-sm bg-red-600 text-white hover:bg-red-700 rounded cursor-pointer">
                            Delete
                        </button>
                    </div>
                </div>
            </div>
        @endif


    </div>
