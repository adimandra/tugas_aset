<!DOCTYPE html>
<html lang="en">
<head>
  @include('Template.head')

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .dropdown-item .btn-link {
      text-decoration: none;
    }
    .btn-custom-color {
      background-color: #1c17ae;
      color: white;
      border: none;
      padding: 5px 10px;
      border-radius: 10px;
      margin-left: 10px;
    }
    .card {
      margin: 15px; /* Menambahkan margin untuk kartu */
    }
    .modal-dialog {
      max-width: 80%;
    }
    .modal-body img {
      width: 100%;
    }
  </style>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  @include('Template.navbar')
  @include('Template.sidebar')

  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h3>Tambah Kategori Aset</h3>
          </div>
        </div>
      </div>
    </div>

    <div class="content">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-12">
            <div class="card card-info card-outline">
              <div class="card-header">
                <h4 class="card-title">Tambah Kategori</h4>
              </div>
              <div class="card-body">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>
                                @if ($error == 'The kategori has already been taken.')
                                    Kategori sudah digunakan.
                                @elseif ($error == 'The keterangan field must be a string.')
                                    Keterangan harus berupa teks.
                                @else
                                    {{ $error }} <!-- Pesan kesalahan lainnya tetap ditampilkan -->
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
                <form action="{{ route('kategori.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="kategori">Kategori</label>
                        <input type="text" class="form-control" name="kategori" required>
                    </div>
                    <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <textarea class="form-control" name="keterangan"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>

              </div>
            </div>
            <div class="form-group d-flex justify-content-end">
              <a href="{{ route('kategori.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <aside class="control-sidebar control-sidebar-dark"></aside>

  <footer class="main-footer">
    @include('Template.footer')
  </footer>
</div>

@include('Template.script')

</body>
</html>
