<!doctype html>
<html lang="en" class="h-full bg-gray-800">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Film Details</title>
</head>

<body class="h-full text-gray-100">
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

    $id = intval($_GET['id_film']); // Pastikan ID adalah integer
    include('../koneksi.php');

    // Query untuk mengambil data dari tabel film
    $query = "SELECT * FROM film WHERE id_film = '$id'";
    $result = mysqli_query($koneksi, $query);

    if (!$result) {
        die('<p class="text-center text-yellow-500 mt-8">SQL Error: ' . mysqli_error($koneksi) . '</p>');
    }

    $film = mysqli_fetch_assoc($result); // Ambil data film pertama
    if (!$film) {
        die('<p class="text-center text-yellow-500 mt-8">Film tidak ditemukan!</p>');
    }
    ?>

    <!-- HEADER -->
    <header class="bg-gray-900 p-4 sticky top-0 shadow-md">
        <div class="container mx-auto flex items-center">
            <a href="customer.php" class="mr-4">
                <img src="../assets/image/panah.png" alt="Back" class="h-7">
            </a>
            <h3 class="text-warning text-xl font-bold"><?= htmlspecialchars($film['judul_film']); ?></h3>
        </div>
    </header>
    <!-- END HEADER -->

    <main class="container mx-auto p-4">
        <div class="flex flex-col lg:flex-row items-center lg:items-start mt-8 space-y-8 lg:space-y-0 lg:space-x-8">
            <!-- Film Poster -->
            <div class="bg-gray-700 rounded-lg shadow-lg overflow-hidden w-full lg:w-1/3">
                <!-- Gunakan URL langsung dari kolom 'image' -->
                <img src="<?= htmlspecialchars($film['image']); ?>" alt="<?= htmlspecialchars($film['judul_film']); ?>"
                    class="w-full h-auto">
            </div>

            <!-- Film Details -->
            <div class="w-full lg:w-2/3 bg-gray-700 rounded-lg shadow-lg p-6">
                <h5 class="text-2xl font-semibold mb-4"><?= htmlspecialchars($film['judul_film']); ?></h5>
                <div class="space-y-4">
                    <p><span class="font-semibold">Genre:</span> <?= htmlspecialchars($film['genre']); ?></p>
                    <p><span class="font-semibold">Tahun Tayang:</span> <?= htmlspecialchars($film['tahun_tayang']); ?>
                    </p>
                    <p><span class="font-semibold">Durasi:</span> <?= htmlspecialchars($film['durasi_tayang']); ?></p>
                    <p><span class="font-semibold">Sutradara:</span> <?= htmlspecialchars($film['sutradara']); ?></p>
                    <p><span class="font-semibold">Rating Usia:</span> <?= htmlspecialchars($film['rating_usia']); ?>
                    </p>
                    <p><span class="font-semibold">Sinopsis:</span> <?= htmlspecialchars($film['sinopsis']); ?></p>
                </div>

                <!-- Tombol Beli -->
                <div class="mt-6">
                    <a href="pilih_kursi.php?id_film=<?= $film['id_film']; ?>"
                        class="block w-full text-center bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-500 transition">
                        Beli Tiket
                    </a>
                </div>
            </div>
        </div>
    </main>

    <!-- END MAIN -->
</body>

</html>