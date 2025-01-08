<x-app-layout>
    <x-session_error></x-session_error>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-sm sm:rounded-lg flex flex-col gap-6">
                <div class="dark:bg-gray-800 bg-white p-6 text-gray-900 dark:text-gray-100">
                    <form action="/dashboard" method="POST" id="devicesSwitcher">
                        <label for="device">Current device:</label>
                        <select name="device" id="device" required class="text-black">
                            @foreach($devices as $device)
                                <option value="{{$device['device_id']}}">{{$device['name']}}</option>
                            @endforeach
                        </select>
                        <script>
                            const deviceSelector = document.getElementById('device');
                            const devicesSwitcher = document.getElementById('devicesSwitcher');
                            
                            deviceSelector.addEventListener('change', (e) => {
                                devicesSwitcher.submit();
                            })
                        </script>
                    </form>
                    <div>
                        <p>Připojení: OK</p>
                    </div>
                </div>
                <div class="dark:bg-gray-800 bg-white p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="font-medium text-xl dark:text-gray-200 leading-tight">Aktuálně</h2>
                    <ul class="grid lg:grid-cols-4 md:grid-cols-2 grid-cols-1">
                       <li class="p-4">
                           <svg
                               class="h-16 w-16"
                               xmlns="http://www.w3.org/2000/svg"
                               viewBox="0 -960 960 960">
                                    <path
                                        class="{{$current->temperature_color or '#fff'}}"
                                        d="M520-520v-80h200v80H520Zm0-160v-80h320v80H520ZM320-120q-83 0-141.5-58.5T120-320q0-48 21-89.5t59-70.5v-240q0-50 35-85t85-35q50 0 85 35t35 85v240q38 29 59 70.5t21 89.5q0 83-58.5 141.5T320-120ZM200-320h240q0-29-12.5-54T392-416l-32-24v-280q0-17-11.5-28.5T320-760q-17 0-28.5 11.5T280-720v280l-32 24q-23 17-35.5 42T200-320Z"/>
                           </svg>
                           <h3 class="">24 &deg;C</h3>
                       </li>
                    </ul>
                    
                </div>
                <div class="dark:bg-gray-800 bg-white p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="font-medium text-xl dark:text-gray-200 leading-tight">Aktuální hodnoty senzorů</h2>
                    <div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
