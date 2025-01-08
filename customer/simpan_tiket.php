<?php
session_start();
if (!isset($_POST['kursi']) || empty($_POST['kursi'])) {
    die('<p class="text-center text-yellow-500 mt-8">Anda belum memilih kursi!</p>');
}

include('../koneksi.php');

// Data dari form
$id_user = intval($_POST['id_user']);
$id_film = intval($_POST['id_film']);
$harga = intval($_POST['harga']);
$kursi_dipilih = $_POST['kursi']; // Array kursi yang dipilih

// Simpan data ke tabel tiket
foreach ($kursi_dipilih as $kursi) {
    $kursi = htmlspecialchars($kursi);
    $query = "INSERT INTO tiket (id_user, id_film, kursi, total_bayar) VALUES (?, ?, ?, ?)";
    $stmt = $koneksi->prepare($query);
    $stmt->bind_param("iisi", $id_user, $id_film, $kursi, $harga);
    $stmt->execute();
}

echo '<p class="text-center text-green-500 mt-8">Tiket berhasil dipesan!</p>';
?>