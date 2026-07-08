<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Event</title>

    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<button id="menu-toggle" class="menu-btn">
    ☰
</button>

<aside id="sidebar" class="sidebar">
    <h2 class="logo">sme</h2>

    <a href="index.php" class="menu">Home</a>
    <a href="daftar_event.php" class="menu active">Pendaftaran Event</a>
</aside>

<main class="content">

    <div class="container py-5">

        <div class="row justify-content-center">

            <div class="col-md-8">

                <div class="card shadow">

                    <div class="card-header bg-success text-white">
                        <h4 class="mb-0">Form Pendaftaran Event</h4>
                    </div>

                    <div class="card-body">

                        <form action="sukses.php" method="POST">

                            <div class="mb-3">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" name="nama" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">NIM</label>
                                <input type="text" class="form-control" name="nim" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Program Studi</label>
                                <select class="form-select" name="prodi" required>
                                    <option value="">-- Pilih Program Studi --</option>
                                    <option>Teknologi Informasi</option>
                                    <option>Sistem Informasi</option>
                                    <option>Sistem Komputer</option>
                                    <option>Bisnis Digital</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Nomor HP</label>
                                <input type="text" class="form-control" name="no_hp" required>
                            </div>

                            <button type="submit" class="btn btn-success">
                                Daftar Sekarang
                            </button>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

<?php include 'components/footer.php'; ?>

</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
const menuBtn = document.getElementById("menu-toggle");
const sidebar = document.getElementById("sidebar");
const content = document.querySelector(".content");

menuBtn.addEventListener("click", function () {
    sidebar.classList.toggle("active");
    content.classList.toggle("shift");
});
</script>

</body>
</html>