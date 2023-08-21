<div class="content-inner w-100">
    <!-- Page Header-->
    <header class="bg-white shadow-sm px-4 py-3 z-index-20">
        <div class="container-fluid px-0">
            <h2 class="mb-0 p-1">Estadisticas</h2>
        </div>
    </header>
    <div class="container-fluid">
        <!-- Pie Charts -->
        <div class="row mt-2">
            <div class="col-xl-6 col-lg-6">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Registros por mes (Barras)</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="chart-pie pt-4 pb-2">
                            <canvas id="barChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 h-50 d-inline-block">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Registros por mes (Torta) </h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="chart-pie pt-4 pb-2">
                            <canvas id="pieChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row mt-2">
            <div class="col-xl-12 col-lg-12">
                <div class="card shadow mb-4">
                    <!-- Encabezado de la Tarjeta - Desplegable -->
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Registros por mes (Línea)</h6>
                    </div>
                    <!-- Cuerpo de la Tarjeta -->
                    <div class="card-body">
                        <div class="chart-line pt-4 pb-2">
                            <canvas id="lineChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
// Fetch data from the server and parse it
let registros_x_mes = <?php echo json_encode($registros_x_mes) ?>;
let meses = [];
let totales = [];

registros_x_mes.forEach(item => {
    // Use JavaScript Date to get month names
    let monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September",
        "October", "November", "December"
    ];
    meses.push(monthNames[item.mes - 1]); // Month numbers start from 1
    totales.push(item.total);
});

// Bar chart configuration
const barCtx = document.getElementById('barChart').getContext('2d');
const barConfig = {
    type: 'bar',
    data: {
        labels: meses,
        datasets: [{
            label: 'Total de registros por mes',
            data: totales,
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
};

// Create and display the bar chart
new Chart(barCtx, barConfig);

// Pie chart configuration
const pieCtx = document.getElementById('pieChart').getContext('2d');
const pieConfig = {
    type: 'pie',
    data: {
        labels: meses,
        datasets: [{
            label: 'Total de registros por mes',
            data: totales,
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                // ... add more colors as needed
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                // ... add more colors as needed
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
};

// Create and display the pie chart
new Chart(pieCtx, pieConfig);


// Configuración del gráfico de línea
const lineCtx = document.getElementById('lineChart').getContext('2d');
const lineConfig = {
    type: 'line',
    data: {
        labels: meses,
        datasets: [{
            label: 'Total de registros por mes',
            data: totales,
            fill: false,
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 2
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
};

// Crear y mostrar el gráfico de línea
new Chart(lineCtx, lineConfig);
</script>