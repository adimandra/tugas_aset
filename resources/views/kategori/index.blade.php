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
      margin-left: 6px;
      margin-right: 6px;
    }

    .modal-dialog {
        max-width: 60%;
        margin: auto;
    }

    .modal-content {
        padding: 15px;
        border-radius: 8px;
        box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.2);

    }

    .modal-body img {
        width: auto;
        max-width: 100%; /* Maksimal lebar modal */
        max-height: 80vh; /* Batas tinggi agar tidak keluar layar */
        object-fit: contain;
        border: 3px solid #f0f0f0;
        border-radius: 8px;
        box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.1);

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
            <h3>Ketegori Data Aset</h3>
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
                <div class="card-tools">
                    <a href="{{ route('kategori.create') }}" class="btn btn-success">Tambah <i class="fas fa-plus-square"></i></a>
                </div>
              </div>
              <div class="card-body">
                <table class="table table-bordered">
                    <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>Kategori</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kategori as $k)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $k->kategori }}</td>
                                <td>{{ $k->keterangan }}</td>
                                <td>
                                    <a href="{{ route('kategori.edit', $k->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('kategori.destroy', $k->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus kategori ini?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div class="form-group d-flex justify-content-end">
            <a href="{{ route('beranda') }}" class="btn btn-secondary">Kembali</a>
        </div>
      </div>
    </div>
  </div>

  <aside class="control-sidebar control-sidebar-dark"></aside>

  <footer class="main-footer">
    @include('Template.footer')
  </footer>
</div>

<!-- Modal untuk menampilkan gambar -->
<div class="modal fade" id="fileModal" tabindex="-1" role="dialog" aria-labelledby="fileModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="fileModalLabel">Gambar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <img id="modalImage" src="" alt="Gambar" class="img-fluid">
      </div>
    </div>
  </div>
</div>

@include('Template.script')

<script>
  $(document).on('click', '.link-aset', function() {
      var imageUrl = $(this).data('image');
      console.log('Image URL:', imageUrl); // Debug URL
      $('#modalImage').attr('src', imageUrl);
  });
</script>

</body>
</html>
