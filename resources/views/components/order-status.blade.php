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
        'colors' => 'dark:bg-yellow-500 dark:text-yellow-800 bg-yellow-200 text-yellow-700',
        'text' => 'Přijata'
    ],
    '2' => [
        'colors' => 'dark:bg-orange-500 dark:text-orange-900 bg-orange-200 text-orange-800',
        'text' => 'Na cestě'
    ],
    '3' => [
        'colors' => 'dark:bg-blue-400 dark:text-blue-900 bg-blue-200 text-blue-700',
        'text' => 'K vyzvednutí'
    ],
    '4' => [
        'colors' => 'dark:bg-green-500 dark:text-green-900 bg-green-200 text-green-700',
        'text' => 'Vyzvednuta'
    ],
    '5' => [
        'colors' => 'dark:bg-red-500 dark:!text-red-950 bg-red-200 text-red-700',
        'text' => 'Problém'
    ],
    'default' => [
        'colors' => 'white',
        'text' => 'Neznámý stav'
    ]
};

@endphp

<div>
    <p class="inline-block px-4 py-1 font-light rounded-full text-sm {{$data['colors']}}">{{$data['text']}}</p>
</div>