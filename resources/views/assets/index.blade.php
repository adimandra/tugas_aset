<!DOCTYPE html>
<html lang="en">
<head>
  @include('Template.head')

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
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
            <h3>Data Aset</h3>
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
                    <a href="{{ route('assets.create') }}" class="btn btn-success">Tambah <i class="fas fa-plus-square"></i></a>
                </div>
              </div>
              <div class="card-body">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th style="text-align: center;">No</th>
                      <th style="text-align: center;">Kode Aset</th>
                      <th style="text-align: center;">Nama Aset</th>
                      <th style="text-align: center;">Kategori</th>
                      <th style="text-align: center;">Keterangan</th>
                      <th style="text-align: center;">Link Aset</th>
                      <th style="text-align: center;">Tipe File</th>
                      <th style="text-align: center;">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($assets as $asset)
                      <tr>
                        <td style="text-align: center;">{{ $loop->iteration }}</td>
                        <td style="text-align: center;">{{ $asset->kode_aset }}</td>
                        <td style="text-align: center;">{{ $asset->nama_aset }}</td>
                        <td style="text-align: center;">
                          @if($asset->kategori) <!-- Cek apakah kategori tidak null -->
                            {{ $asset->kategori->kategori }}
                          @else
                            Tidak ada kategori
                          @endif
                        </td>
                        <td style="text-align: center;">{{ $asset->keterangan }}</td>
                        <td style="text-align: center;">
                          @if($asset->link_aset)
                            <a href="{{ asset('Gambar/' . basename($asset->link_aset)) }}" class="link-aset" target="_blank">
                              {{ basename($asset->link_aset) }}
                            </a>
                          @else
                            Tidak ada gambar
                          @endif
                        </td>
                        <td style="text-align: center;">{{ $asset->tipe_file }}</td>
                        <td style="text-align: center;">
                          <div class="d-flex flex-column align-items-start">
                            <a href="{{ route('assets.edit', $asset->id) }}" class="btn btn-warning btn-sm mb-2">
                              <i class="fas fa-edit"></i> Edit
                            </a>
                            <form id="delete-form-{{ $asset->id }}" action="{{ route('assets.destroy', $asset->id) }}" method="POST" style="display:inline;">
                              @csrf
                              @method('DELETE')
                              <button type="button" class="btn btn-danger btn-sm mb-2 btn-delete" data-id="{{ $asset->id }}">
                                <i class="fas fa-trash-alt"></i> Delete
                              </button>
                            </form>
                            <a href="{{ route('assets.perbarui', $asset->id) }}" class="btn btn-primary btn-sm">
                              <i class="fas fa-sync-alt"></i> Perbarui
                            </a>
                          </div>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>

                </table>
              </div>
            </div>
            <div class="form-group d-flex justify-content-end">
              <a href="{{ route('beranda') }}" class="btn btn-secondary">Kembali</a>
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



