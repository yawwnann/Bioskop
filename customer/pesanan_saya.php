<?php
session_start();

// Validasi session
if (!isset($_SESSION["id_user"]) || empty($_SESSION["id_user"])) {
    die("Session id_user tidak ditemukan. Pastikan Anda login terlebih dahulu.");
}

// Ambil ID user dari session
$id_user = $_SESSION["id_user"];

// Koneksi ke database
include('../koneksi.php');

// Query untuk mengambil tiket yang dipesan oleh user
$query = "SELECT 
            tiket.id_tiket, 
            tiket.kursi, 
            tiket.total_bayar, 
            tiket.tanggal_pemesanan, 
            film.judul_film 
          FROM tiket 
          JOIN film ON tiket.id_film = film.id_film 
          WHERE tiket.id_user = ?";

// Debug: cek query SQL
if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

$stmt = $koneksi->prepare($query);

// Debug: cek jika prepare() gagal
if (!$stmt) {
    die("Prepare statement gagal: " . $koneksi->error);
}

// Bind parameter
$stmt->bind_param("i", $id_user);

// Execute statement
$stmt->execute();

// Get result
$result = $stmt->get_result();

// Debug: cek jika result gagal
if (!$result) {
    die("Eksekusi query gagal: " . $stmt->error);
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Pesanan Saya</title>
</head>

<body class="bg-gray-800 text-white">
    <!-- Header -->
    <header class="p-4 bg-gray-900">
        <div class="container mx-auto flex items-center">
            <a href="javascript:history.back()" class="mr-4">
                <img src="../assets/image/panah.png" class="h-9" alt="Back">
            </a>
            <h3 class="text-yellow-400 text-2xl">Pesanan Saya</h3>
        </div>
    </header>
    <!-- End Header -->

    <main class="container mx-auto p-4">
        <h2 class="text-center text-2xl font-bold text-yellow-500 mb-4">Daftar Tiket Anda</h2>

        <?php if ($result->num_rows > 0): ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="bg-gray-700 rounded-lg shadow-lg p-6">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-bold text-yellow-500"><?= htmlspecialchars($row['judul_film']); ?></h3>
                            <span class="text-sm text-gray-400">No: <?= htmlspecialchars($row['id_tiket']); ?></span>
                        </div>
                        <hr class="my-4 border-gray-500">
                        <div class="text-sm">
                            <p><strong>Tanggal:</strong> <?= htmlspecialchars($row['tanggal_pemesanan']); ?></p>
                            <p><strong>Kursi:</strong> <?= htmlspecialchars($row['kursi']); ?></p>
                            <p><strong>Total Bayar:</strong> Rp <?= number_format($row['total_bayar'], 0, ',', '.'); ?></p>
                            <a href="print_tiket.php?id_tiket=<?= $row['id_tiket']; ?>" target="_blank"
                                class="bg-yellow-500 text-black py-2 px-4 rounded hover:bg-yellow-600 mt-4 inline-block">
                                Print Tiket
                            </a>
                        </div>
                        <hr class="my-4 border-gray-500">
                        <p class="text-xs text-center text-gray-400">Terima kasih telah memesan tiket!</p>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php else: ?>
            <p class="text-center text-yellow-400 mt-4">Anda belum memiliki pesanan tiket.</p>
        <?php endif; ?>
    </main>
</body>

</html>