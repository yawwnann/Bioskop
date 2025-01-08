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
    <?php

    include '../koneksi.php';

    $sql = 'select * from film';
    $data = 'select * from studio';
    $query = mysqli_query($koneksi, $sql);
    $baris = mysqli_query($koneksi, $data);

    if (!$query) {
        die('SQL Error : ' . mysqli_error($koneksi));
    }
    if (!$baris) {
        die('SQL Error : ' . mysqli_error($koneksi));
    }
    ?>
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
            <h3 class="my-5">Tambah Jadwal</h3>
            <form class="form-control shadow" method="post" action="cek_tambah_jadwal.php"
                enctype="multipart/form-data">
                <div class="row p-3">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="id_film" class="form-label">ID Film</label>
                            <select class="form-select" name="id_film">
                                <option>-Pilih ID Film--</option>
                                <?php
                                while ($film = mysqli_fetch_array($query)) {
                                    echo "<option value='" . $film['id_film'] . "'>" . $film['id_film'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="id_studio" class="form-label mt-2">ID Studio</label>
                            <select class="form-select" name="id_studio">
                                <option>-Pilih ID Studio--</option>
                                <?php
                                while ($studio = mysqli_fetch_array($baris)) {
                                    echo "<option value='" . $studio['id_studio'] . "'>" . $studio['id_studio'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tanggal" class="form-label mt-2">Tanggal</label>
                            <input type="text" class="form-control text-secondary" id="tanggal" name="tanggal">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="jam" class="form-label mt-2">Jam</label>
                            <input type="text" class="form-control text-secondary" id="jam" name="jam">
                        </div>
                        <div class="form-group">
                            <label for="harga" class="form-label mt-2">Harga</label>
                            <select class="form-select" name="harga">
                                <option>-Pilih Harga-</option>
                                <option value="50000">Rp. 50.000</option>
                                <option value="65000">Rp. 65.000</option>
                                <option value="80000">Rp. 80.000</option>
                            </select>
                        </div>
                    </div>
                </div>
                <hr class="mt-3">
                <button class="btn btn-primary mx-3 mb-3" type="submit">Tambah Jadwal</button>
            </form>
        </div>
    </main>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>

</body>

</html>