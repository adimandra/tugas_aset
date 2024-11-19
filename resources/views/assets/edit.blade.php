<!DOCTYPE html>
<html lang="en">
<head>
    @include('Template.head')
    <title>Edit Aset</title>
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
                        <h1 class="m-0">Edit Data Aset</h1>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="card card-info card-outline">

                    <div class="card-body">
                        <!-- Form untuk Edit Aset -->
                        <form action="{{ route('assets.update', $asset->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <!-- Nama Aset -->
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="nama_aset">Nama Aset</label>
                                        <input type="text" id="nama_aset" name="nama_aset" class="form-control" value="{{ old('nama_aset', $asset->nama_aset) }}" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="nama_aset">Keterangan</label>
                                        <textarea id="keterangan" name="keterangan" class="form-control" rows="3" required>{{ $asset->keterangan }}</textarea>
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
                                </div>

                            </div>
                            <!-- Tombol Submit -->
                            <div class="form-group d-flex justify-content-end">
                                <button type="submit" class="btn btn-success" style="margin-right: 4px;">Simpan</button>
                                <a href="{{ route('assets.index') }}" class="btn btn-secondary">Kembali</a>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.content -->
    </div>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
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
