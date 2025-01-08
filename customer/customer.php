<?php
session_start();

// Validasi session
if (!isset($_SESSION["id_user"]) || $_SESSION["id_user"] == '') {
  header("location:../login.php");
  exit;
}

// Ambil id_user dari session
$id_user = $_SESSION["id_user"];

// Koneksi ke database
include '../koneksi.php';

// Query untuk film Now Playing
$sql_now = "SELECT * FROM film WHERE status = 'Now Playing'";
$query_now = mysqli_query($koneksi, $sql_now);
if (!$query_now) {
  die('SQL Error (Now Playing): ' . mysqli_error($koneksi));
}

// Query untuk film Coming Soon
$sql_soon = "SELECT * FROM film WHERE status = 'Coming Soon'";
$query_soon = mysqli_query($koneksi, $sql_soon);
if (!$query_soon) {
  die('SQL Error (Coming Soon): ' . mysqli_error($koneksi));
}
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://cdn.tailwindcss.com"></script>
  <title>Welcome to Movie Mania</title>
</head>

<body class="bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 text-white min-h-screen">

  <!-- HEADER -->
  <header class="bg-gray-800 text-white sticky top-0 shadow-lg z-50">
    <div class="container mx-auto flex items-center justify-between px-4 py-2">
      <img src="../assets/image/logo2.png" alt="Logo" class="w-24">
      <h2 class="text-lg font-bold">Welcome, ID <?= htmlspecialchars($id_user); ?>!</h2>
      <nav class="flex space-x-6">
        <a href="customer.php" class="text-white hover:text-gray-400 font-semibold">Home</a>
        <a href="#now" class="text-white hover:text-gray-400 font-semibold">Now Playing</a>
        <a href="#soon" class="text-white hover:text-gray-400 font-semibold">Coming Soon</a>
        <a href="pesanan_saya.php" class="text-white hover:text-gray-400 font-semibold">Pesanan Saya</a>
      </nav>
      <div class="relative">
        <!-- Dropdown Button -->
        <button id="dropdownButton" class="focus:outline-none">
          <img src="../assets/image/user.png" alt="User" class="w-10 h-10 rounded-full border-2 border-gray-700">
        </button>
        <!-- Dropdown Menu -->
        <ul id="dropdownMenu"
          class="absolute right-0 mt-2 w-48 bg-gray-800 text-gray-300 rounded-md shadow-lg hidden z-10">
          <li><a href="profile.php" class="block px-4 py-2 hover:bg-gray-700">Profile</a></li>
          <li><a href="../logout.php" class="block px-4 py-2 hover:bg-gray-700">Logout</a></li>
        </ul>
      </div>
    </div>
  </header>
  <!-- END HEADER -->

  <main class="container mx-auto my-8">
    <!-- NOW PLAYING CONTENT -->
    <section id="now" class="mb-12">
      <h1 class="text-3xl font-extrabold mb-6 border-b-2 border-gray-700 pb-2">Now Playing</h1>
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
        <?php while ($fil = mysqli_fetch_assoc($query_now)) { ?>
          <div
            class="bg-gray-800 rounded-lg shadow-lg flex flex-col justify-between overflow-hidden transform transition duration-300 hover:scale-105">
            <!-- Gambar -->
            <div class="w-full h-80">
              <img src="<?= htmlspecialchars($fil['image']); ?>" alt="<?= htmlspecialchars($fil['judul_film']); ?>"
                class="w-full h-full object-cover rounded-t-lg">
            </div>
            <!-- Konten -->
            <div class="p-4">
              <h2 class="text-lg font-semibold mb-2"><?= htmlspecialchars($fil['judul_film']); ?></h2>
              <button onclick="showPopup(<?= htmlspecialchars(json_encode($fil)); ?>)"
                class="bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-500 w-full">
                Detail
              </button>
              <a href="pilih_film.php?id_film=<?= htmlspecialchars($fil['id_film']); ?>"
                class="block w-full mt-3 text-center bg-yellow-600 text-white py-2 rounded-lg hover:bg-yellow-500">
                Beli Tiket
              </a>
            </div>
          </div>
        <?php } ?>
      </div>
    </section>
    <!-- END NOW PLAYING CONTENT -->

    <!-- COMING SOON CONTENT -->
    <section id="soon">
      <h1 class="text-3xl font-extrabold mb-6 border-b-2 border-gray-700 pb-2">Coming Soon</h1>
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
        <?php while ($fil = mysqli_fetch_assoc($query_soon)) { ?>
          <div
            class="bg-gray-800 rounded-lg shadow-lg flex flex-col justify-between overflow-hidden transform transition duration-300 hover:scale-105">
            <!-- Gambar -->
            <img src="<?= htmlspecialchars($fil['image']); ?>" alt="<?= htmlspecialchars($fil['judul_film']); ?>"
              class="w-full h-64 object-cover rounded-t-lg">
            <!-- Konten -->
            <div class="p-4">
              <h2 class="text-lg font-semibold mb-2"><?= htmlspecialchars($fil['judul_film']); ?></h2>
              <button onclick="showPopup(<?= htmlspecialchars(json_encode($fil)); ?>)"
                class="bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-500 w-full">
                Detail
              </button>

            </div>
          </div>
        <?php } ?>
      </div>
    </section>
    <!-- END COMING SOON CONTENT -->
  </main>

  <!-- Popup -->
  <div id="popup" class="fixed inset-0 bg-gray-900 bg-opacity-75 hidden flex items-center justify-center z-50">
    <div class="bg-gray-800 rounded-lg shadow-lg p-6 max-w-lg w-full flex">
      <!-- Gambar -->
      <div class="w-1/3">
        <img id="popupImage" src="#" alt="Film Poster" class="w-full h-full object-cover rounded-lg">
      </div>
      <!-- Detail -->
      <div class="w-2/3 ml-4">
        <h3 id="popupTitle" class="text-2xl font-bold text-yellow-400 mb-4">Judul Film</h3>
        <p id="popupGenre" class="text-gray-400 text-sm mb-2"><span class="font-semibold">Genre:</span></p>
        <p id="popupDirector" class="text-gray-400 text-sm mb-2"><span class="font-semibold">Sutradara:</span></p>
        <p id="popupDuration" class="text-gray-400 text-sm mb-2"><span class="font-semibold">Durasi:</span></p>
        <p id="popupSynopsis" class="text-gray-400 text-sm"><span class="font-semibold">Sinopsis:</span></p>
        <button onclick="closePopup()" class="bg-red-500 text-white py-2 px-4 rounded-lg hover:bg-red-600 mt-4">
          Tutup
        </button>
      </div>
    </div>
  </div>

  <script>
    // Dropdown Menu
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

    // Show Popup
    function showPopup(film) {
      document.getElementById('popupImage').src=film.image;
      document.getElementById('popupTitle').textContent=film.judul_film;
      document.getElementById('popupGenre').textContent=`Genre: ${film.genre}`;
      document.getElementById('popupDirector').textContent=`Sutradara: ${film.sutradara}`;
      document.getElementById('popupDuration').textContent=`Durasi: ${film.durasi_tayang}`;
      document.getElementById('popupSynopsis').textContent=`Sinopsis: ${film.sinopsis||'Tidak ada sinopsis.'}`;
      document.getElementById('popup').classList.remove('hidden');
    }

    // Close Popup
    function closePopup() {
      document.getElementById('popup').classList.add('hidden');
    }
  </script>

</body>

</html>