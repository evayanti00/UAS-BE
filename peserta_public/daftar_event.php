<?php
require_once __DIR__ . '/../classes/events.php';
require_once __DIR__ . '/../classes/peserta.php';
require_once __DIR__ . '/../classes/pendaftaran.php';
require __DIR__ . '/../vendor/autoload.php';

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use Dotenv\Dotenv;

function appUrl($path) {
    $scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
    $host = $_SERVER['HTTP_HOST'] ?? 'localhost';
    $basePath = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');

    return "{$scheme}://{$host}{$basePath}/{$path}";
}

function emailSend($email, $name, $event) {
    $mail = new PHPMailer(true);

    $dotenv = Dotenv::createImmutable(__DIR__ . '/../');
    $dotenv->load();

    $eventName = htmlspecialchars($event['nama_event'], ENT_QUOTES, 'UTF-8');
    $eventDate = htmlspecialchars(date('d F Y, H:i', strtotime($event['tanggal_event'])), ENT_QUOTES, 'UTF-8');
    $organizer = htmlspecialchars($event['nama_organisasi'], ENT_QUOTES, 'UTF-8');
    $category = htmlspecialchars($event['kategori'], ENT_QUOTES, 'UTF-8');
    $quota = htmlspecialchars($event['kuota'], ENT_QUOTES, 'UTF-8');
    $participantName = htmlspecialchars($name, ENT_QUOTES, 'UTF-8');
    $detailLink = htmlspecialchars(appUrl('detail_event.php?id=' . $event['id_event']), ENT_QUOTES, 'UTF-8');

    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = $_ENV['EMAIL_SENDER'];
        $mail->Password   = $_ENV['EMAIL_APP_PWD'];
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;
        
        $mail->setFrom($_ENV['EMAIL_SENDER'], 'Sistem Registrasi Event');
        $mail->addAddress($email, $name);
        $mail->isHTML(true);
        
        $mail->Subject = 'Konfirmasi Pendaftaran Event - ' . $event['nama_event'];
        $mail->Body    = "
            <h3>Halo {$participantName}!</h3>
            <p>Pendaftaran kamu untuk event berikut berhasil diterima.</p>
            <table cellpadding='6' cellspacing='0' border='0'>
                <tr>
                    <td><strong>Nama Event</strong></td>
                    <td>: {$eventName}</td>
                </tr>
                <tr>
                    <td><strong>Kategori</strong></td>
                    <td>: {$category}</td>
                </tr>
                <tr>
                    <td><strong>Tanggal</strong></td>
                    <td>: {$eventDate}</td>
                </tr>
                <tr>
                    <td><strong>Kuota</strong></td>
                    <td>: {$quota} Orang</td>
                </tr>
                <tr>
                    <td><strong>Penyelenggara</strong></td>
                    <td>: {$organizer}</td>
                </tr>
            </table>
            <p>Kamu bisa melihat detail event melalui link berikut:</p>
            <p><a href='{$detailLink}'>Lihat Detail Event</a></p>
            <p>Terima kasih sudah mendaftar.</p>
        ";
        $mail->AltBody = "Halo {$name}!\n\nPendaftaran kamu berhasil diterima.\n\nEvent: {$event['nama_event']}\nKategori: {$event['kategori']}\nTanggal: " . date('d F Y, H:i', strtotime($event['tanggal_event'])) . "\nKuota: {$event['kuota']} Orang\nPenyelenggara: {$event['nama_organisasi']}\n\nDetail: " . appUrl('detail_event.php?id=' . $event['id_event']);

        if (!$mail->send()) {
            throw new Exception($mail);
        }
        return true;
    } catch (Exception $e) {
        // echo "<script>alert('Mailer Error: {$mail->ErrorInfo}');</script>";
        return false;
    }
}

$eventsModel = new Events();
$pesertaModel = new Peserta();
$pendaftaranModel = new Pendaftaran();

$id_event = (int)($_POST['id_event'] ?? $_GET['id'] ?? 0);
$event = $id_event > 0 ? $eventsModel->getDataById($id_event) : null;
$error = '';

