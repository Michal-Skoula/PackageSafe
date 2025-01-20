<div>
{{--    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>--}}
    
    
    <canvas id="{{$graph_id}}"></canvas>
    
    <script>
        
        const {{$graph_id}} = document.getElementById('{{$graph_id}}');

        new Chart({{$graph_id}}, {
            
            type: '{{$graph_type}}',
            data: {
                labels: @json($dates),
                datasets: [{
                    label: '{{ $tower_name }}',
                    data: @json($values),
                    borderWidth: 3,
                    borderColor: '{{$outline_color}}',
                    backgroundColor: '{{$fill_color}}',
                }],
            },
            options: {
                scales: {
                    y: {
                        // beginAtZero: true
                    }
                }
            },

        });
    </script>
</div>
