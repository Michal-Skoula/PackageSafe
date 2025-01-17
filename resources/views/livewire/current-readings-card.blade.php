<div class="p-8 dark:bg-gray-900 bg-gray-100 rounded-xl flex flex-col">
    <svg
        class="h-10 w-10 mb-2"
        
        xmlns="http://www.w3.org/2000/svg"
        viewBox="0 -960 960 960">
        <path
            class="fill-current dark:text-gray-300 text-gray-700"
            d="{{ $svg_path }}"/>
    </svg>
    <h3 class="font-semibold text-3xl"> <span wire:poll.5000ms="update">{{ $value ?? 0 }}</span> {!! $unit_of_measurement !!}</h3>
    <p class="dark:text-gray-400 text-gray-700">{{ $name }}</p>
</div>
