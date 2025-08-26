@extends('layouts.app')

@section('content')
<style>
  /* Contenedor para limitar tamaño de los gráficos */
  .chart-container {
    max-width: 450px;
    height: 280px;
    margin: 0 auto; /* Centrar dentro de la card-body */
  }
</style>

<div class="container py-5">
    <h1 class="mb-5 fw-bold text-center text-primary">
        <i class="bi bi-speedometer2 me-2"></i>Dashboard de Reportes
    </h1>

    <div class="row g-4 justify-content-center">
        <!-- Ventas por Mes -->
        <div class="col-lg-6 d-flex justify-content-center">
            <div class="card shadow-sm rounded-4 border-0 w-100">
                <div class="card-header bg-primary bg-gradient text-white fw-semibold rounded-top-4">
                    <i class="bi bi-bar-chart-line me-2"></i>Ventas por Mes
                </div>
                <div class="card-body bg-light d-flex justify-content-center">
                    <div class="chart-container">
                        <canvas id="ventasPorMes"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Ventas por Zona -->
        <div class="col-lg-6 d-flex justify-content-center">
            <div class="card shadow-sm rounded-4 border-0 w-100">
                <div class="card-header bg-success bg-gradient text-white fw-semibold rounded-top-4">
                    <i class="bi bi-pie-chart-fill me-2"></i>Ventas por Zona
                </div>
                <div class="card-body bg-light d-flex justify-content-center">
                    <div class="chart-container">
                        <canvas id="ventasPorZona"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4 justify-content-center mt-1">
        <!-- Top Productos Stock -->
        <div class="col-lg-6 d-flex justify-content-center">
            <div class="card shadow-sm rounded-4 border-0 w-100">
                <div class="card-header bg-warning bg-gradient text-dark fw-semibold rounded-top-4">
                    <i class="bi bi-box-seam me-2"></i>Top Productos con más Stock
                </div>
                <div class="card-body bg-light d-flex justify-content-center">
                    <div class="chart-container">
                        <canvas id="topStockChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stock por Género -->
        <div class="col-lg-6 d-flex justify-content-center">
            <div class="card shadow-sm rounded-4 border-0 w-100">
                <div class="card-header bg-info bg-gradient text-white fw-semibold rounded-top-4">
                    <i class="bi bi-gender-ambiguous me-2"></i>Stock por Género
                </div>
                <div class="card-body bg-light d-flex justify-content-center">
                    <div class="chart-container">
                        <canvas id="stockGeneroChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabla Productos -->
    <div class="card shadow-sm rounded-4 border-0 mt-5">
        <div class="card-header bg-dark bg-gradient text-white fw-semibold rounded-top-4">
            <i class="bi bi-table me-2"></i>Listado de Productos
        </div>
        <div class="card-body table-responsive p-0">
            <table class="table table-striped table-hover align-middle mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>SKU</th>
                        <th>Marca</th>
                        <th>Producto</th>
                        <th>Género</th>
                        <th>Cantidad</th>
                        <th>Valor Compra</th>
                        <th>Venta Norte</th>
                        <th>Venta Sur</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($productos as $producto)
                    <tr>
                        <td>{{ $producto->sku }}</td>
                        <td>{{ $producto->marca }}</td>
                        <td>{{ $producto->producto }}</td>
                        <td>{{ $producto->genero }}</td>
                        <td>{{ $producto->cantidad }}</td>
                        <td>${{ number_format($producto->valor_compra, 0, ',', '.') }}</td>
                        <td>${{ number_format($producto->valor_venta_norte, 0, ',', '.') }}</td>
                        <td>${{ number_format($producto->valor_venta_sur, 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Opciones comunes para todos los gráficos
    const chartOptions = {
        responsive: true,
        maintainAspectRatio: false,
        aspectRatio: 1.6,
        scales: {
            y: {
                beginAtZero: true
            }
        }
    };

    // Ventas por Mes
    const ctxMes = document.getElementById('ventasPorMes').getContext('2d');
    new Chart(ctxMes, {
        type: 'bar',
        data: {
            labels: {!! json_encode($ventasPorMes->pluck('mes')) !!},
            datasets: [{
                label: 'Ventas por Mes',
                data: {!! json_encode($ventasPorMes->pluck('total')) !!},
                backgroundColor: 'rgba(54, 162, 235, 0.7)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: chartOptions
    });

    // Ventas por Zona
    const ctxZona = document.getElementById('ventasPorZona').getContext('2d');
    new Chart(ctxZona, {
        type: 'pie',
        data: {
            labels: {!! json_encode($ventasPorZona->pluck('zona')) !!},
            datasets: [{
                data: {!! json_encode($ventasPorZona->pluck('total')) !!},
                backgroundColor: ['#FF6384', '#36A2EB'],
            }]
        },
        options: { responsive: true, maintainAspectRatio: false }
    });

    // Top Productos con más Stock
    const ctxStock = document.getElementById('topStockChart').getContext('2d');
    new Chart(ctxStock, {
        type: 'bar',
        data: {
            labels: {!! json_encode($topStock->pluck('producto')) !!},
            datasets: [{
                label: 'Stock',
                data: {!! json_encode($topStock->pluck('cantidad')) !!},
                backgroundColor: 'rgba(255, 206, 86, 0.7)',
                borderColor: 'rgba(255, 206, 86, 1)',
                borderWidth: 1
            }]
        },
        options: chartOptions
    });

    // Stock por Género
    const ctxGenero = document.getElementById('stockGeneroChart').getContext('2d');
    new Chart(ctxGenero, {
        type: 'pie',
        data: {
            labels: {!! json_encode($stockPorGenero->pluck('genero')) !!},
            datasets: [{
                data: {!! json_encode($stockPorGenero->pluck('total')) !!},
                backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56'],
            }]
        },
        options: { responsive: true, maintainAspectRatio: false }
    });
</script>
@endsection
