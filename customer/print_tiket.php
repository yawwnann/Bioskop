<?php
session_start();

// Validasi session
if (!isset($_SESSION["id_user"]) || $_SESSION["id_user"] == '') {
    die("Session id_user tidak ditemukan. Pastikan Anda login terlebih dahulu.");
}

// Pastikan ID Tiket dikirim melalui URL
if (!isset($_GET['id_tiket']) || empty($_GET['id_tiket'])) {
    die("ID Tiket tidak ditemukan.");
}

$id_tiket = intval($_GET['id_tiket']); // Sanitasi input
include('../koneksi.php');
require '../vendor/autoload.php'; // Load autoload dari Composer

use Dompdf\Dompdf;
use Dompdf\Options;

// Query untuk mendapatkan data tiket berdasarkan ID Tiket
$query = "SELECT tiket.kursi, tiket.total_bayar, 
          film.judul_film
          FROM tiket 
          JOIN film ON tiket.id_film = film.id_film 
          WHERE tiket.id_tiket = ? AND tiket.id_user = ?";

// Debug: Tampilkan query SQL jika perlu
if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

$stmt = $koneksi->prepare($query);

// Debug: Periksa jika prepare gagal
if (!$stmt) {
    die("Prepare statement gagal: " . $koneksi->error);
}

// Bind parameter
$stmt->bind_param("ii", $id_tiket, $_SESSION["id_user"]);

// Execute statement
if (!$stmt->execute()) {
    die("Eksekusi query gagal: " . $stmt->error);
}

// Get result
$result = $stmt->get_result();

// Periksa apakah tiket ditemukan
if ($result->num_rows === 0) {
    die("Tiket tidak ditemukan.");
}

$tiket = $result->fetch_assoc();

// Inisialisasi DOMPDF
$options = new Options();
$options->set('isHtml5ParserEnabled', true);
$options->set('isRemoteEnabled', true); // Untuk mengizinkan gambar dari URL
$dompdf = new Dompdf($options);

// Buat konten HTML untuk PDF
$html = '
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; }
        .ticket { border: 1px solid #000; padding: 20px; max-width: 400px; margin: auto; text-align: center; }
        .ticket h1 { font-size: 24px; margin-bottom: 20px; }
        .ticket p { margin: 5px 0; }
        .ticket .title { font-weight: bold; }
    </style>
</head>
<body>
    <div class="ticket">
        <h1>TIKET BIOSKOP</h1>
        <p class="title">Judul Film:</p>
        <p>' . htmlspecialchars($tiket['judul_film']) . '</p>
        <p class="title">Kursi:</p>
        <p>' . htmlspecialchars($tiket['kursi']) . '</p>
        <p class="title">Total Bayar:</p>
        <p>Rp ' . number_format($tiket['total_bayar'], 0, ',', '.') . '</p>
        <p class="title" style="margin-top: 20px;">Terima kasih atas pemesanan Anda!</p>
    </div>
</body>
</html>
';

// Load HTML ke DOMPDF
$dompdf->loadHtml($html);

// Set ukuran dan orientasi halaman PDF
$dompdf->setPaper('A4', 'portrait');

// Render HTML menjadi PDF
$dompdf->render();

// Output PDF ke browser
$dompdf->stream('Tiket_' . $tiket['judul_film'] . '.pdf', ['Attachment' => false]);
?>