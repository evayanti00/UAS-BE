<?php
require_once __DIR__ . '/../classes/events.php';

$eventObj = new Events();
$events = $eventObj->getAllData();

function e($value) {
    return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
}

function formatTanggalEvent($tanggal) {
    return date('d F Y', strtotime($tanggal));
}

function posterEvent($poster) {
    if (!empty($poster)) {
        return '../uploads/posters/' . rawurlencode($poster);
    }

    return 'assets/images/himatography_1.jpeg';
}
?>
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
    <div class="container">

        <a class="navbar-brand fw-bold text-primary fs-2" href="#">
            &#127775; SME
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenu">
            <span class="navbar-toggler-icon"></span>
        </button>

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

<!-- Hero -->
<section class="hero d-flex align-items-center">

    <div class="container text-center text-white">

        <span class="badge bg-light text-primary px-3 py-2 mb-3">
            Sistem Manajemen Event Kampus
        </span>

        <h1 class="display-4 fw-bold">
            Temukan Event Kampus Terbaik
        </h1>

        <p class="lead mt-3">
            Daftar seminar, workshop, lomba, dan berbagai kegiatan kampus dengan mudah melalui SME.
        </p>

        <a href="#event" class="btn btn-light btn-lg mt-4">
            Jelajahi Event
        </a>

    </div>

</section>

<!-- Event -->
<section class="container py-5" id="event">

    <div class="text-center mb-5">

        <h2 class="fw-bold">
            Event Kampus
        </h2>

        <p class="text-muted">
            Pilih event yang ingin kamu ikuti.
        </p>

    </div>

    <div class="row g-4 justify-content-center">

        <?php if ($events && $events->num_rows > 0): ?>
            <?php while ($event = $events->fetch_assoc()): ?>
                <div class="col-lg-6 col-md-6">

                    <div class="card event-card h-100">

                        <img src="<?php echo e(posterEvent($event['poster_event'])); ?>"
                            class="card-img-top event-img"
                            alt="<?php echo e($event['nama_event']); ?>">

                        <div class="card-body">

                            <span class="badge bg-primary mb-3">
                                <?php echo e($event['kategori']); ?>
                            </span>

                            <h4 class="fw-bold">
                                <?php echo e($event['nama_event']); ?>
                            </h4>

                            <p class="text-muted mb-2">
                                <?php echo e(formatTanggalEvent($event['tanggal_event'])); ?>
                            </p>

                            <p class="text-secondary">
                                <?php echo e($event['nama_organisasi']); ?>
                            </p>

                            <a href="detail_event.php?id=<?php echo e($event['id_event']); ?>"
                                class="btn btn-primary w-100">
                                Lihat Detail
                            </a>

                        </div>

                    </div>

                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <div class="col-lg-8">
                <div class="alert alert-info text-center mb-0">
                    Belum ada event yang tersedia.
                </div>
            </div>
        <?php endif; ?>

    </div>

</section>

<?php include 'components/footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>