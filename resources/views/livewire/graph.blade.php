<div>
{{--    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>--}}
    
    
    <canvas id="chartlivewire"></canvas>
    
    <script>
        
        const ctx = document.getElementById('chartlivewire');

        new Chart(ctx, {
            type: '{{$graph_type}}',
            data: {
                labels: @json($dates),
                datasets: [{
                    label: 'Zásilka #2341-12-2024',
                    data: @json($values),
                    borderWidth: 2,
                    borderColor: '#1b4332',
                    backgroundColor: '#2d6a4f',
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
