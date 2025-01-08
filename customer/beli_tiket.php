<!doctype html>
<html lang="en" class="h-full bg-gray-800">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Customer Page</title>
</head>

<body class="h-full text-gray-100">
    <?php
    session_start();

    if ($_SESSION["level"] != "customer") {
        header("location:../index.php");
    }

    $id = 1002356801;
    include('../koneksi.php');

    $data = "SELECT * FROM tiket";
    $query = "SELECT * FROM jadwal_tayang JOIN film ON film.id_film=jadwal_tayang.id_film WHERE jadwal_tayang.id_film='$id'";
    $result = mysqli_query($koneksi, $query);
    $list = mysqli_query($koneksi, $data);
    $film = mysqli_fetch_array($result);

    if (!$film) {
        die('SQL Error: ' . mysqli_error($koneksi));
    }
    ?>

    <!-- HEADER -->
    <header class="bg-gray-900 p-4 sticky top-0 shadow-md">
        <div class="container mx-auto flex justify-between items-center">
            <img src="../assets/image/logo.png" alt="Logo" class="h-12">
            <nav class="flex space-x-6">
                <a href="customer.php" class="text-gray-100 hover:text-gray-300">Home</a>
                <a href="#now" class="text-gray-100 hover:text-gray-300">Now Playing</a>
                <a href="#soon" class="text-gray-100 hover:text-gray-300">Coming Soon</a>
            </nav>
        </div>
    </header>
    <!-- END HEADER -->

    <main class="container mx-auto p-4">
        <div class="bg-gray-700 rounded-lg shadow-lg overflow-hidden max-w-3xl mx-auto mt-8">
            <div class="flex">
                <div class="w-1/3">
                    <img src="../assets/image/<?= $film['image']; ?>" alt="<?= $film['judul_film']; ?>"
                        class="h-full w-full object-cover">
                </div>
                <div class="w-2/3 p-4">
                    <h4 class="text-center text-xl font-bold">GARUT XXI</h4>
                    <hr class="my-2 border-gray-500">
                    <h5 class="text-lg font-semibold"><?= $film['judul_film']; ?></h5>
                    <p class="text-gray-300">Rating Usia: <?= $film['rating_usia']; ?></p>

                    <?php foreach ($result as $jadwal): ?>
                        <div class="mt-2">
                            <p>Studio: GARUT XXI, REGULAR, STUDIO <?= $jadwal['id_studio']; ?></p>
                            <p>Jadwal: <?= $jadwal['tanggal']; ?>, <?= $jadwal['jam']; ?></p>
                        </div>
                    <?php endforeach; ?>

                    <?php foreach ($list as $tiket): ?>
                        <div class="mt-4 border-t border-gray-600 pt-2">
                            <p><span class="font-semibold">Kode Tiket:</span> <?= $tiket['id_tiket']; ?></p>
                            <p><span class="font-semibold">Kode Seat:</span> <?= $tiket['kursi']; ?></p>
                        </div>
                    <?php endforeach; ?>

                </div>
            </div>
        </div>
        <p class="text-center text-gray-400 mt-6 italic">** Tunjukan tiket pada petugas studio</p>
    </main>
    <!-- END MAIN -->
</body>

</html>