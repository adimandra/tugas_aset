<!DOCTYPE html>
<html lang="id">
<head>
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css' rel='stylesheet' />
    <title>Dashboard</title>
    @include('Template.head')
    <style>
        body {
            background-color: #f4f6f9; /* Background color for the whole page */
        }

        .small-box .inner {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            height: 100%; /* Vertikal tengah */
        }

        .small-box {
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .small-box:hover {
            transform: scale(1.05);
        }

        .chart-container {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .content-header h3 {
            font-weight: bold;
            margin-bottom: 15px;
        }

        /* Style untuk canvas grafik */
        #myChart {
            max-width: 100%;
            margin: 10px;
        }

    </style>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  @include('Template.navbar')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @include('Template.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h3>Dashboard</h3>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- Grafik Data Aset -->
                <div class="col-md-8">
                    <div class="chart-container">
                        <h4 class="text-center">Grafik Jumlah Aset</h4>
                        <canvas id="myChart"></canvas>
                    </div>
                </div>

                <!-- Card Total Aset -->
                <div class="col-md-4">
                    <a href="{{ route('assets.index') }}" style="text-decoration: none; color: inherit;">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>10</h3>
                            <p>Total Aset</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-boxes"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <div class="p-3">
      <h5>Judul</h5>
      <p>Konten sidebar</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    @include('Template.footer')
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
@include('Template.script')

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const ctx = document.getElementById('myChart').getContext('2d');
    const myChart = new Chart(ctx, {
        type: 'bar', // Jenis grafik (bar, line, pie, dll)
        data: {
            labels: {!! json_encode($label_kategori) !!},
            datasets: [{
                label: 'Jumlah Aset',
                data: {{ json_encode($count_data) }}, // Ganti dengan data yang sesuai
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Jumlah'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Nama Aset'
                    }
                }
            }
        }
    });
</script>

</body>
</html>
