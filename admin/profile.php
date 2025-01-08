<?php
session_start();
include('../koneksi.php');

// Validasi session
if (!isset($_SESSION["username"])) {
  die('<p class="text-center text-yellow-500 mt-8">Session username tidak ditemukan. Pastikan Anda login terlebih dahulu.</p>');
}

// Ambil username dari session
$currentuser = $_SESSION['username'];

// Query untuk mengambil data user berdasarkan username
$sql = "SELECT * FROM user WHERE username = ?";
$stmt = $koneksi->prepare($sql);
$stmt->bind_param("s", $currentuser);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
  die('<p class="text-center text-yellow-500 mt-8">Data user tidak ditemukan.</p>');
}

$row = $result->fetch_assoc();
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../assets/css/styles.css">
  <title>Profile</title>
</head>

<body>
  <!-- HEADER -->
  <header class="p-2 bg-dark text-white sticky-top">
    <div class="container">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <a href="admin.php"><img src="../assets/image/logo.png" width="150px"></a>
        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
          <li><a href="admin.php" class="nav-link px-4 text-white">Home</a></li>
          <li><a href="#now" class="nav-link px-4 text-white">Now Playing</a></li>
          <li><a href="#soon" class="nav-link px-4 text-white">Coming Soon</a></li>
        </ul>
        <div class="dropdown text-end">
          <a href="#" class="d-block link-light text-decoration-none dropdown-toggle" id="dropdownUser1"
            data-bs-toggle="dropdown" aria-expanded="false">
            <img src="../assets/image/user.png" alt="mdo" width="50" height="50" class="rounded-circle">
          </a>
          <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1">
            <li><a class="dropdown-item" href="./profile.php">Profile</a></li>
            <li><a class="dropdown-item" href="./data_film.php">Data Film</a></li>
            <li><a class="dropdown-item" href="./jadwal.php">Jadwal Tayang</a></li>
            <li><a class="dropdown-item" href="./data_user.php">Data User</a></li>
            <li><a class="dropdown-item" href="../logout.php">Logout</a></li>
          </ul>
        </div>
      </div>
    </div>
  </header>
  <!-- END HEADER -->

  <main>
    <div class="container mt-5">
      <h3 class="text-center">Profile Anda</h3>
      <div class="row mt-4">
        <div class="col-md-4 text-center">
          <img src="../assets/image/user2.png" alt="user" width="200" class="rounded-circle">
          <h3 class="mt-3"><?= htmlspecialchars($row['nama']); ?></h3>
          <a href="beli_tiket.php" class="btn btn-primary mt-3">Tiket Anda</a>
        </div>
        <div class="col-md-8">
          <form action="cek_update.php" method="POST">
            <div class="mb-3">
              <label for="nama" class="form-label">Nama Lengkap</label>
              <input type="text" class="form-control" id="nama" name="nama"
                value="<?= htmlspecialchars($row['nama']); ?>">
            </div>
            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="email" class="form-control" id="email" name="email"
                value="<?= htmlspecialchars($row['email']); ?>">
            </div>
            <div class="mb-3">
              <label for="no_kontak" class="form-label">Nomor Handphone</label>
              <input type="text" class="form-control" id="no_kontak" name="no_kontak"
                value="<?= htmlspecialchars($row['no_kontak']); ?>">
            </div>
            <div class="mb-3">
              <label for="username" class="form-label">Username</label>
              <input type="text" class="form-control" id="username" name="username"
                value="<?= htmlspecialchars($row['username']); ?>">
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" class="form-control" id="password" name="password"
                value="<?= htmlspecialchars($row['password']); ?>">
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
          </form>
        </div>
      </div>
    </div>
  </main>
  <script src="../assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>