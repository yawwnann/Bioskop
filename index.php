<?php
session_start();
include 'koneksi.php';

// Query untuk mengambil data film dengan status Now Playing
$sql_now_playing = "SELECT * FROM film WHERE status = 'Now Playing'";
$query_now_playing = mysqli_query($koneksi, $sql_now_playing);

if (!$query_now_playing) {
  echo "SQL Error (Now Playing): " . mysqli_error($koneksi);
  $query_now_playing = []; // Pastikan $query_now_playing tetap diinisialisasi
}

// Query untuk mengambil data film dengan status Coming Soon
$sql_coming_soon = "SELECT * FROM film WHERE status = 'Coming Soon'";
$query_coming_soon = mysqli_query($koneksi, $sql_coming_soon);

if (!$query_coming_soon) {
  echo "SQL Error (Coming Soon): " . mysqli_error($koneksi);
  $query_coming_soon = []; // Pastikan $query_coming_soon tetap diinisialisasi
}
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://cdn.tailwindcss.com"></script>
  <title>Movie Mania</title>
</head>

<body class="bg-gray-900 text-white min-h-screen">
  <!-- HEADER -->
  <header class="p-4 bg-gray-800 shadow-md">
    <div class="container mx-auto flex items-center justify-between">
      <h1 class="text-yellow-400 text-3xl font-bold">E-TIX</h1>
      <nav class="flex space-x-6">
        <a href="#now" class="hover:text-yellow-400 font-semibold">Now Playing</a>
        <a href="#soon" class="hover:text-yellow-400 font-semibold">Coming Soon</a>
      </nav>
      <div class="flex space-x-4">
        <a href="login.php" class="bg-yellow-500 text-black px-4 py-2 rounded hover:bg-yellow-600">Login</a>
        <a href="./customer/registrasi_cus.php"
          class="bg-yellow-500 text-black px-4 py-2 rounded hover:bg-yellow-600">Register</a>
      </div>
    </div>
  </header>
  <!-- END HEADER -->

  <main class="container mx-auto my-12">
    <!-- NOW PLAYING CONTENT -->
    <section id="now" class="mb-16">
      <h2 class="text-4xl font-bold text-center text-yellow-400 mb-8">Now Playing</h2>
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
        <?php if ($query_now_playing && mysqli_num_rows($query_now_playing) > 0): ?>
          <?php while ($film = mysqli_fetch_assoc($query_now_playing)): ?>
            <div
              class="bg-gray-800 rounded-lg shadow-lg overflow-hidden transform transition-transform duration-300 hover:scale-105">
              <img src="<?= htmlspecialchars($film['image']); ?>" alt="Film Poster"
                class="w-full h-60 object-cover rounded-t-lg">
              <div class="p-4">
                <h3 class="text-lg font-bold text-yellow-400"><?= htmlspecialchars($film['judul_film']); ?></h3>
                <p class="text-sm text-gray-400 mt-2"><?= htmlspecialchars(substr($film['sinopsis'], 0, 80)) . '...'; ?></p>
                <a href="login.php"
                  class="block bg-yellow-500 text-black mt-4 py-2 text-center rounded hover:bg-yellow-600">Beli Tiket</a>
              </div>
            </div>
          <?php endwhile; ?>
        <?php else: ?>
          <p class="text-center text-gray-400 col-span-full">Tidak ada film yang sedang tayang.</p>
        <?php endif; ?>
      </div>
    </section>
    <!-- END NOW PLAYING CONTENT -->

    <!-- COMING SOON CONTENT -->
    <section id="soon">
      <h2 class="text-4xl font-bold text-center text-yellow-400 mb-8">Coming Soon</h2>
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
        <?php if ($query_coming_soon && mysqli_num_rows($query_coming_soon) > 0): ?>
          <?php while ($film = mysqli_fetch_assoc($query_coming_soon)): ?>
            <div
              class="bg-gray-800 rounded-lg shadow-lg overflow-hidden transform transition-transform duration-300 hover:scale-105">
              <img src="<?= htmlspecialchars($film['image']); ?>" alt="Film Poster"
                class="w-full h-60 object-cover rounded-t-lg">
              <div class="p-4">
                <h3 class="text-lg font-bold text-yellow-400"><?= htmlspecialchars($film['judul_film']); ?></h3>
                <p class="text-sm text-gray-400 mt-2"><?= htmlspecialchars(substr($film['sinopsis'], 0, 100)) . '...'; ?>
                </p>
                <a href="login.php"
                  class="block bg-gray-700 text-gray-100 mt-4 py-2 text-center rounded hover:bg-gray-600">Detail</a>
              </div>
            </div>
          <?php endwhile; ?>
        <?php else: ?>
          <p class="text-center text-gray-400 col-span-full">Tidak ada film yang akan datang.</p>
        <?php endif; ?>
      </div>
    </section>
    <!-- END COMING SOON CONTENT -->
  </main>
</body>

</html>