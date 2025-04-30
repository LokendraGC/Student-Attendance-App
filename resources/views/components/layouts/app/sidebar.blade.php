<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
    </head>



    <body class="min-h-screen bg-white dark:bg-zinc-800">
        <flux:sidebar sticky stashable class="border-r border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
            <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

                 @php
                 $dashboardName = auth()->user()->hasRole('admin') ? 'admin.dashboard' :
                 (auth()->user()->hasRole('teacher') ? 'teacher.dashboard' :
                 'student.dashboard');
                 @endphp


            <a href="{{ route( $dashboardName ) }}">
                <x-app-logo />
            </a>

            {{-- @php
                dd(auth()->user()->hasRole('admin'));
            @endphp --}}

            <flux:navlist variant="outline">
                {{-- Dashboard --}}
                <flux:navlist.item
                    icon="home"
                    :href="route($dashboardName)"
                    :current="request()->routeIs($dashboardName)"
                    wire:navigate>
                    {{ __('Dashboard') }}
                </flux:navlist.item>

                {{-- Student Management Dropdown --}}
                @php
                $isActive = request()->routeIs(['student.index','student.create','student.edit']) ||
                request()->routeIs(['grade.index','grade.create','grade.edit']) || request()->routeIs('attendance.page') || request()->routeIs(['subject.index','subject.create','subject.edit']) ;
            @endphp

            <div
                x-data="{ open: {{ $isActive ? 'true' : 'false' }} }"
                class="relative"
                {{-- @click.away="open = false" --}}
            >
                <button
                    @click="open = !open"
                    class="flex items-center w-full px-4 py-2 text-sm hover:bg-gray-700 focus:outline-none transition-colors"
                    :class="{ 'text-white bg-gray-800': open || {{ $isActive ? 'true' : 'false' }} }"
                >
                    <x-icon name="academic-cap" class="mr-2 w-5 h-5" />
                    {{ __('Student Management') }}
                    <svg class="ml-auto w-4 h-4 transform transition-transform duration-300"
                         :class="{ 'rotate-180': open }"
                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                <div
                    x-show="open"
                    x-transition:enter="transition ease-out duration-300 delay-200"
                    x-transition:leave="transition ease-in duration-300 delay-200"
                    class="ml-6 space-y-1 mt-1"
                    x-cloak
                >

                @hasanyrole('teacher|admin')
                    <flux:navlist.item
                        icon="users"
                        :href="route('student.index')"
                        :current="request()->routeIs('student.index')"
                        wire:navigate>
                        {{ __('All Students') }}
                    </flux:navlist.item>
                    @endhasanyrole

                    <flux:navlist.item
                        icon="bars-3-bottom-left"
                        :href="route('grade.index')"
                        :current="request()->routeIs('grade.index')"
                        wire:navigate>
                        {{ __('Grades') }}
                    </flux:navlist.item>

                    <flux:navlist.item
                        icon="book-open"
                        :href="route('subject.index')"
                        :current="request()->routeIs('subject.index')"
                        wire:navigate>
                        {{ __('Subjects') }}
                    </flux:navlist.item>

                    <flux:navlist.item
                        icon="calendar-days"
                        :href="route('attendance.page')"
                        :current="request()->routeIs('attendance.page')"
                        wire:navigate>
                        {{ __('Attendances') }}
                    </flux:navlist.item>
                </div>
            </div>

            @hasrole('admin')
            <flux:navlist variant="outline">
                {{-- Roles --}}
                <flux:navlist.item
                    icon="user"
                    :href="route('role.index')"
                    :current="request()->routeIs('role.index')"
                    wire:navigate>
                    {{ __('Roles') }}
                </flux:navlist.item>
            </flux:navlist>
            @endhasrole



            </flux:navlist>

            <flux:spacer />


            <!-- Desktop User Menu -->
            <flux:dropdown position="bottom" align="start">
                <flux:profile
                    :name="auth()->user()->name"
                    :initials="auth()->user()->initials()"
                    icon-trailing="chevrons-up-down"
                />

                <flux:menu class="w-[220px]">
                    <flux:menu.radio.group>
                        <div class="p-0 text-sm font-normal">
                            <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                                <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                    <span
                                        class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white"
                                    >
                                        {{ auth()->user()->initials() }}
                                    </span>
                                </span>

                                <div class="grid flex-1 text-start text-sm leading-tight">
                                    <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                    <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                                </div>
                            </div>
                        </div>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <flux:menu.radio.group>
                        <flux:menu.item :href="route('settings.profile')" icon="cog" wire:navigate>{{ __('Settings') }}</flux:menu.item>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                            {{ __('Log Out') }}
                        </flux:menu.item>
                    </form>
                </flux:menu>
            </flux:dropdown>
        </flux:sidebar>

        <!-- Mobile User Menu -->
        <flux:header class="lg:hidden">
            <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

            <flux:spacer />

            <flux:dropdown position="top" align="end">
                <flux:profile
                    :initials="auth()->user()->initials()"
                    icon-trailing="chevron-down"
                />

                <flux:menu>
                    <flux:menu.radio.group>
                        <div class="p-0 text-sm font-normal">
                            <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                                <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                    <span
                                        class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white"
                                    >
                                        {{ auth()->user()->initials() }}
                                    </span>
                                </span>

                                <div class="grid flex-1 text-start text-sm leading-tight">
                                    <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                    <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                                </div>
                            </div>
                        </div>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <flux:menu.radio.group>
                        <flux:menu.item :href="route('settings.profile')" icon="cog" wire:navigate>{{ __('Settings') }}</flux:menu.item>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                            {{ __('Log Out') }}
                        </flux:menu.item>
                    </form>
                </flux:menu>
            </flux:dropdown>
        </flux:header>

        {{ $slot }}

        @fluxScripts
        <x-toaster-hub />
    </body>
</html>
