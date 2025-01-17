{{--                    <form action="/dashboard" method="POST" id="devicesSwitcher">--}}
{{--                        <label for="device">Current device:</label>--}}
{{--                        <select name="device" id="device" required class="text-black">--}}
{{--                            @foreach($devices as $device)--}}
{{--                                <option value="{{$device['device_id']}}">{{$device['name']}}</option>--}}
{{--                            @endforeach--}}
{{--                        </select>--}}
{{--                        <script>--}}
{{--                            const deviceSelector = document.getElementById('device');--}}
{{--                            const devicesSwitcher = document.getElementById('devicesSwitcher');--}}
{{--                            --}}
{{--                            deviceSelector.addEventListener('change', (e) => {--}}
{{--                                devicesSwitcher.submit();--}}
{{--                            })--}}
{{--                        </script>--}}
{{--                    </form>--}}
{{--                    <div>--}}
{{--                        <p>Připojení: OK</p>--}}


<x-app-layout>
    <x-session_error/>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-sm sm:rounded-lg flex flex-col gap-6">
                <div class="dark:bg-gray-800 bg-white p-6 text-gray-900 dark:text-gray-100">
                    @if($tower == null)
                        <h2 class="font-medium text-3xl dark:text-gray-200 leading-tight mb-3">404: Tuto zásilku jsme nenašli.</h2>
                        <p class="text-gray-400">Zkuste to prosím později. <a class="underline text-blue-500" href="{{ route('dashboard') }}">Návrat do dashboardu</a></p>
                    @else
                        <div class="flex w-full justify-between items-center mb-6">
                            <h2 class="font-medium text-3xl dark:text-gray-300 text-gray-700 leading-tight">Zásilka <span class="dark:text-white text-black">#{{$tower->name}}</span></h2>
                            <a class="text-lg underline text-blue-300" href="{{route('dashboard')}}">Zpátky do dashboardu &ShortRightArrow;</a>
                        </div>
                       
                        <div class="grid lg:grid-cols-4 md:grid-cols-2 grid-cols-1 gap-4">
                            <livewire:current-readings-card
                                tower_id="1"
                                data_type="temperature"
                                name="Teplota"
                                unit_of_measurement="&deg;C"
                                svg_path="M520-520v-80h200v80H520Zm0-160v-80h320v80H520ZM320-120q-83 0-141.5-58.5T120-320q0-48 21-89.5t59-70.5v-240q0-50 35-85t85-35q50 0 85 35t35 85v240q38 29 59 70.5t21 89.5q0 83-58.5 141.5T320-120ZM200-320h240q0-29-12.5-54T392-416l-32-24v-280q0-17-11.5-28.5T320-760q-17 0-28.5 11.5T280-720v280l-32 24q-23 17-35.5 42T200-320Z"
                            />
                            <livewire:current-readings-card
                                tower_id="2"
                                data_type="humidity"
                                name="Vlhkost"
                                unit_of_measurement="%"
                                svg_path="M580-240q25 0 42.5-17.5T640-300q0-25-17.5-42.5T580-360q-25 0-42.5 17.5T520-300q0 25 17.5 42.5T580-240Zm-202-2 260-260-56-56-260 260 56 56Zm2-198q25 0 42.5-17.5T440-500q0-25-17.5-42.5T380-560q-25 0-42.5 17.5T320-500q0 25 17.5 42.5T380-440ZM480-80q-137 0-228.5-94T160-408q0-100 79.5-217.5T480-880q161 137 240.5 254.5T800-408q0 140-91.5 234T480-80Zm0-80q104 0 172-70.5T720-408q0-73-60.5-165T480-774Q361-665 300.5-573T240-408q0 107 68 177.5T480-160Zm0-320Z"
                            />
                            <livewire:current-readings-card
                                tower_id="2"
                                data_type="rotation"
                                name="V rovině?"
                                unit_of_measurement=""
                                svg_path="M480-80q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480h80q0 115 72.5 203T418-166l-58-58 56-56L598-98q-29 10-58.5 14T480-80Zm20-280v-240h120q17 0 28.5 11.5T660-560v160q0 17-11.5 28.5T620-360H500Zm-200 0v-60h100v-40h-60v-40h60v-40H300v-60h120q17 0 28.5 11.5T460-560v160q0 17-11.5 28.5T420-360H300Zm260-60h40v-120h-40v120Zm240-60q0-115-72.5-203T542-794l58 58-56 56-182-182q29-10 58.5-14t59.5-4q83 0 156 31.5T763-763q54 54 85.5 127T880-480h-80Z"
                            />
                            <livewire:current-readings-card
                                tower_id="2"
                                data_type="collision"
                                name="Náraz"
                                unit_of_measurement="x"
                                svg_path="M480-800 243-663l237 137 237-137-237-137ZM120-321v-318q0-22 10.5-40t29.5-29l280-161q10-5 19.5-8t20.5-3q11 0 21 3t19 8l280 161q19 11 29.5 29t10.5 40v159h-80v-116L479-434 200-596v274l240 139v92L160-252q-19-11-29.5-29T120-321ZM720-80q8 0 14-6t6-14q0-8-6-14t-14-6q-8 0-14 6t-6 14q0 8 6 14t14 6Zm-20-80h40v-160h-40v160ZM720 0q-83 0-141.5-58.5T520-200q0-83 58.5-141.5T720-400q83 0 141.5 58.5T920-200q0 83-58.5 141.5T720 0ZM480-491Z"
                            />
{{--                            <li class="p-5 border border-gray-500 rounded-lg w-40 h-40 flex flex-col">--}}
{{--                                <svg--}}
{{--                                    class="h-10 w-10 mb-2"--}}
{{--                                    xmlns="http://www.w3.org/2000/svg"--}}
{{--                                    viewBox="0 -960 960 960">--}}
{{--                                    <path--}}
{{--                                        class="fill-current text-gray-300"--}}
{{--                                        d=""/>--}}
{{--                                </svg>--}}
{{--                                <h3 class="font-semibold text-3xl">Předaná</h3>--}}
{{--                                <p class="text-gray-400">Stav zásilky</p>--}}
{{--                            </li>--}}
                        </div>
                
                        </div>
                        <div class="dark:bg-gray-800 bg-white p-6 text-gray-900 dark:text-gray-100">
                            <h2 class="font-medium text-xl dark:text-gray-200 leading-tight mb-4">Teplota během přepravy</h2>
                            <div>
                                <div>
                                    <canvas class="w-full" id="myChart2"></canvas>
                                
                                
                                </div>
                                <script>
                                    
                                    import {Chart} from 'chart.js';

                                    const ctx = document.getElementById('myChart');

                                    new Chart(ctx, {
                                        type: 'bar',
                                        data: {
                                            labels: ['Pondělí', 'Úterý', 'Středa', 'Čtvrtek', 'Pátek', 'Sobota'],
                                            datasets: [{
                                                label: 'Zásilka #2341-12-2024',
                                                data: [17, 18.3, 21.3, 11.3, 4, 13.1],
                                                borderWidth: 2,
                                                borderColor: '#1b4332',
                                                backgroundColor: '#2d6a4f',
                                            }],
                                        },
                                        options: {
                                            scales: {
                                                y: {
                                                    beginAtZero: true
                                                }
                                            }
                                        },
        
                                    });
                                </script>
                            </div>
                        </div>
                        <div class="dark:bg-gray-800 bg-white p-6 text-gray-900 dark:text-gray-100">
                            <h2 class="font-medium text-xl dark:text-gray-200 leading-tight mb-4">Počet nárazů</h2>
                            <div>
                                <div>
                                    <canvas class="w-full" id="myChart"></canvas>
                                </div>
                                @verbatim
                                    <script>
                                        const ctx2 = document.getElementById('myChart2');

                                        new Chart(ctx2, {
                                            type: 'bar',
                                            data: {
                                                labels: ['Pondělí', 'Úterý', 'Středa', 'Čtvrtek', 'Pátek', 'Sobota'],
                                                datasets: [{
                                                    label: 'Zásilka DPD-2025-01-00023',
                                                    data: [0,0,2,1,0,3],
                                                    borderWidth: 2,
                                                    // borderColor: '#1b4332',
                                                    // backgroundColor: '#2d6a4f',
                                                }],
                                            },
                                            options: {
                                                scales: {
                                                    y: {
                                                        beginAtZero: true
                                                    }
                                                }
                                            },

                                        });
                                    </script>
                                @endverbatim
                               
                            </div>
                        </div>
                        <div class="dark:bg-gray-800 bg-white p-6 text-gray-900 dark:text-gray-100 flex justify-between">
                            <div>
                                <h2 class="font-semibold text-xl dark:text-gray-200 leading-tight mb-1">Zásilka dorazila rozbitá?</h2>
                                <p class="text-gray-400">Číslo zásilky: #2341-12-2024</p>
                            </div>
                            <a href="/reklamace/1" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">Vygenerovat report </a>
                        </div>
                    @endif
                    
            </div>
        </div>
    </div>
</x-app-layout>

