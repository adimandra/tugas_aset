<!DOCTYPE html>
<html lang="en">
<head>
    @include('Template.head')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card {
            margin-left: 10px; /* Menambahkan margin dari kiri untuk menggeser card */
            margin-right: 10px;
        }
        .btn-custom-color {
        background-color: #007bff; /* Sesuaikan dengan warna khusus yang diinginkan */
        border-color: #007bff;     /* Sesuaikan dengan warna border */
        color: #ffffff;            /* Warna teks */
        }

        .btn-custom-color:hover {
            background-color: #0056b3; /* Warna latar belakang saat hover */
            border-color: #004085;     /* Warna border saat hover */
        }

        .btn-secondary {
            background-color: #6c757d; /* Warna latar belakang tombol sekunder */
            border-color: #6c757d;     /* Warna border tombol sekunder */
            color: #ffffff;            /* Warna teks tombol sekunder */
        }

        .btn-secondary:hover {
            background-color: #5a6268; /* Warna latar belakang saat hover tombol sekunder */
            border-color: #545b62;     /* Warna border saat hover tombol sekunder */
        }
    </style>
</head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Tambah Data Aset</title>

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
                        <h1 class="m-0">Tambah Data Aset</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="card card-info card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Form Tambah Data Aset</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('assets.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="nama_aset">Nama Aset</label>
                                <input type="text" id="nama_aset" name="nama_aset" class="form-control" placeholder="Nama Aset" required>
                            </div>

                            <div class="form-group">
                                <label for="keterangan">Keterangan</label>
                                <input type="text" id="keterangan" name="keterangan" class="form-control" placeholder="Keterangan">
                            </div>

                            <div class="form-group">
                                <label for="kategori">Pilih Kategori:</label>
                                <select id="kategori" name="kategori_id" class="form-control" required>
                                    <option value="" disabled selected>--Pilih kategori--</option>
                                    @foreach ($kategori as $item)
                                    <option value="{{ $item->id }}">{{ $item->kategori}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="gambar">Upload File Aset</label>
                                <input type="file" id="gambar" name="profile_picture" class="form-control-file" accept="image/*">
                            </div>

                            <!-- Tombol Submit -->
                            <div class="form-group d-flex justify-content-end">
                                <button type="submit" class="btn btn-success me-1">Simpan</button>
                                <a href="{{ route('assets.index') }}" class="btn btn-secondary">Kembali</a>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
        <div class="p-3">
            <h5>Title</h5>
            <p>Sidebar content</p>
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

</body>
</html>
