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

<?php
session_start();
if (!isset($_SESSION['id_user'])) {
    header("Location: ../auth/login.php");
    exit;
}

require_once __DIR__ . "/../classes/events.php";

$eventsModel = new Events();
$id_user     = (int)$_SESSION['id_user'];

// Proses Hapus
if (isset($_GET['aksi']) && $_GET['aksi'] === 'hapus' && isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $eventsModel->removeData($id);
    header("Location: event.php?msg=hapus");
    exit;
}

$events = $eventsModel->getDataByUser($id_user);
$msg    = $_GET['msg'] ?? '';
?>

<?php include '../components/navbar.php'; ?>

<div class="container-fluid" style="padding:80px 24px 24px;">
  <div class="page-title mb-4">
    <h2>📅 Kelola Event</h2>
    <p>Buat, edit, dan hapus event Anda.</p>
  </div>

  <?php if ($msg === 'tambah'): ?>
    <div class="alert alert-success alert-dismissible fade show">Event berhasil ditambahkan! <button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
  <?php elseif ($msg === 'edit'): ?>
    <div class="alert alert-success alert-dismissible fade show">Event berhasil diperbarui! <button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
  <?php elseif ($msg === 'hapus'): ?>
    <div class="alert alert-warning alert-dismissible fade show">Event berhasil dihapus. <button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
  <?php endif; ?>

  <div class="table-responsive">
    <table class="table table-striped table-bordered align-middle w-100 shadow-sm">
      <thead class="table-light">
        <tr>
          <th style="width:120px;">Poster</th>
          <th>Nama Event</th>
          <th>Tanggal</th>
          <th>Kuota</th>
          <th>Status</th>
          <th style="width:220px;">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php if ($events && $events->num_rows > 0): ?>
          <?php while ($row = $events->fetch_assoc()): ?>
            <?php $isAktif = strtotime($row['tanggal_event']) > time(); ?>
            <tr>
              <td>
                <?php if ($row['poster_event']): ?>
                  <img src="../uploads/posters/<?php echo htmlspecialchars($row['poster_event']); ?>" alt="Poster" class="img-fluid" style="max-width:100px;">
                <?php else: ?>
                  <span class="text-muted">-</span>
                <?php endif; ?>
              </td>
              <td><?php echo htmlspecialchars($row['nama_event']); ?></td>
              <td><?php echo date('d M Y', strtotime($row['tanggal_event'])); ?></td>
              <td><?php echo $row['kuota']; ?></td>
              <td>
                <span class="badge <?php echo $isAktif ? 'bg-success' : 'bg-secondary'; ?>">
                  <?php echo $isAktif ? 'Aktif' : 'Selesai'; ?>
                </span>
              </td>
              <td>
                <a href="detail-event.php?id=<?php echo $row['id_event']; ?>" class="btn btn-info btn-sm">Detail</a>
                <a href="edit-event.php?id=<?php echo $row['id_event']; ?>" class="btn btn-warning btn-sm">Edit</a>
                <a href="event.php?aksi=hapus&id=<?php echo $row['id_event']; ?>"
                   class="btn btn-danger btn-sm"
                   onclick="return confirm('Yakin hapus event ini? Semua pendaftaran terkait akan ikut terhapus.')">
                  Hapus
                </a>
              </td>
            </tr>
          <?php endwhile; ?>
        <?php else: ?>
          <tr>
            <td colspan="6" class="text-center text-muted">Belum ada event. <a href="tambah-event.php">Tambah sekarang</a>.</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>