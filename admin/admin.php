<?php
session_start();

if ($_SESSION["level"] != "admin") {
  header("location:../index.php");
}

include '../koneksi.php';

$sql = 'SELECT * FROM film';
$query = mysqli_query($koneksi, $sql);

if (!$query) {
  die('SQL Error : ' . mysqli_error($koneksi));
}
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://cdn.tailwindcss.com"></script>
  <title>ETIX</title>
</head>

<body class="bg-gray-900 text-white">

  <!-- HEADER -->
  <header class="bg-gray-800 sticky top-0 p-4 shadow-md">
    <div class="container mx-auto flex justify-between items-center">
      <div class="flex items-center space-x-4">
        <img src="../assets/image/logo.png" alt="Logo" class="h-10">
        <nav class="flex space-x-6">
          <a href="admin.php" class="text-gray-300 hover:text-yellow-400">Home</a>
          <a href="#now" class="text-gray-300 hover:text-yellow-400">Now Playing</a>
          <a href="#soon" class="text-gray-300 hover:text-yellow-400">Coming Soon</a>
        </nav>
      </div>
      <div class="relative">
        <!-- Dropdown Button -->
        <button id="dropdownButton" class="flex items-center space-x-2 focus:outline-none">
          <img src="../assets/image/user.png" alt="User" class="h-10 w-10 rounded-full">
        </button>
        <!-- Dropdown Menu -->
        <ul id="dropdownMenu"
          class="absolute right-0 mt-2 w-48 bg-gray-800 text-gray-300 rounded-md shadow-lg z-10 hidden">
          <li><a href="./data_film.php" class="block px-4 py-2 hover:bg-gray-700">Data Film</a></li>
          <li><a href="./jadwal.php" class="block px-4 py-2 hover:bg-gray-700">Jadwal Tayang</a></li>
          <li><a href="./data_user.php" class="block px-4 py-2 hover:bg-gray-700">Data User</a></li>
          <li><a href="../logout.php" class="block px-4 py-2 hover:bg-gray-700">Logout</a></li>
        </ul>
      </div>
    </div>
  </header>
  <!-- END HEADER -->

  <main class="container mx-auto py-8">
    <!-- NOW PLAYING CONTENT -->
    <section id="now" class="mb-16">
      <h1 class="text-3xl font-bold mb-6 text-center">Now Playing</h1>
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
        <?php while ($fil = mysqli_fetch_array($query)): ?>
          <div class="bg-gray-800 p-4 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
            <img src="<?= $fil['image']; ?>" alt="<?= $fil['judul_film']; ?>"
              class="rounded-md mb-4 h-64 w-full object-cover">
            <h5 class="text-lg font-bold mb-2 text-center"><?= $fil['judul_film']; ?></h5>
            <p class="text-gray-400 text-sm mb-1"><span class="font-semibold">Genre:</span> <?= $fil['genre']; ?></p>
            <p class="text-gray-400 text-sm mb-1"><span class="font-semibold">Sutradara:</span> <?= $fil['sutradara']; ?>
            </p>
            <p class="text-gray-400 text-sm mb-1"><span class="font-semibold">Durasi:</span> <?= $fil['durasi_tayang']; ?>
            </p>
            <div class="flex justify-center mt-4">
              <button onclick="showPopup(<?= htmlspecialchars(json_encode($fil)); ?>)"
                class="bg-yellow-500 text-black py-2 px-4 rounded-lg hover:bg-yellow-600 transition-colors">Detail</button>
            </div>
          </div>
        <?php endwhile; ?>
      </div>
    </section>
  </main>

  <!-- Popup -->
  <div id="popup" class="fixed inset-0 bg-gray-900 bg-opacity-75 hidden flex items-center justify-center z-50">
    <div class="bg-gray-800 rounded-lg shadow-lg p-6 w-full max-w-4xl flex">
      <div class="w-1/3">
        <img id="popupImage" src="#" alt="Film Poster" class="w-full h-full object-cover rounded-md">
      </div>
      <div class="w-2/3 ml-6">
        <button onclick="closePopup()"
          class="absolute top-4 right-4 bg-red-500 text-white py-1 px-3 rounded hover:bg-red-600">
          ✕
        </button>
        <h3 id="popupTitle" class="text-2xl font-bold text-yellow-400 mb-4">Film Title</h3>
        <p id="popupGenre" class="text-gray-400 text-sm mb-2"><span class="font-semibold">Genre:</span></p>
        <p id="popupDirector" class="text-gray-400 text-sm mb-2"><span class="font-semibold">Sutradara:</span></p>
        <p id="popupDuration" class="text-gray-400 text-sm mb-2"><span class="font-semibold">Durasi:</span></p>
        <p id="popupSynopsis" class="text-gray-400 text-sm"><span class="font-semibold">Sinopsis:</span></p>
      </div>
    </div>
  </div>

  <script>
    document.addEventListener("DOMContentLoaded",() => {
      const dropdownButton=document.getElementById("dropdownButton");
      const dropdownMenu=document.getElementById("dropdownMenu");

      dropdownButton.addEventListener("click",() => {
        dropdownMenu.classList.toggle("hidden");
      });

      document.addEventListener("click",(event) => {
        if(!dropdownButton.contains(event.target)&&!dropdownMenu.contains(event.target)) {
          dropdownMenu.classList.add("hidden");
        }
      });
    });

    function showPopup(film) {
      document.getElementById('popupTitle').textContent=film.judul_film;
      document.getElementById('popupImage').src=film.image;
      document.getElementById('popupGenre').textContent=`Genre: ${film.genre}`;
      document.getElementById('popupDirector').textContent=`Sutradara: ${film.sutradara}`;
      document.getElementById('popupDuration').textContent=`Durasi: ${film.durasi_tayang}`;
      document.getElementById('popupSynopsis').textContent=`Sinopsis: ${film.sinopsis||'Tidak ada sinopsis.'}`;

      document.getElementById('popup').classList.remove('hidden');
    }

    function closePopup() {
      document.getElementById('popup').classList.add('hidden');
    }
  </script>

</body>

</html>