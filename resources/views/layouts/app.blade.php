<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arsip Surat</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <style>
        /* === Sidebar Styling === */
        .sidebar {
            background-color: #6a0dad; /* Warna Ungu */
            min-height: 100vh;
            padding: 20px;
            width: 250px;
        }

        .sidebar h4 {
            font-size: 24px;
            font-weight: bold;
            color: #ffffff;
            margin-bottom: 25px;
            text-align: center;
        }

        .sidebar .nav-link {
            font-size: 18px;
            color: #ffffff;
            padding: 10px 5px;
            border-radius: 8px;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .sidebar .nav-link:hover {
            background-color: #580b99; /* Warna ungu lebih gelap saat hover */
            color: #ffd700; /* Kuning saat hover */
        }

        /* Konten utama */
        .content {
            flex-grow: 1;
            padding: 20px;
            background-color: #f8f9fa;
        }
    </style>
</head>
<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <div class="sidebar">
            <h4>Menu</h4>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('surat.index') }}">⭐ Arsip</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('kategori.index') }}">⚙️ Kategori Surat</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('about') }}">ⓘ About</a>
                </li>
            </ul>
        </div>

        <!-- Konten -->
        <div class="content">
            @yield('content')
        </div>
    </div>
</body>
</html>
