@props([
	'value' => '0',
	'path' => '',
	'title' => '',
	'unit' => ''
])

<div class="flex gap-1 items-center p-1.5 rounded-xl">
    <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960">
        <path class="fill-current dark:text-gray-400 text-gray-600" d="{{$path}}"/>
        <title class="dark:text-gray-200 text-gray-900">{{$title}}</title>
    </svg>
    <p>{{$value}} {!! $unit !!}</p>
</div>