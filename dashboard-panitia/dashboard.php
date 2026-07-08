<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard </title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="../assets/css/dashboard.css">
</head>
<body>

<?php include '../components/sidebar.php'; ?>

<div class="main-content">

    <?php include '../components/navbar.php'; ?>

    <div class="container-fluid">

        <div class="page-title">
            <h2>Dashboard Event</h2>
            <p>Kelola event dan peserta dengan mudah.</p>
        </div>

        <div class="row">

            <div class="col-md-3">
                <div class="event-card purple">
                    <h5>Seminar AI</h5>
                    <p>Seminar</p>
                    <h4>100 Peserta</h4>
                    <small>10 Juli 2026</small>
                </div>
            </div>

            <div class="col-md-3">
                <div class="event-card blue">
                    <h5>Workshop UI/UX</h5>
                    <p>Workshop</p>
                    <h4>50 Peserta</h4>
                    <small>15 Juli 2026</small>
                </div>
            </div>

            <div class="col-md-3">
                <div class="event-card orange">
                    <h5>Lomba Web</h5>
                    <p>Lomba</p>
                    <h4>75 Peserta</h4>
                    <small>20 Juli 2026</small>
                </div>
<?php
session_start();
if (!isset($_SESSION['id_user'])) {
    header("Location: ../auth/login.php");
    exit;
}

require_once __DIR__ . "/../classes/events.php";
require_once __DIR__ . "/../classes/pendaftaran.php";

$eventsModel      = new Events();
$pendaftaranModel = new Pendaftaran();

$id_user        = (int)$_SESSION['id_user'];
$stats          = $eventsModel->getDashboardStats($id_user);
$totalPendaftar = $pendaftaranModel->getTotalByUser($id_user);
$recentEvents   = $eventsModel->getRecentByUser($id_user, 5);
?>

<?php include '../components/navbar.php'; ?>

<div class="container-fluid" style="padding: 80px 24px 24px;">

    <!-- Judul halaman -->
    <div class="page-title mb-4">
        <h2>👋 Selamat datang, <?php echo htmlspecialchars($_SESSION['nama_organisasi']); ?></h2>
        <p>Ini adalah ringkasan aktivitas event Anda.</p>
    </div>

    <!-- Statistik Event -->
    <div class="row">
        <div class="col-md-3 mb-4">
            <div class="event-card purple text-center p-3 rounded shadow-sm">
                <h6>Total Event</h6>
                <h2><?php echo $stats['total_event']; ?></h2>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="event-card blue text-center p-3 rounded shadow-sm">
                <h6>Total Pendaftar</h6>
                <h2><?php echo $totalPendaftar; ?></h2>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="event-card orange text-center p-3 rounded shadow-sm">
                <h6>Event Aktif</h6>
                <h2><?php echo $stats['event_aktif']; ?></h2>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="event-card cyan text-center p-3 rounded shadow-sm">
                <h6>Event Selesai</h6>
                <h2><?php echo $stats['event_selesai']; ?></h2>
            </div>

            <div class="col-md-3">
                <div class="event-card cyan">
                    <h5>Tech Expo</h5>
                    <p>Pameran</p>
                    <h4>120 Peserta</h4>
                    <small>25 Juli 2026</small>
                </div>
            </div>

        </div>

        <div class="table-container">

            <div class="table-header">
                <h4>Kelola Event</h4>

                <button class="btn btn-primary">
                    + Tambah Event
                </button>
            </div>

            <table class="table align-middle">

                <thead>
                    <tr>
                        <th>Nama Event</th>
                        <th>Kategori</th>
                        <th>Kuota</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>

                    <tr>
                        <td>Seminar AI</td>
                        <td>Seminar</td>
                        <td>100</td>
                        <td>10 Juli 2026</td>
                        <td>
                            <span class="badge bg-success">
                                Aktif
                            </span>
                        </td>
                    </tr>

                    <tr>
                        <td>Workshop UI/UX</td>
                        <td>Workshop</td>
                        <td>50</td>
                        <td>15 Juli 2026</td>
                        <td>
                            <span class="badge bg-success">
                                Aktif
                            </span>
                        </td>
                    </tr>

                    <tr>
                        <td>Lomba Web</td>
                        <td>Lomba</td>
                        <td>75</td>
                        <td>20 Juli 2026</td>
                        <td>
                            <span class="badge bg-secondary">
                                Selesai
                            </span>
                        </td>
                    </tr>

                </tbody>

            </table>

        </div>

    <!-- Event Terbaru -->
    <div class="table-container mt-4">
        <div class="table-header mb-3">
            <h4>Event Terbaru</h4>
            <a href="event.php" class="btn btn-outline-primary btn-sm">Lihat Semua</a>
        </div>
        <table class="table table-striped align-middle shadow-sm">
            <thead class="table-light">
                <tr>
                    <th>Nama Event</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($recentEvents && $recentEvents->num_rows > 0): ?>
                    <?php while ($row = $recentEvents->fetch_assoc()): ?>
                        <?php $isAktif = strtotime($row['tanggal_event']) > time(); ?>
                        <tr>
                            <td>
                                <a href="detail-event.php?id=<?php echo $row['id_event']; ?>" class="text-decoration-none fw-semibold">
                                    <?php echo htmlspecialchars($row['nama_event']); ?>
                                </a>
                            </td>
                            <td><?php echo date('d M Y', strtotime($row['tanggal_event'])); ?></td>
                            <td>
                                <span class="badge <?php echo $isAktif ? 'bg-success' : 'bg-secondary'; ?>">
                                    <?php echo $isAktif ? 'Aktif' : 'Selesai'; ?>
                                </span>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3" class="text-center text-muted">Belum ada event.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
const sidebar = document.querySelector('.sidebar');
const mainContent = document.querySelector('.main-content');
const toggleBtn = document.getElementById('toggleSidebar');

toggleBtn.addEventListener('click', () => {
    sidebar.classList.toggle('hide');
    mainContent.classList.toggle('full');
});
</script>

</body>
</html>