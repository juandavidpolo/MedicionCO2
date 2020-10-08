<script src="Highcharts/highcharts.js"></script>
<script src="Highcharts/series-label.js"></script>
<script src="Highcharts/exporting.js"></script>
<script src="Highcharts/export-data.js"></script>
<div id="container"></div>
<script type="text/javascript">
Highcharts.chart('container', {
    chart: {
        zoomType: 'x'
    },
    title: {
        text: 'MEDICION DE CO2  ',
    },
    xAxis: {
        categories: [<?php foreach ($row as $result){ ?>
            '<?php echo htmlentities($result['FECHA']); ?>',
        <?php }?>]
                                    },
    yAxis: {
        title: {
            text: 'PPM'
        }
    },
    legend: {
        layout: 'vertical',
        align: 'right',
        verticalAlign: 'middle'
    },
    plotOptions: {
        series: {
            label: {
                connectorAllowed: false
            }
        }
    },
    series: [{
        name: 'CO2',
        data: [<?php foreach ($row as $result){
            echo htmlentities($result['ppm']).',';
        }?>]
    }],
    responsive: {
        rules: [{
            condition: {
                maxWidth: 500
            },
            chartOptions: {
                legend: {
                    layout: 'horizontal',
                    align: 'center',
                    verticalAlign: 'bottom'
                }
            }
        }]
    },
});
Highcharts.setOptions({
    chart: {
        style: {
            fontFamily:' "Muli", sans-serif;',
        }
    }
});
</script>