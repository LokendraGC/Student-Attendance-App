<div class=" w-[500px] flex flex-col gap-6">
    <x-auth-header :title="__('Create an account')" :description="__('Enter your details below to create your account')" />

    <!-- Session Status -->
    <x-auth-session-status class="text-center" :status="session('status')" />

    <div
        class=" mt-5 p-4 relative z-10 bg-white border border-gray-200 rounded-xl sm:mt-10 md:p-10 dark:bg-neutral-900 dark:border-neutral-700">
        <form wire:submit = "register">

                <div class=" mb-4 sm:mb-8">
                    <label for="hs-feedback-post-comment-name"
                        class="block mb-2 text-sm font-medium dark:text-white">Name</label>
                    <input wire:model="name" type="text" id="hs-feedback-post-comment-name-1"
                        class="py-2.5 sm:py-3 px-4 block
                    w-full border-gray-200 bg-gray-50 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500
                    disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700
                     dark:text-neutral-300 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                        placeholder="Full Name">

                    @error('name')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror

                </div>

            <div class="mb-4 sm:mb-8">
                <label for="hs-feedback-post-comment-email-1"
                    class="block mb-2 text-sm font-medium dark:text-white">Email address</label>
                <input wire:model="email" type="email" id="hs-feedback-post-comment-email-1"
                    class="py-2.5 sm:py-3 px-4 block
                    w-full border-gray-200 bg-gray-50 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500
                    disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700
                     dark:text-neutral-300 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                    placeholder="Email address">
                @error('email')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>


            <div class="mb-4 sm:mb-8">
                <label for="hs-feedback-post-comment-phone"
                    class="block mb-2 text-sm font-medium dark:text-white">Contact Number</label>
                <input wire:model="phone" type="text" min="0" max="200"
                    id="hs-feedback-post-comment-email-1"
                    class="py-2.5 sm:py-3 px-4 block
                    w-full border-gray-200 bg-gray-50 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500
                    disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700
                     dark:text-neutral-300 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                    placeholder="Enter Contact Number">
                @error('phone')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>


            <div class="mb-4 sm:mb-8">
                <label for="hs-feedback-post-comment-qualification"
                    class="block mb-2 text-sm font-medium dark:text-white">Qualification</label>
                <input wire:model="number" type="text" min="0" max="200"
                    id="hs-feedback-post-comment-email-1"
                    class="py-2.5 sm:py-3 px-4 block
                    w-full border-gray-200 bg-gray-50 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500
                    disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700
                     dark:text-neutral-300 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                    placeholder="Enter Qualification">
                @error('qualification')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>


            <div class="mb-4 sm:mb-8">
                <label for="hs-feedback-post-comment-description"
                    class="block mb-2 text-sm font-medium dark:text-white">Description</label>
                <input wire:model="number" type="text" min="0" max="200"
                    id="hs-feedback-post-comment-email-1"
                    class="py-2.5 sm:py-3 px-4 block
                    w-full border-gray-200 bg-gray-50 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500
                    disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700
                     dark:text-neutral-300 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                    placeholder="Enter Description">
                @error('description')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>


            <div class="mb-4 sm:mb-8">
                <label for="hs-feedback-post-comment-password"
                    class="block mb-2 text-sm font-medium dark:text-white">Create Password</label>
                <input wire:model="password" type="password" min="0" max="200"
                    id="hs-feedback-post-comment-email-1"
                    class="py-2.5 sm:py-3 px-4 block
                    w-full border-gray-200 bg-gray-50 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500
                    disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700
                     dark:text-neutral-300 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                    placeholder="Create Password">
                @error('password')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4 sm:mb-8">
                <label for="hs-feedback-post-comment-password_confirmation"
                    class="block mb-2 text-sm font-medium dark:text-white">Confirm Password</label>
                <input wire:model="password_confirmation" type="password" min="0" max="200"
                    id="hs-feedback-post-comment-email-1"
                    class="py-2.5 sm:py-3 px-4 block
                    w-full border-gray-200 bg-gray-50 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500
                    disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700
                     dark:text-neutral-300 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                    placeholder="Confirm Password">
                @error('password_confirmation')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>


            <div class="mt-6 grid">
                <button type="submit"
                    class="cursor-pointer w-full py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-hidden focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                    <div wire:loading
                        class="animate-spin inline-block size-6 border-3 border-current border-t-transparent text-blue-600 rounded-full dark:text-white"
                        role="status" aria-label="loading">
                        <span class="sr-only">Loading...</span>
                    </div>
                    Submit
                </button>
            </div>
        </form>
    </div>

    <div class="space-x-1 rtl:space-x-reverse text-center text-sm text-zinc-600 dark:text-zinc-400">
        {{ __('Already have an account?') }}
        <flux:link :href="route('login')" wire:navigate>{{ __('Log in') }}</flux:link>
    </div>
</div>
