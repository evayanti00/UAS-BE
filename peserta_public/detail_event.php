<?php
require_once __DIR__ . '/../classes/events.php';

$eventsModel = new Events();
$id_event = (int)($_GET['id'] ?? 0);
$event = $id_event > 0 ? $eventsModel->getDataById($id_event) : null;

function e($value) {
    return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
}

function formatTanggalEvent($tanggal) {
    return date('d F Y, H:i', strtotime($tanggal));
}

function posterEvent($poster) {
    if (!empty($poster)) {
        return '../uploads/posters/' . rawurlencode($poster);
    }

    return 'assets/images/himatography_1.jpeg';
}

$isAktif = $event ? strtotime($event['tanggal_event']) > time() : false;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $event ? e($event['nama_event']) : 'Detail Event'; ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<?php include 'components/navbar.php'; ?>

<div class="container my-5">

    <?php if (!$event): ?>
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="alert alert-warning text-center">
                    Event tidak ditemukan.
                </div>
                <div class="text-center">
                    <a href="index.php#event" class="btn btn-primary">Kembali ke Daftar Event</a>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="row g-4">

            <div class="col-md-5">

                <div class="shadow rounded overflow-hidden">
                    <img src="<?php echo e(posterEvent($event['poster_event'])); ?>"
                         class="d-block w-100"
                         alt="<?php echo e($event['nama_event']); ?>">
                </div>

            </div>

            <div class="col-md-7">

                <span class="badge bg-primary mb-3">
                    <?php echo e($event['kategori']); ?>
                </span>

                <h2 class="fw-bold">
                    <?php echo e($event['nama_event']); ?>
                </h2>

                <hr>

                <table class="table table-borderless align-middle">
                    <tr>
                        <th width="180">Tanggal Event</th>
                        <td><?php echo e(formatTanggalEvent($event['tanggal_event'])); ?></td>
                    </tr>
                    <tr>
                        <th>Kuota</th>
                        <td><?php echo e($event['kuota']); ?> Orang</td>
                    </tr>
                    <tr>
                        <th>Penyelenggara</th>
                        <td><?php echo e($event['nama_organisasi']); ?></td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>
                            <span class="badge <?php echo $isAktif ? 'bg-success' : 'bg-secondary'; ?>">
                                <?php echo $isAktif ? 'Aktif' : 'Selesai'; ?>
                            </span>
                        </td>
                    </tr>
                </table>

                <h5 class="mt-4">Deskripsi Event</h5>

                <p class="text-muted">
                    <?php echo nl2br(e($event['deskripsi'] ?? '-')); ?>
                </p>

                <div class="d-flex gap-2 mt-4">
                    <a href="daftar_event.php?id=<?php echo e($event['id_event']); ?>" class="btn btn-success">
                        Daftar Sekarang
                    </a>
                    <a href="index.php#event" class="btn btn-outline-secondary">
                        Kembali
                    </a>
                </div>

            </div>

        </div>
    <?php endif; ?>

</div>

<?php include 'components/footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>