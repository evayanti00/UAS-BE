<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Event</title>

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
            <h2>Tambah Event</h2>
            <p>Buat event baru untuk peserta.</p>
        </div>

        <!-- Form -->
        <div class="table-container">

            <form action="" method="POST" enctype="multipart/form-data">

                <div class="mb-3">
                    <label class="form-label">
                        Nama Event
                    </label>

                    <input
                        type="text"
                        class="form-control"
                        placeholder="Masukkan nama event">
                </div>

                <div class="mb-3">
                    <label class="form-label">
                        Kategori Event
                    </label>

                    <select class="form-select">
                        <option>Pilih Kategori</option>
                        <option>Seminar</option>
                        <option>Workshop</option>
                        <option>Lomba</option>
                        <option>Pameran</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">
                        Kuota Peserta
                    </label>

                    <input
                        type="number"
                        class="form-control"
                        placeholder="Contoh: 100">
                </div>

                <div class="mb-3">
                    <label class="form-label">
                        Tanggal Event
                    </label>

                    <input
                        type="datetime-local"
                        class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">
                        Deskripsi Event
                    </label>

                    <textarea
                        class="form-control"
                        rows="5"
                        placeholder="Deskripsikan event"></textarea>
                </div>

                <div class="mb-4">
                    <label class="form-label">
                        Upload Poster Event
                    </label>

                    <input
                        type="file"
                        class="form-control">
                </div>

                <div class="d-flex gap-2">

                    <button
                        type="submit"
                        class="btn btn-primary">
                        Simpan Event
                    </button>

                    <a
                        href="event.php"
                        class="btn btn-secondary">
                        Kembali
                    </a>

                </div>

            </form>

        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>