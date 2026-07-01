<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Event</title>

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
            <h2>Detail Event</h2>
            <p>Informasi lengkap mengenai event.</p>
        </div>

        <div class="table-container">

            <div class="row">

                <!-- Poster Event -->
                <div class="col-md-4">

                    <img
                        src="https://via.placeholder.com/400x550?text=Poster+Event"
                        class="img-fluid rounded shadow-sm"
                        alt="Poster Event">

                </div>

                <!-- Detail -->
                <div class="col-md-8">

                    <h3 class="mb-3">
                        Seminar Artificial Intelligence
                    </h3>

                    <table class="table">

                        <tr>
                            <th width="200">Kategori</th>
                            <td>Seminar</td>
                        </tr>

                        <tr>
                            <th>Kuota Peserta</th>
                            <td>100 Orang</td>
                        </tr>

                        <tr>
                            <th>Tanggal Event</th>
                            <td>10 Juli 2026</td>
                        </tr>

                        <tr>
                            <th>Status</th>
                            <td>
                                <span class="badge bg-success">
                                    Aktif
                                </span>
                            </td>
                        </tr>

                        <tr>
                            <th>Penyelenggara</th>
                            <td>RADE</td>
                        </tr>

                    </table>

                    <h5 class="mt-4">
                        Deskripsi Event
                    </h5>

                    <p class="text-muted">
                        Seminar Artificial Intelligence merupakan kegiatan
                        yang membahas perkembangan teknologi AI,
                        machine learning, serta penerapannya dalam dunia
                        industri dan pendidikan.
                    </p>

                    <div class="mt-4">

                        <a href="edit-event.php"
                           class="btn btn-warning">
                            Edit Event
                        </a>

                        <a href="event.php"
                           class="btn btn-secondary">
                            Kembali
                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>