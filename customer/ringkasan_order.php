<?php
session_start();
if (!isset($_SESSION["level"]) || $_SESSION["level"] != "customer") {
    header("location:../index.php");
    exit;
}

// Validasi input
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include('../koneksi.php');

    // Ambil data dari form
    $id_user = $_SESSION['id_user']; // ID user dari session
    $id_film = intval($_POST['id_film']);
    $kursi = htmlspecialchars($_POST['kursi']);
    $harga = intval($_POST['harga']);

    // Simpan data ke tabel tiket
    $query = "INSERT INTO tiket (id_user, id_film, kursi, total_bayar, tanggal_pemesanan) 
              VALUES (?, ?, ?, ?, NOW())";
    $stmt = $koneksi->prepare($query);
    $stmt->bind_param("iisi", $id_user, $id_film, $kursi, $harga);

    if ($stmt->execute()) {
        // Jika berhasil, arahkan ke halaman konfirmasi atau daftar pesanan
        header("Location: pesanan_saya.php");
        exit;
    } else {
        // Jika gagal, tampilkan pesan error
        die('<p class="text-center text-yellow-500 mt-8">Gagal menyimpan data tiket: ' . $stmt->error . '</p>');
    }
} else {
    // Jika bukan POST request
    header("location:customer.php");
    exit;
}
?>