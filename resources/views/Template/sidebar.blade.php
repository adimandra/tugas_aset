<!DOCTYPE html>
<html lang="en">
<head>

    <style>
        .main-sidebar {
            background-color: #05284a !important; /* Ubah warna sesuai keinginan */
        }

        .user-panel .info span {
            color: white !important;
            font-size: 20pt;
            font-weight: bold;
        }

        .user-panel .image img {
            width: 50px; /* Sesuaikan ukuran lebar */
            height: 50px; /* Sesuaikan ukuran tinggi */
            object-fit: cover; /* Mengatur agar gambar sesuai dengan ukuran */
        }

        .user-panel,
        .brand-link {
            border-bottom: none !important;
        }

        /* Menghilangkan scroll bar di sidebar */
        .sidebar {
            overflow-x: hidden;
        }

        /* Gaya untuk tulisan */
        .info span {
            font-size: 12pt !important; /* Ukuran font */
            font-family: 'Arial', sans-serif; /* Jenis font */
            color: #fff; /* Warna teks */
            font-weight: bold; /* Tebal font */
            font-style: italic; /* Gaya miring */
            letter-spacing: 1px; /* Spasi antar huruf */
            word-spacing: 3px; /* Spasi antar kata */
            line-height: 1.6; /* Jarak antar baris */
        }

        .info {
            text-align: center;
        }
    </style>
</head>
<body>

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('Gambar/logo_1.jpeg') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <span class="font-weight-light">Aset<br>Sistem Tersentral</span>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('beranda') }}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('assets.index') }}" class="nav-link">
                        <i class="fas fa-box nav-icon"></i>
                        <p>Data Aset</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('kategori.index') }}" class="nav-link">
                        <i class="fas fa-box nav-icon"></i>
                        <p>Kategori Data Aset</p>
                    </a>
                </li>

            </ul>
        </nav>

    </div>
</aside>

</body>
</html>
