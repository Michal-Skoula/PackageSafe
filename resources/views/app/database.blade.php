<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
{{--            {{$greeting}}, {{request()->user()->name}}!--}}Hello
        </h2>
    </x-slot>
    <x-session_error></x-session_error>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-sm sm:rounded-lg flex flex-col gap-6">
                <div class="dark:bg-gray-800 bg-white p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="mb-4 font-medium text-xl dark:text-gray-200 leading-tight">Aktuální hodnoty senzorů</h2>
                    <div class="overflow-x-auto">
                        <table class="rounded overflow-clip w-full">
                            <tr class="dark:bg-blue-700">
                                <th class="p-3">Timestamp</th>
                                <th class="p-3">Temperature</th>
                                <th class="p-3">Humidity</th>
                                <th class="p-3">Pressure</th>
                                <th class="p-3">CO2</th>
                            </tr>
                            <style>
                                tr:nth-of-type(2n - 1):not(:first-of-type) {
                                    background: rgb(17 24 39);
                                }
                                tr:nth-last-of-type(2n) {
                                    background:  rgb(3 7 18);
                                }
                            </style>
                            @foreach($data as $entry)
                                <tr>
                                    <td class="p-3 text-center">{{$entry->created_at}}</td>
                                    <td class="p-3 text-center">{{$entry->temperature}}</td>
                                    <td class="p-3 text-center">{{$entry->humidity}}</td>
                                    <td class="p-3 text-center">{{$entry->pressure}}</td>
                                    <td class="p-3 text-center">{{$entry->co2}}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                   
                    {{$data->links()}}
                
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
