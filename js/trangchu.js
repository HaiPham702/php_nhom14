const ctx = document.getElementById('myChart');

var dataChart = {
    labels: [],
    data: []
}


function setData(val) {
    dataChart.labels = val.map(item => item.StockName)
    dataChart.data = val.map(item => item.TotalProduct)

    new Chart(ctx, {
        type: 'bar',
        data: {
          labels: dataChart.labels,
          datasets: [{
            label: 'Sản phẩm',
            data: dataChart.data,
            borderWidth: 2,
            backgroundColor: [
              'rgba(255, 99, 132, 0.2)',
              'rgba(255, 159, 64, 0.2)',
              'rgba(255, 205, 86, 0.2)',
              'rgba(75, 192, 192, 0.2)',
              'rgba(54, 162, 235, 0.2)',
              'rgba(153, 102, 255, 0.2)'
            ],
          }]
        },
        options: {
          scales: {
            y: {
              beginAtZero: true
            },
            x: {
                grid: {
                  offset: true
                }
            }
            
          }
        }
      });
}