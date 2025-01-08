<?php
session_start();
if ($_SESSION["level"] != "admin") {
    header("location:../index.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <title>Hello, world!</title>
</head>

<body>
    <header class="p-2 bg-dark text-white">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <svg class="bi me-0" width="10" height="32" role="img" aria-label="Etiket">
                    <img src="../assets/image/logo.png" width="130px">
                </svg>

                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                    <li>
                        <a href="admin.php" class="nav-link px-4 text-white">Home</a>
                    </li>
                    <li>
                        <a href="#now" class="nav-link px-4 text-white">Now Playing</a>
                    </li>
                    <li>
                        <a href="#soon" class="nav-link px-4 text-white">Coming Soon</a>
                    </li>
                </ul>
                <div class="dropdown text-end">
                    <a href="#" class="d-block link-light text-decoration-none dropdown-toggle" id="dropdownUser1"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="../assets/image/user.png" alt="mdo" width="50" height="50" class="rounded-circle">
                    </a>
                    <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1">

                        <li>
                            <a class="dropdown-item" href="./data_film.php">Data Film</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="./jadwal.php">Jadwal Tayang</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="./data_user.php">Data User</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="../logout.php">Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </header>

    <!-- END HEADER -->
    <main>
        <div class="container mb-5">
            <h3 class="my-5">Tambah Data User</h3>
            <form class="form-control shadow" method="post" action="cek_tambah_user.php" enctype="multipart/form-data">
                <div class="row p-3">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="nama" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control text-secondary" id="nama" name="nama">
                        </div>
                        <div class="form-group">
                            <label for="email" class="form-label mt-2">Email</label>
                            <input type="email" class="form-control text-secondary" id="email" name="email">
                        </div>
                        <div class="form-group">
                            <label for="no_kontak" class="form-label mt-2">Nomor Telpon</label>
                            <input type="number" class="form-control text-secondary" id="no_kontak" name="no_kontak">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="username" class="form-label mt-2">Username</label>
                            <input type="text" class="form-control text-secondary" id="username" name="username">
                        </div>
                        <div class="form-group">
                            <label for="password" class="form-label mt-2">Password</label>
                            <input type="password" class="form-control text-secondary" id="password"
                                name="password"></input>
                        </div>
                        <div class="form-group">
                            <label for="level" class="form-label">Level</label>
                            <select class="form-select" name="level">
                                <option>---</option>
                                <option value="admin">Admin</option>
                                <option value="customer">Customer</option>
                            </select>
                        </div>
                    </div>
                </div>
                <hr class="mt-3">
                <button class="btn btn-primary mx-3 mb-3" type="submit">Tambah User</button>
            </form>
        </div>
    </main>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>

</body>

</html>