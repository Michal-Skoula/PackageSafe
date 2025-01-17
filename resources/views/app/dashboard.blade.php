<x-app-layout>
    <x-session_error/>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-sm sm:rounded-lg flex flex-col gap-6">
                <div class="dark:bg-gray-800 bg-white p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="font-medium text-3xl dark:text-gray-200 leading-tight">Všechny zásilky</h2>
                    @if($towers->isEmpty())
                        <p>No towers found.</p>
                    @else
                        <div class="grid grid-cols-1 gap-4 py-5 overflow-x-auto">
{{--                            @foreach($towers as $tower)--}}
{{--                                <livewire:package-line-view tower_id="{{$tower->id}}"/>--}}
{{--                            @endforeach--}}
                            <table class="min-w-max w-full rounded-xl overflow-clip">
                                <tr class="dark:bg-blue-600 bg-gray-200 bg-opacity-60 text-left">
                                    <th class="px-7 py-4">Objednávka</th>
                                    <th class="px-7 py-4">Status</th>
                                    <th class="px-7 py-4">Aktuální hodnoty</th>
{{--                                    <th class="px-7 py-4">Zobrazit</th>--}}
                                </tr>
                                <livewire:package-line-view tower_id="1"/>
                                <livewire:package-line-view tower_id="2"/>
                                <livewire:package-line-view tower_id="2"/>
                                <livewire:package-line-view tower_id="2"/>
                            </table>
                            
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
