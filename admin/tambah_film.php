<?php
session_start();

// Validasi jika pengguna bukan admin
if ($_SESSION["level"] != "admin") {
    header("location:../index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Tambah Film</title>
</head>

<body class="bg-gray-900 text-white">
    <!-- Header -->
    <header class="p-4 bg-gray-800">
        <div class="container mx-auto flex justify-between items-center">
            <a href="data_film.php" class="text-yellow-400 text-2xl font-bold">ETIX Admin</a>
            <nav>
                <ul class="flex space-x-6">
                    <li><a href="data_film.php" class="text-white hover:text-yellow-400">Data Film</a></li>
                    <li><a href="jadwal.php" class="text-white hover:text-yellow-400">Jadwal Tayang</a></li>
                    <li><a href="data_user.php" class="text-white hover:text-yellow-400">Data User</a></li>
                    <li><a href="../logout.php" class="text-white hover:text-yellow-400">Logout</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <!-- End Header -->

    <!-- Main Content -->
    <main class="container mx-auto mt-8">
        <h1 class="text-center text-yellow-400 text-3xl mb-6">Tambah Film</h1>
        <form action="proses_tambah_film.php" method="POST"
            class="bg-gray-800 p-6 rounded-lg shadow-md max-w-3xl mx-auto">
            <div class="mb-4">
                <label for="judul_film" class="block text-yellow-400 font-bold mb-2">Judul Film:</label>
                <input type="text" id="judul_film" name="judul_film"
                    class="w-full p-2 rounded-lg bg-gray-700 text-white" required>
            </div>
            <div class="mb-4">
                <label for="genre" class="block text-yellow-400 font-bold mb-2">Genre:</label>
                <input type="text" id="genre" name="genre" class="w-full p-2 rounded-lg bg-gray-700 text-white"
                    required>
            </div>
            <div class="mb-4">
                <label for="sutradara" class="block text-yellow-400 font-bold mb-2">Sutradara:</label>
                <input type="text" id="sutradara" name="sutradara" class="w-full p-2 rounded-lg bg-gray-700 text-white"
                    required>
            </div>
            <div class="mb-4">
                <label for="rating_usia" class="block text-yellow-400 font-bold mb-2">Rating Usia:</label>
                <input type="text" id="rating_usia" name="rating_usia"
                    class="w-full p-2 rounded-lg bg-gray-700 text-white" required>
            </div>
            <div class="mb-4">
                <label for="sinopsis" class="block text-yellow-400 font-bold mb-2">Sinopsis:</label>
                <textarea id="sinopsis" name="sinopsis" class="w-full p-2 rounded-lg bg-gray-700 text-white" rows="4"
                    required></textarea>
            </div>
            <div class="mb-4">
                <label for="durasi_tayang" class="block text-yellow-400 font-bold mb-2">Durasi Tayang:</label>
                <input type="text" id="durasi_tayang" name="durasi_tayang"
                    class="w-full p-2 rounded-lg bg-gray-700 text-white" required>
            </div>
            <div class="mb-4">
                <label for="tahun_tayang" class="block text-yellow-400 font-bold mb-2">Tahun Tayang:</label>
                <input type="number" id="tahun_tayang" name="tahun_tayang"
                    class="w-full p-2 rounded-lg bg-gray-700 text-white" required>
            </div>
            <div class="mb-4">
                <label for="image_url" class="block text-yellow-400 font-bold mb-2">URL Gambar:</label>
                <input type="url" id="image_url" name="image_url" class="w-full p-2 rounded-lg bg-gray-700 text-white"
                    placeholder="https://example.com/image.jpg" required>
            </div>
            <button type="submit"
                class="w-full bg-yellow-400 text-black p-3 rounded-lg font-bold hover:bg-yellow-500">Tambah
                Film</button>
        </form>
    </main>
    <!-- End Main Content -->
</body>

</html>