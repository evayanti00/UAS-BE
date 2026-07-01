<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Event</title>

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
            <h2>Edit Event</h2>
            <p>Perbarui informasi event.</p>
        </div>

        <!-- Form Edit -->
        <div class="table-container">

            <form action="" method="POST" enctype="multipart/form-data">

                <div class="mb-3">
                    <label class="form-label">
                        Nama Event
                    </label>

                    <input
                        type="text"
                        class="form-control"
                        value="Seminar Artificial Intelligence">
                </div>

                <div class="mb-3">
                    <label class="form-label">
                        Kategori Event
                    </label>

                    <select class="form-select">

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
                        value="100">
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="from-label">Tanggal Event</label>
                        <input
                            type="date"
                            class="from-control"
                            name="tanggal_event"
                            value="2026-07-10">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="from-label">Waktu Event</label>
                        <input
                            type="time"
                            class="form-control"
                            name="waktu_event"
                            value="09:00">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">
                        Deskripsi Event
                    </label>

                    <textarea
                        class="form-control"
                        rows="5">Seminar Artificial Intelligence merupakan kegiatan yang membahas perkembangan AI dan Machine Learning.</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">
                        Poster Saat Ini
                    </label>

                    <br>

                    <img
                        src="https://via.placeholder.com/250x350?text=Poster+Event"
                        class="img-thumbnail mb-3"
                        alt="Poster Event">
                </div>

                <div class="mb-4">
                    <label class="form-label">
                        Ganti Poster Event
                    </label>

                    <input
                        type="file"
                        class="form-control">
                </div>

                <div class="d-flex gap-2">

                    <button
                        type="submit"
                        class="btn btn-primary">
                        Simpan Perubahan
                    </button>

                    <a
                        href="detail-event.php"
                        class="btn btn-secondary">
                        Batal
                    </a>

                </div>

            </form>

        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>