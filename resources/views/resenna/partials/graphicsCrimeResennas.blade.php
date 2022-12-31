<figure class="highcharts-figure">
    <div id="containerCrimeresennas"></div>
</figure>

<script src="<?php echo URL::to('/');?>/public/js/plugins/highcharts/highcharts.js"></script>
<script src="<?php echo URL::to('/');?>/public/js/plugins/highcharts/exporting.js"></script>
<script src="<?php echo URL::to('/');?>/public/js/plugins/highcharts/export-data.js"></script>
<script src="<?php echo URL::to('/');?>/public/js/plugins/highcharts/accessibility.js"></script>

<script>
    Highcharts.chart('containerCrimeresennas', {
        chart: {
            type: 'column'
        },
        title: {
            align: 'center',
            text: 'Cantidad de Reseñas por Delito'
        },
        // subtitle: {
        //     align: 'left',
        //     text: 'Click the columns to view versions. Source: <a href="http://statcounter.com" target="_blank">statcounter.com</a>'
        // },
        accessibility: {
            announceNewData: {
                enabled: true
            }
        },
        xAxis: {
            type: 'category'
        },
        yAxis: {
            title: {
                text: 'Total'
            }

        },
        legend: {
            enabled: false
        },
        plotOptions: {
            series: {
                borderWidth: 0,
                dataLabels: {
                    enabled: true,
                    format: '{point.y}'
                }
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}</b><br/>'
        },

        series: [
            {
                name: "Delito",
                colorByPoint: true,
                data: <?= $data ?>
            }
        ],

    });
</script>