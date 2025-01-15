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
                            @foreach($towers as $tower)
                                <livewire:package-line-view tower_id="{{$tower->id}}"/>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
