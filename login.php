<?php
session_start();
include($_SERVER['DOCUMENT_ROOT'] . '/bioskop/koneksi.php');


// Buat CAPTCHA jika belum ada
if (!isset($_SESSION['captcha'])) {
  $_SESSION['captcha'] = rand(1000, 9999); // Angka 4 digit
}

// Proses login
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = trim($_POST['username'] ?? '');
  $password = trim($_POST['password'] ?? '');
  $captcha_input = trim($_POST['captcha'] ?? '');

  // Validasi input
  if (empty($username) || empty($password) || empty($captcha_input)) {
    $error_message = "Semua kolom wajib diisi!";
  } elseif ($captcha_input != $_SESSION['captcha']) {
    $error_message = "CAPTCHA salah! Harap coba lagi.";
  } else {
    // Query untuk validasi login
    $query = "SELECT id_user, level FROM user WHERE username = ? AND password = ?";
    $stmt = $koneksi->prepare($query);
    if (!$stmt) {
      die("Query Error: " . $koneksi->error);
    }

    // Bind dan eksekusi parameter
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
      $user = $result->fetch_assoc();
      $_SESSION["isLogin"] = true;
      $_SESSION["id_user"] = $user["id_user"];
      $_SESSION["level"] = $user["level"];
      $_SESSION["username"] = $username;

      // Reset CAPTCHA
      unset($_SESSION['captcha']);

      // Redirect berdasarkan level
      if ($user["level"] == "admin") {
        header("Location: ./admin/admin.php");
        exit();
      } elseif ($user["level"] == "customer") {
        header("Location: ./customer/customer.php");
        exit();
      }
    } else {
      $error_message = "Username atau password salah!";
    }
  }

  // Regenerasi CAPTCHA
  $_SESSION['captcha'] = rand(1000, 9999);
}
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="assets/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/signin.css">
  <title>Login - E-TIX</title>
</head>

<body class="text-center">
  <main class="form-signin">
    <form method="POST" action="">
      <img class="mb-2" src="./assets/image/logo2.png" alt="Logo E-TIX" width="100" height="80">
      <h1 class="mb-3 fw-bold">E-TIX</h1>

      <!-- Tampilkan pesan error jika ada -->
      <?php if (isset($error_message)): ?>
        <div class="alert alert-danger" role="alert">
          <?= htmlspecialchars($error_message); ?>
        </div>
      <?php endif; ?>

      <!-- Form Username -->
      <div class="form-floating mb-3">
        <input type="text" class="form-control text-secondary" id="floatingInput" name="username"
          placeholder="Masukkan username Anda" required>
        <label for="floatingInput">Username</label>
      </div>

      <!-- Form Password -->
      <div class="form-floating mb-3">
        <input type="password" class="form-control text-secondary" id="floatingPassword" name="password"
          placeholder="Masukkan password Anda" required>
        <label for="floatingPassword">Password</label>
      </div>

      <!-- CAPTCHA -->
      <div class="d-flex align-items-center justify-content-between mb-3">
        <div>
          <strong class="text-dark bg-warning p-2 rounded"><?= $_SESSION['captcha']; ?></strong>
        </div>
        <div class="form-floating w-75">
          <input type="text" class="form-control text-secondary" id="captcha" name="captcha"
            placeholder="Masukkan kode di samping" required>
          <label for="captcha">Kode CAPTCHA</label>
        </div>
      </div>

      <!-- Remember Me -->
      <div class="checkbox mb-3">
        <label>
          <input type="checkbox" value="remember-me"> Remember me
        </label>
      </div>

      <!-- Tombol Login -->
      <button class="w-50 btn btn-lg btn-dark mb-2" type="submit">Login</button>
      <h6 class="mb-2">Or</h6>

      <!-- Tombol Register -->
      <a href="./customer/registrasi_cus.php" class="w-50 btn btn-lg btn-warning">Register</a>
      <p class="mt-5 mb-3 text-muted">&copy; 2022</p>
    </form>
  </main>

  <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>