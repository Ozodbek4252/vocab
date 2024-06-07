@extends('admin.layout')
@section('content')
    <div class="container-fluid">

        <div class="row">
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Vocab Pie Chart</h4>
                        <div id="pie_chart_vocab" class="apex-charts" dir="ltr"></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Pie Chart</h4>
                        <div id="pie_chart_you_know" class="apex-charts" dir="ltr"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script type="text/javascript">
        $(document).ready(function() {
            let stat = @json($stat);

            // First Pie Chart
            options = {
                chart: {
                    type: 'pie',
                    height: 350
                },
                series: stat.level.values,
                labels: stat.level.names,
                colors: generateColor(stat.level.values.length),
                legend: {
                    show: true,
                    position: 'bottom',
                    horizontalAlign: 'center',
                    verticalAlign: 'middle',
                    floating: false,
                    fontSize: '14px',
                    offsetX: 0,
                    offsetY: 0,
                },
            }
            const chart_vocab = new ApexCharts(document.querySelector('#pie_chart_vocab'),
                options,
            );
            chart_vocab.render();



            // Second Pie Chart
            options2 = {
                chart: {
                    type: 'pie',
                    height: 350
                },
                series: [stat.know, stat.dont_know],
                labels: ['Know', 'Not Know'],
                colors: generateColor(2),
                legend: {
                    show: true,
                    position: 'bottom',
                    horizontalAlign: 'center',
                    verticalAlign: 'middle',
                    floating: false,
                    fontSize: '14px',
                    offsetX: 0,
                    offsetY: 0,
                },
            }
            const chart_you_know = new ApexCharts(document.querySelector('#pie_chart_you_know'),
                options2,
            );
            chart_you_know.render();


            // Generate Random Color
            function generateColor(length) {
                var colors = [];
                for (var i = 0; i < length; i++) {
                    var color = '#' + Math.floor(Math.random() * 16777215).toString(16).padStart(6, '0');
                    colors.push(color);
                }
                return colors;
            }
        });
    </script>
@endsection
