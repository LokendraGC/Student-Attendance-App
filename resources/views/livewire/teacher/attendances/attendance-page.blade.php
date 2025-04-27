<div>
    <div class="grid grid-cols-[8fr_8fr_8fr_8fr_1fr] gap-3">
        <div>
            <select wire:model.live = "year"
                wire:change="fetchStudent"
                class="py-3 px-4 pe-9 block w-full border-gray-200 bg-gray-50
                    rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700
                     dark:border-neutral-700 dark:text-neutral-200 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                <option value="">Select Year</option>
                @foreach (range(now()->year - 5, now()->year) as $year)
                    <option value="{{ $year }}">{{ $year }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <select wire:model.live = "month"
                wire:change="fetchStudent"
                class="py-3 px-4 pe-9 block w-full border-gray-200 bg-gray-50
                    rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700
                     dark:border-neutral-700 dark:text-neutral-200 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                <option value="">Select Month</option>
                @foreach (range(1, 12) as $m)
                    <option value="{{ $m }}">
                        {{ Carbon\Carbon::create()->month($m)->format('F') }}</option>
                @endforeach
            </select>
        </div>

        <div class="">
            <select wire:model.live= "selectedGrade"
                wire:change="fetchStudent"
                class="py-3 px-4 pe-9 block w-full border-gray-200 bg-gray-50
                             rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700
                              dark:border-neutral-700 dark:text-neutral-200 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                <option selected="">Select Grade</option>
                @foreach ($grades as $grade)
                    <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                @endforeach
            </select>
        </div>


        <div class="">
            <select wire:model.live = "selectedSubject"
                wire:change="fetchStudent"
                class="py-3 px-4 pe-9 block w-full border-gray-200 bg-gray-50
                         rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700
                          dark:border-neutral-700 dark:text-neutral-200 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                <option selected="">Select Subjects</option>
                @foreach ($subjects as $subject)
                    <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="flex items-center justify-end">
            <button wire:click.live="fetchStudent" type="button"
                class="cursor-pointer flex justify-center items-center size-10 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-4">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                </svg>
            </button>
        </div>

    </div>

    {{-- attendance table --}}
    @if ($year && $month && $selectedGrade && $selectedSubject)

        <div class="my-[20px] max-w-[1200px]">
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
                                        Attendance
                                    </h2>
                                    <p class="text-md text-gray-600 dark:text-neutral-400">
                                        Attendance overview of {{ $selected_month }}
                                    </p>
                                </div>

                                <div>
                                    <button wire:click = "exportToExcel" type="button"
                                        class="cursor-pointer py-3 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-green-600 text-white hover:bg-green-700 focus:outline-none focus:bg-green-700
                                         disabled:opacity-50 disabled:pointer-events-none">
                                        Export to Excel
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m18.375 12.739-7.693 7.693a4.5 4.5 0 0 1-6.364-6.364l10.94-10.94A3 3 0 1 1 19.5 7.372L8.552 18.32m.009-.01-.01.01m5.699-9.941-7.81 7.81a1.5 1.5 0 0 0 2.112 2.13" />
                                        </svg>

                                    </button>
                                </div>

                            </div>
                            <!-- End Header -->
                            <!-- Wrapper to handle horizontal scroll -->
                            <div class="overflow-x-auto">
                                <table
                                    class="w-full table-auto divide-y divide-gray-200 dark:divide-neutral-700 min-w-max">
                                    <thead
                                        class="bg-gray-50 divide-y divide-gray-200 dark:bg-neutral-800 dark:divide-neutral-700">
                                        <tr>
                                            <th
                                                class="sticky left-0 z-10 bg-gray-50 px-6 py-3 text-start border-s border-gray-200 dark:border-neutral-700 dark:bg-neutral-800">
                                                <span
                                                    class="text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">
                                                    Student Name
                                                </span>
                                            </th>

                                            @foreach (range(1, $daysInMonth) as $day)
                                                <th
                                                    class="px-6 py-3 text-start border-s border-gray-200 dark:border-neutral-700">
                                                    <span
                                                        class="text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">
                                                        {{ $day }}

                                                        <select
                                                            wire:change = "markAll( {{ $day }}, $event.target.value )"
                                                            class="dark:bg-neutral-900">
                                                            <option value="all">All</option>
                                                            <option value="present">Present</option>
                                                            <option value="absent">Absent</option>
                                                            <option value="sick">Sick</option>
                                                            <option value="other">Other</option>
                                                        </select>

                                                    </span>
                                                </th>
                                            @endforeach
                                        </tr>
                                    </thead>

                                    <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">

                                        @foreach ($students as $student)
                                            <tr :key={{ $student->id }}>
                                                <td class="h-px w-auto whitespace-nowrap">
                                                    <div class="px-6 py-2">
                                                        <span
                                                            class="font-semibold text-sm text-gray-800 dark:text-neutral-200">
                                                            {{ $student->first_name }} {{ $student->last_name }}
                                                        </span>
                                                    </div>
                                                </td>

                                                @foreach (range(1, $daysInMonth) as $day)
                                                    <td class="h-px w-auto whitespace-nowrap">
                                                        <div class="px-6 py-2">
                                                            <span
                                                                class="text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">
                                                                {{ $day }}

                                                                <select
                                                                    wire:change="updateAttendance({{ $student->id }}, {{ $day }}, $event.target.value)"
                                                                    class="dark:bg-neutral-900">
                                                                    <option value="present"
                                                                        {{ $attendance[$student->id][$day] == 'present' ? 'selected' : '' }}>
                                                                        Present</option>
                                                                    <option value="absent"
                                                                        {{ $attendance[$student->id][$day] == 'absent' ? 'selected' : '' }}>
                                                                        Absent</option>
                                                                    <option value="sick"
                                                                        {{ $attendance[$student->id][$day] == 'sick' ? 'selected' : '' }}>
                                                                        Sick</option>
                                                                    <option value="other"
                                                                        {{ $attendance[$student->id][$day] == 'other' ? 'selected' : '' }}>
                                                                        Other</option>
                                                                </select>

                                                            </span>
                                                        </div>
                                                    </td>
                                                @endforeach
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
            <!-- End Card -->
        </div>
    @endif

</div>
