<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex">
            <!-- Card 1 -->
            <div class="bg-red-400 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-4 flex-1 mr-2">
                <div class="p-6 text-gray-900 dark:text-gray-100 flex flex-col">
                    <h2 class="text-2xl font-bold text-neutral-300">{{ $list }}</h2>
                    <p class="flex-grow text-neutral-300">{{ __("Pengguna Terdaftar") }}</p>
                </div>
            </div>
            <!-- Card 2 -->
            <div class="bg-red-400 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-4 flex-1 ml-2">
                <div class="p-6 text-gray-900 dark:text-gray-100 flex flex-col">
                    <h2 class="text-2xl font-bold text-neutral-300">{{ $active }}</h2>
                    <p class="flex-grow text-neutral-300">{{ __("Pengguna Aktif") }}</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>