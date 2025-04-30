<div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
    <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">

        <!-- Total Students -->
        <div class="bg-white dark:bg-neutral-900 border border-gray-200 dark:border-neutral-700 rounded-2xl shadow-md p-6 transition-all">
            <div>
                <p class="text-sm font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wide">
                    Total Students
                </p>
                <h3 class="mt-2 text-3xl font-extrabold text-blue-600 dark:text-blue-400">
                    {{ $totlaStudents }}
                </h3>
            </div>
        </div>

        <!-- Total Teachers -->
        <div class="bg-white dark:bg-neutral-900 border border-gray-200 dark:border-neutral-700 rounded-2xl shadow-md p-6 transition-all">
            <div>
                <p class="text-sm font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wide">
                    Total Teachers
                </p>
                <h3 class="mt-2 text-3xl font-extrabold text-green-600 dark:text-green-400">
                    {{ $totalTeachers }}
                </h3>
            </div>
        </div>

        <!-- Present Today -->
        <div class="bg-white dark:bg-neutral-900 border border-gray-200 dark:border-neutral-700 rounded-2xl shadow-md p-6 transition-all">
            <div>
                <p class="text-sm font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wide">
                    Present Today
                </p>
                <h3 class="mt-2 text-3xl font-extrabold text-yellow-600 dark:text-yellow-400">
                    {{ $presentToday }}
                </h3>
            </div>
        </div>

        <!-- Absent Today -->
        <div class="bg-white dark:bg-neutral-900 border border-gray-200 dark:border-neutral-700 rounded-2xl shadow-md p-6 transition-all">
            <div>
                <p class="text-sm font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wide">
                    Absent Today
                </p>
                <h3 class="mt-2 text-3xl font-extrabold text-red-600 dark:text-red-400">
                    {{ $absentToday }}
                </h3>
            </div>
        </div>

        <!-- Monthly Attendance Rate -->
        <div class="bg-white dark:bg-neutral-900 border border-gray-200 dark:border-neutral-700 rounded-2xl shadow-md p-6 transition-all">
            <div>
                <p class="text-sm font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wide">
                    Monthly Attendance Rate
                </p>
                <h3 class="mt-2 text-3xl font-extrabold text-purple-600 dark:text-purple-400">
                    {{ $monthlyAttendanceRate }}%
                </h3>
            </div>
        </div>

    </div>
</div>
