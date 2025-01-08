<?php
session_start();
if (!isset($_SESSION["level"]) || $_SESSION["level"] != "customer") {
    header("location:../index.php");
    exit;
}

// Validasi ID Film dari URL
if (!isset($_GET['id_film']) || empty($_GET['id_film'])) {
    die('<p class="text-center text-yellow-500 mt-8">ID Film tidak ditemukan!</p>');
}

// Pastikan ID Film adalah integer
$id_film = intval($_GET['id_film']);

include('../koneksi.php');

// Query untuk mendapatkan data film berdasarkan ID
$data = "SELECT * FROM film WHERE id_film = ?";
$stmt = $koneksi->prepare($data);
$stmt->bind_param("i", $id_film);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die('<p class="text-center text-yellow-500 mt-8">Film tidak ditemukan di database!</p>');
}

$film = $result->fetch_assoc();

// Jadwal default untuk film
$jadwal_tayang = [
    'tanggal' => date('Y-m-d'), // Tanggal hari ini
    'jam' => '19:00',          // Jam default
    'harga' => 50000           // Harga default
];
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Booking Tiket</title>
</head>

<body class="bg-gray-800 text-white">
    <!-- HEADER -->
    <header class="p-4 bg-gray-900">
        <div class="container mx-auto flex items-center">
            <a href="customer.php" class="mr-4">
                <img src="../assets/image/panah.png" width="30px" alt="Back">
            </a>
            <div>
                <h3 class="text-yellow-400 text-2xl"><?= htmlspecialchars($film['judul_film']); ?></h3>
                <p class="text-yellow-400"><?= htmlspecialchars($jadwal_tayang['tanggal']); ?> |
                    <?= htmlspecialchars($jadwal_tayang['jam']); ?>
                </p>
            </div>
        </div>
    </header>
    <!-- END HEADER -->

    <main class="container mx-auto p-4">
        <hr class="border-gray-700 mb-6">

        <!-- Pilihan Kursi -->
        <div class="grid grid-cols-4 gap-4 justify-center">
            <?php
            $kursi = ['A1', 'A2', 'A3', 'A4', 'C1', 'C2', 'C3', 'C4', 'E1', 'E2', 'E3', 'E4'];
            foreach ($kursi as $k) {
                echo '
                <label class="flex items-center justify-center bg-gray-700 p-4 rounded-lg hover:bg-gray-600 cursor-pointer">
                    <input type="checkbox" class="hidden" name="kursi[]" value="' . htmlspecialchars($k) . '">
                    <span class="text-white">' . htmlspecialchars($k) . '</span>
                </label>';
            }
            ?>
        </div>

        <div class="mt-8 text-center">
            <button class="bg-gray-700 text-white py-2 px-4 rounded-lg cursor-not-allowed" disabled>Layar
                Bioskop</button>
        </div>

        <!-- Form Pemesanan -->
        <form method="POST" action="ringkasan_order.php" class="mt-8">
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <h4 class="text-center">Harga</h4>
                    <input type="text" class="mt-2 w-full p-2 bg-gray-900 text-white border border-gray-700 rounded"
                        name="harga" value="<?= htmlspecialchars($jadwal_tayang['harga']); ?>" readonly>
                </div>
                <div>
                    <h4 class="text-center">Pilih Kursi</h4>
                    <select name="kursi" class="mt-2 w-full p-2 bg-gray-900 text-white border border-gray-700 rounded"
                        required>
                        <option value="" disabled selected>Pilih Kursi</option>
                        <?php foreach ($kursi as $k): ?>
                            <option value="<?= htmlspecialchars($k); ?>"><?= htmlspecialchars($k); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <input type="hidden" name="id_film" value="<?= htmlspecialchars($id_film); ?>">
            <input type="hidden" name="tanggal" value="<?= htmlspecialchars($jadwal_tayang['tanggal']); ?>">
            <input type="hidden" name="jam" value="<?= htmlspecialchars($jadwal_tayang['jam']); ?>">
            <div class="mt-8 text-center">
                <button type="submit" class="bg-yellow-500 text-black py-2 px-4 rounded hover:bg-yellow-600"
                    name="order">Ringkasan Order</button>
            </div>
        </form>
    </main>
</body>

</html>