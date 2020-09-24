$(document).ready(function () {
    if ($('#myChart').length) {
        initChart();
    }
})

var myChart;

function initChart() {
    myChart = new Chart($('#myChart'), {
        type: 'line',
        data: {
            labels: labels,
            datasets:
                [{
                    label: 'Заказы',
                    data: chartOrders,
                    borderColor: 'rgba(31, 120, 180, 1)',
                    backgroundColor: 'rgba(31, 120, 180, 0.2)',
                    borderWidth: 1
                },
                {
                    label: 'Продукты',
                    data: chartProducts,
                    borderColor: 'rgba(178, 223, 138, 1)',
                    backgroundColor: 'rgba(178, 223, 138, 0.2)',
                    borderWidth: 1
                },
                {
                    label: 'Сумма',
                    data: chartSum,
                    borderColor: 'rgba(166, 206, 227, 1)',
                    backgroundColor: 'rgba(166, 206, 227, 0.2)',
                    borderWidth: 1
                },
            ]},
            options: {
                scales: {
                    xAxes: [],
                        yAxes: [{
                        ticks: {
                            beginAtZero:true
                        }
                    }]
                }
            }
        });
    }

function getChartDays(value) {
    $.ajax({
        type: 'POST',
        url: '/chart-data/' + value,
        data: value,
        headers: { 'X-CSRF-TOKEN': CSRF_TOKEN },
        success: function (jsonResponse) {
            myChart.data.labels.splice(0, myChart.data.labels.length);
            myChart.data.datasets.forEach((dataset) => {
                dataset.data.splice(0, dataset.data.length);
            });
            myChart.update();

            jsonResponse.labels.map((label,k) => {
                myChart.data.labels.push(label);
            })

            jsonResponse.diagramData.map((diagramData) => {
                myChart.data.datasets[0].data.push(diagramData.ordersTotal) ;
                myChart.data.datasets[1].data.push(diagramData.qty);
                myChart.data.datasets[2].data.push(diagramData.sum);
            });

            myChart.update();
        }
    });
}