function e($value) {
    return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nik_nim = trim($_POST['nik_nim'] ?? '');
    $nama_peserta = trim($_POST['nama_peserta'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $jenis_identitas = trim($_POST['jenis_identitas'] ?? '');

    if (!$event) {
        $error = 'Event tidak ditemukan.';
    } elseif ($nik_nim === '' || $nama_peserta === '' || $email === '' || $jenis_identitas === '') {
        $error = 'Semua field wajib diisi.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Format email tidak valid.';
    } else {
        $pesertaData = [
            'nik_nim' => $nik_nim,
            'nama_peserta' => $nama_peserta,
            'email' => $email,
            'jenis_identitas' => $jenis_identitas,
        ];

        $peserta = $pesertaModel->getDataById($nik_nim);
        $pesertaSaved = $peserta ? $pesertaModel->updateData($pesertaData) : $pesertaModel->putData($pesertaData);

        if ($pesertaSaved && $pendaftaranModel->putData([
            'nik_nim' => $nik_nim,
            'id_event' => $id_event,
        ]))
        {
            $emailSent = emailSend($email, $nama_peserta, $event);
            $emailStatus = $emailSent ? '' : '&email=failed';

            header('Location: sukses.php?id=' . $id_event . $emailStatus);
            exit;
        }

        $error = 'Pendaftaran gagal disimpan. Pastikan email belum digunakan oleh peserta lain.';
    }
}
?>
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

<!-- Navbar -->
<nav class="navbar navbar-expand-lg bg-white shadow-sm sticky-top">
    <div class="container">

        <!-- Logo -->
        <a class="navbar-brand fw-bold text-primary fs-3" href="index.php">
            SME
        </a>

        <!-- Tombol Responsive -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Menu -->
        <div class="collapse navbar-collapse justify-content-center" id="navbarMenu">
            <ul class="navbar-nav">

                <li class="nav-item mx-3">
                    <a class="nav-link fw-bold" href="index.php">
                        Home
                    </a>
                </li>
            </ul>
        </div>

    </div>
</nav>

<!-- Form -->
<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-md-8">

            <?php if (!$event): ?>
                <div class="alert alert-warning text-center">
                    Event tidak ditemukan.
                </div>
                <div class="text-center">
                    <a href="index.php#event" class="btn btn-primary">Kembali ke Daftar Event</a>
                </div>
            <?php else: ?>
                <div class="card shadow">

                    <div class="card-header bg-success text-white">
                        <h4 class="mb-0">Form Pendaftaran Event</h4>
                    </div>

                    <div class="card-body">

                        <div class="alert alert-light border">
                            <strong><?php echo e($event['nama_event']); ?></strong><br>
                            <span class="text-muted">
                                <?php echo e(date('d F Y, H:i', strtotime($event['tanggal_event']))); ?> - <?php echo e($event['nama_organisasi']); ?>
                            </span>
                        </div>

                        <?php if ($error): ?>
                            <div class="alert alert-danger">
                                <?php echo e($error); ?>
                            </div>
                        <?php endif; ?>

                        <form action="daftar_event.php" method="POST">
                            <input type="hidden" name="id_event" value="<?php echo e($id_event); ?>">

                            <div class="mb-3">
                                <label class="form-label">NIK / NIM</label>
                                <input type="text" class="form-control" name="nik_nim" value="<?php echo e($_POST['nik_nim'] ?? ''); ?>" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" name="nama_peserta" value="<?php echo e($_POST['nama_peserta'] ?? ''); ?>" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" value="<?php echo e($_POST['email'] ?? ''); ?>" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Jenis Identitas</label>
                                <select class="form-select" name="jenis_identitas" required>
                                    <option value="">-- Pilih Jenis Identitas --</option>
                                    <option value="Mahasiswa" <?php echo (($_POST['jenis_identitas'] ?? '') === 'Mahasiswa') ? 'selected' : ''; ?>>Mahasiswa</option>
                                    <option value="Umum" <?php echo (($_POST['jenis_identitas'] ?? '') === 'Umum') ? 'selected' : ''; ?>>Umum</option>
                                </select>
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-success">
                                    Daftar Sekarang
                                </button>
                                <a href="detail_event.php?id=<?php echo e($id_event); ?>" class="btn btn-outline-secondary">
                                    Kembali
                                </a>
                            </div>

                        </form>

                    </div>

                </div>
            <?php endif; ?>

        </div>

    </div>

</div>

<?php include 'components/footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
