<?php
session_start();
include('../koneksi.php');

// Periksa apakah sesi username ada
if (!isset($_SESSION['username'])) {
  header("Location: ../login.php");
  exit();
}

// Periksa apakah ada pesan keberhasilan dalam sesi
$success_message = "";
if (isset($_SESSION['message'])) {
  $success_message = $_SESSION['message'];
  unset($_SESSION['message']); // Hapus pesan setelah ditampilkan
}
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://cdn.tailwindcss.com"></script>
  <title>Profil Pengguna</title>
</head>

<body class="bg-gray-900 text-gray-100 font-sans">

  <!-- HEADER -->
  <header class="bg-gray-800 py-5 shadow-lg">
    <div class="container mx-auto flex justify-between items-center px-6">
      <a href="customer.php" class="text-yellow-400 text-2xl font-bold">E-TIX</a>
      <nav>
        <ul class="flex space-x-6 text-gray-300">
          <li><a href="customer.php" class="hover:text-yellow-400">Home</a></li>
          <li><a href="#" class="hover:text-yellow-400">Now Playing</a></li>
          <li><a href="#" class="hover:text-yellow-400">Coming Soon</a></li>
        </ul>
      </nav>
      <div class="relative">
        <button class="flex items-center focus:outline-none" id="dropdownButton">
          <img src="../assets/image/user.png" alt="User Icon" class="w-10 h-10 rounded-full">
        </button>
        <ul class="hidden absolute right-0 mt-2 bg-gray-700 text-sm rounded shadow-lg w-48" id="dropdownMenu">
          <li><a href="profile.php" class="block px-4 py-2 hover:bg-gray-600">Profil</a></li>
          <li><a href="../logout.php" class="block px-4 py-2 hover:bg-gray-600">Logout</a></li>
        </ul>
      </div>
    </div>
  </header>
  <!-- END HEADER -->

  <main class="container mx-auto py-12 px-6">
    <?php
    $currentuser = $_SESSION['username'];
    $sql = "SELECT * FROM user WHERE username = ?";
    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param("s", $currentuser);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
      ?>
      <!-- Popup Pesan Keberhasilan -->
      <?php if (!empty($success_message)): ?>
        <div id="successPopup" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-75 z-50">
          <div class="bg-gray-800 text-gray-100 rounded-lg shadow-lg p-6 max-w-sm text-center">
            <h3 class="text-2xl font-semibold mb-4">Berhasil!</h3>
            <p class="text-sm mb-6"><?= htmlspecialchars($success_message); ?></p>
            <button onclick="closePopup()"
              class="bg-yellow-500 text-gray-900 px-4 py-2 rounded-lg hover:bg-yellow-600 transition-all duration-200 ease-in-out">
              Tutup
            </button>
          </div>
        </div>
      <?php endif; ?>

      <div class="bg-gray-800 rounded-lg shadow-lg p-8">
        <h3 class="text-3xl font-bold text-center mb-8">Profil Pengguna</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
          <!-- Kartu Profil -->
          <div class="text-center">
            <div class="bg-gray-700 rounded-lg p-6 shadow-md">
              <img src="../assets/image/user2.png" alt="User Image" class="w-40 h-40 rounded-full mx-auto">
              <h3 class="mt-4 text-xl font-semibold"><?php echo htmlspecialchars($row['nama']); ?></h3>
              <a href="pesanan_saya.php"
                class="mt-4 inline-block bg-yellow-500 text-gray-900 px-6 py-2 rounded-lg hover:bg-yellow-600 font-semibold">
                Tiket Anda
              </a>
            </div>
          </div>
          <!-- Form Profil -->
          <div class="col-span-1 md:col-span-2">
            <form action="cek_update.php" method="POST" class="bg-gray-700 p-6 rounded-lg shadow-md">
              <h4 class="text-xl font-semibold mb-4">Ubah Data Profil</h4>
              <div class="space-y-6">
                <div>
                  <label for="nama" class="block text-sm font-medium">Nama Lengkap</label>
                  <input type="text" id="nama" name="nama"
                    class="w-full mt-2 p-3 bg-gray-800 text-gray-100 rounded border border-gray-600"
                    value="<?php echo htmlspecialchars($row['nama']); ?>">
                </div>
                <div>
                  <label for="email" class="block text-sm font-medium">Email</label>
                  <input type="email" id="email" name="email"
                    class="w-full mt-2 p-3 bg-gray-800 text-gray-100 rounded border border-gray-600"
                    value="<?php echo htmlspecialchars($row['email']); ?>">
                </div>
                <div>
                  <label for="no_kontak" class="block text-sm font-medium">Nomor Handphone</label>
                  <input type="text" id="no_kontak" name="no_kontak"
                    class="w-full mt-2 p-3 bg-gray-800 text-gray-100 rounded border border-gray-600"
                    value="<?php echo htmlspecialchars($row['no_kontak']); ?>">
                </div>
                <div>
                  <label for="username" class="block text-sm font-medium">Username</label>
                  <input type="text" id="username" name="username"
                    class="w-full mt-2 p-3 bg-gray-800 text-gray-100 rounded border border-gray-600"
                    value="<?php echo htmlspecialchars($row['username']); ?>">
                </div>
                <div>
                  <label for="password" class="block text-sm font-medium">Password</label>
                  <input type="password" id="password" name="password"
                    class="w-full mt-2 p-3 bg-gray-800 text-gray-100 rounded border border-gray-600">
                </div>
                <button class="w-full bg-yellow-500 text-gray-900 py-3 rounded-lg hover:bg-yellow-600 font-semibold">
                  Update
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <?php
    } else {
      echo "<div class='text-center text-red-500'>Data pengguna tidak ditemukan.</div>";
    }
    ?>
  </main>

  <script>
    // Dropdown Toggle
    const dropdownButton=document.getElementById('dropdownButton');
    const dropdownMenu=document.getElementById('dropdownMenu');

    dropdownButton.addEventListener('click',() => {
      dropdownMenu.classList.toggle('hidden');
    });

    // Close Popup
    function closePopup() {
      document.getElementById('successPopup').remove();
    }
  </script>
</body>

</html>