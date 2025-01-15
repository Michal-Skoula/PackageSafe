@props([
	'value' => '0',
	'path' => '',
	'title' => ''
])

<div class="flex gap-1 items-center py-1.5 px-3 rounded-xl">
    <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960">
        <path class="fill-current text-gray-400" d="{{$path}}"/>
        <title class="text-gray-200">{{$title}}</title>
    </svg>
    <p>{{$value}} </p>
</div>