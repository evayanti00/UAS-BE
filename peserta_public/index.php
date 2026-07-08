<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Kampus</title>

    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg bg-white shadow-sm sticky-top">
    <div class="container position-relative">

        <!-- Logo -->
        <a class="navbar-brand fw-bold text-primary fs-3" href="#">
            SME
        </a>

        <!-- Tombol HP -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Menu Tengah -->
        <div class="collapse navbar-collapse justify-content-center" id="navbarMenu">
            <ul class="navbar-nav">

                <li class="nav-item">
                    <a class="nav-link active fw-bold" href="index.php">
                        Home
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link fw-bold" href="../dashboard-panitia/pendaftar.php">
                        Login
                    </a>
                </li>

            </ul>
        </div>

    </div>
</nav>
<main>

    <section class="hero text-center">
        <div class="container">
            <h1 class="fw-bold">Sistem Pendaftaran Event Kampus</h1>
            <p class="lead">
                Temukan seminar, workshop, lomba dan kegiatan kampus terbaru.
            </p>
        </div>
    </section>

    <section class="container my-5">
        <h2 class="text-center mb-4">Event Kampus</h2>

        <div class="row">

            <div class="col-md-6 mb-4">
                <div class="card shadow h-100">

                    <img src="assets/images/himatography_1.jpeg"
                         class="card-img-top event-img"
                         alt="Lomba Foto Nasional">

                    <div class="card-body">
                        <h5 class="card-title">Lomba Foto Nasional 2026</h5>

                        <p>📅 Pendaftaran : 12 April - 15 Juli 2026</p>
                        <p>💰 Biaya : Rp50.000</p>

                        <a href="detail_event.php?id=1"
                           class="btn btn-primary">
                            Lihat Detail
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-4">
                <div class="card shadow h-100">

                    <img src="assets/images/geteksi_1.jpeg"
                         class="card-img-top event-img"
                         alt="GETEKSI VOL. 3">

                    <div class="card-body">
                        <h5 class="card-title">GETEKSI VOL. 3</h5>

                        <p>📅 07 Juni 2026</p>
                        <p>📍 Aula ITB STIKOM Bali & Zoom Meeting</p>

                        <a href="detail_event.php?id=2"
                           class="btn btn-primary">
                            Lihat Detail
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </section>

<?php include 'components/footer.php'; ?>

</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>