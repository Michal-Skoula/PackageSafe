<li class="p-5 border border-gray-500 rounded-lg w-40 h-40 flex flex-col">
    <svg
        class="h-10 w-10 mb-2"
        
        xmlns="http://www.w3.org/2000/svg"
        viewBox="0 -960 960 960">
        <path
            class="fill-current text-gray-300"
            d="{{ $svg_path }}"/>
    </svg>
    <h3 class="font-semibold text-3xl"> <span wire:poll.5000ms="update">{{ $value ?? 0 }}</span> {!! $unit_of_measurement !!}</h3>
    <p class="text-gray-400">{{ $name }}</p>
</li>
