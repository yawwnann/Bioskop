<?php
// Validasi ID film dari parameter URL
if (!isset($_GET['id_film']) || empty($_GET['id_film'])) {
	die("ID film tidak ditemukan.");
}

// Ambil ID film dan pastikan aman untuk diproses
$id = intval($_GET['id_film']); // Mengonversi ke integer untuk mencegah input berbahaya

// Koneksi ke database
include('../koneksi.php');

// Query hapus menggunakan prepared statement
$query = "DELETE FROM film WHERE id_film = ?";
$stmt = $koneksi->prepare($query);

// Cek jika statement berhasil dibuat
if ($stmt) {
	// Bind parameter dan eksekusi statement
	$stmt->bind_param("i", $id);
	if ($stmt->execute()) {
		// Redirect ke halaman data film jika berhasil
		header("location:./data_film.php");
		exit;
	} else {
		// Menampilkan pesan error jika eksekusi gagal
		echo "ERROR: Data gagal dihapus. " . $stmt->error;
	}
	$stmt->close();
} else {
	// Menampilkan pesan error jika prepare statement gagal
	echo "ERROR: Statement gagal diproses. " . $koneksi->error;
}

// Menutup koneksi database
$koneksi->close();
?>