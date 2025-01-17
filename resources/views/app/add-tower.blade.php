<x-app-layout>
    {{--    <x-slot name="header">--}}
    {{--        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">--}}
    {{--            {{$greeting}}, {{request()->user()->name}}!--}}{{--Hello--}}
    {{--        </h2>--}}
    {{--    </x-slot>--}}
    <x-session_error></x-session_error>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-sm sm:rounded-lg flex flex-col gap-6">
                <div class="dark:bg-gray-800 bg-white p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="mb-4 font-medium text-xl dark:text-gray-200 leading-tight">Přidat nový tower</h2>
                    <form action="{{route('create-tower')}}" method="POST">
                        @csrf
                        <input class="text-black" required type="text" name="tower_name" id="tower_name" placeholder="Tower name">
                        <input class="text-black w-40" required min="1" max="5" type="number" inputmode="numeric" name="status" placeholder="Status: 1-5">
                        <x-primary-button>Odeslat</x-primary-button>
                        @if($errors->isNotEmpty())
                            <ul class="bg-red-300 rounded-xl p-5 mt-3">
                                @foreach($errors->all() as $error)
                                    <li class="text-red-600">{{$error}}</li>
                                @endforeach
                            </ul>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
