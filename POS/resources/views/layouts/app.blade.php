<!DOCTYPE html> <!-- Menentukan tipe dokumen sebagai HTML -->
<html lang="id"> <!-- Awal dokumen HTML dengan bahasa Indonesia -->
<head>
    <meta charset="UTF-8"> <!-- Menentukan encoding karakter -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Agar tampilan responsif di perangkat mobile -->
    <title>POS - @yield('title')</title> <!-- Bagian title yang bisa diubah di setiap halaman -->

    <!-- Import Bootstrap dari CDN untuk styling -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">POS System</a> <!-- Logo sistem POS -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}">Home</a> <!-- Link ke halaman utama -->
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/product') }}">Products</a> <!-- Link ke produk -->
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/sales') }}">Sales</a> <!-- Link ke transaksi -->
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Kontainer untuk konten halaman -->
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-8 offset-md-2"> <!-- Membuat konten lebih terpusat -->
                @yield('content') <!-- Tempat untuk menampilkan konten dari halaman lain -->
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="text-center mt-4 p-3 bg-light">
        <p class="mb-0">&copy; 2025 POS System. All Rights Reserved.</p> <!-- Copyright footer -->
    </footer>

    <!-- Import Bootstrap JavaScript untuk fitur interaktif -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> <!-- Akhir HTML -->
