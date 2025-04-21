<div>
    <div class="grid grid-cols-3 gap-3">
        <div>
            <select
                class="py-3 px-4 pe-9 block w-full border-gray-200 bg-gray-50
                 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700
                  dark:border-neutral-700 dark:text-neutral-200 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                <option selected="">Select Year</option>
                @foreach (range(now()->year - 5, now()->year) as $y)
                    <option value="{{ $y }}">{{ $y }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <select
                class="py-3 px-4 pe-9 block w-full border-gray-200 bg-gray-50
                 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700
                  dark:border-neutral-700 dark:text-neutral-200 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                <option selected="">Select Months</option>
                @foreach ($twelvemonths as $month)
                    <option value="{{ $month->value }}">{{ $month->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <select
                class="py-3 px-4 pe-9 block w-full border-gray-200 bg-gray-50
                 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700
                  dark:border-neutral-700 dark:text-neutral-200 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                <option selected="">Select Grade</option>
                @foreach ($grades as $grade)
                    <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>
