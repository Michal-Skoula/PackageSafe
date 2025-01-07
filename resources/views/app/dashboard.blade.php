<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{$greeting}}, {{request()->user()->name}}!
        </h2>
    </x-slot>
    <x-session_error></x-session_error>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-sm sm:rounded-lg flex flex-col gap-6">
                <div class="dark:bg-gray-800 bg-white p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="font-medium text-xl dark:text-gray-200 leading-tight">Aktuální hodnoty senzorů</h2>
                </div>
                <div class="dark:bg-gray-800 bg-white p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="font-medium text-xl dark:text-gray-200 leading-tight">Aktuální hodnoty senzorů</h2>
                    @php
                        $time = now();
						for($i = 0; $i < 100; $i++ ) {
							$time->subSecond();
							echo $time . '<br>';
						}
                    
                    @endphp
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
