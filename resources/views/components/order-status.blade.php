{{--

1. Přijata
2. Na cestě
3. Čeká na vyzvednutí
4. Vyzvednuta
5. Problém

--}}


@props([
	'status' => 1
])

@php
$data = match($status) {
    '1' => [
        'colors' => 'bg-yellow-500 text-yellow-950',
        'text' => 'Přijata'
    ],
    '2' => [
        'colors' => 'bg-orange-500 text-orange-950',
        'text' => 'Na cestě'
    ],
    '3' => [
        'colors' => 'bg-blue-500 text-blue-950',
        'text' => 'Čeká na vyzvednutí'
    ],
    '4' => [
        'colors' => 'bg-green-500 text-green-950',
        'text' => 'Vyzvednuta'
    ],
    '5' => [
        'colors' => 'bg-red-500 text-red-950',
        'text' => 'Problém'
    ],
    'default' => [
        'colors' => 'white',
        'text' => 'Neznámý stav'
    ]
};

@endphp

<div>
    <p class="block px-4 py-1 font-light rounded-full text-sm {{$data['colors']}}">{{$data['text']}}</p>
</div>