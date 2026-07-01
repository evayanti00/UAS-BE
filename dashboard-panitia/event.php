<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Event</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="../assets/css/dashboard.css">
</head>
<body>

<?php include '../components/sidebar.php'; ?>

<div class="main-content">

    <?php include '../components/navbar.php'; ?>

    <div class="container-fluid">

        <!-- Judul -->
        <div class="page-title">
            <h2>Kelola Event</h2>
            <p>Daftar seluruh event yang telah dibuat.</p>
        </div>

        <!-- Statistik -->
        <div class="row mb-4">

            <div class="col-md-4">
                <div class="event-card purple">
                    <h5>Total Event</h5>
                    <h2>12</h2>
                    <small>Event Terdaftar</small>
                </div>
            </div>

            <div class="col-md-4">
                <div class="event-card blue">
                    <h5>Event Aktif</h5>
                    <h2>8</h2>
                    <small>Sedang Berjalan</small>
                </div>
            </div>

            <div class="col-md-4">
                <div class="event-card orange">
                    <h5>Event Selesai</h5>
                    <h2>4</h2>
                    <small>Sudah Berakhir</small>
                </div>
            </div>

        </div>

        <!-- Tabel Event -->
        <div class="table-container">

            <div class="table-header">

                <h4>Daftar Event</h4>

                <a href="tambah-event.php" class="btn btn-primary">
                    + Tambah Event
                </a>

            </div>

            <table class="table table-hover align-middle">

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Event</th>
                        <th>Kategori</th>
                        <th>Kuota</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    <tr>
                        <td>1</td>
                        <td>Seminar AI</td>
                        <td>Seminar</td>
                        <td>100</td>
                        <td>10 Juli 2026</td>
                        <td>
                            <span class="badge bg-success">
                                Aktif
                            </span>
                        </td>
                        <td>
                            <a href="detail-event.php" class="btn btn-info btn-sm">
                                Detail
                            </a>

                            <a href="edit-event.php" class="btn btn-warning btn-sm">
                                Edit
                            </a>
                        </td>
                    </tr>

                    <tr>
                        <td>2</td>
                        <td>Workshop UI/UX</td>
                        <td>Workshop</td>
                        <td>50</td>
                        <td>15 Juli 2026</td>
                        <td>
                            <span class="badge bg-success">
                                Aktif
                            </span>
                        </td>
                        <td>
                            <a href="detail-event.php" class="btn btn-info btn-sm">
                                Detail
                            </a>

                            <a href="edit-event.php" class="btn btn-warning btn-sm">
                                Edit
                            </a>
                        </td>
                    </tr>

                    <tr>
                        <td>3</td>
                        <td>Lomba Web</td>
                        <td>Lomba</td>
                        <td>75</td>
                        <td>20 Juli 2026</td>
                        <td>
                            <span class="badge bg-secondary">
                                Selesai
                            </span>
                        </td>
                        <td>
                            <a href="detail-event.php" class="btn btn-info btn-sm">
                                Detail
                            </a>

                            <a href="edit-event.php" class="btn btn-warning btn-sm">
                                Edit
                            </a>
                        </td>
                    </tr>

                </tbody>

            </table>

        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>