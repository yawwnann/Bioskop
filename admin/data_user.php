<?php
session_start();
include '../koneksi.php';

$sql = 'select * from user';
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
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/styles.css">
    <title>Hello, world!</title>
</head>

<body>
    <!-- HEADER -->
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
    <div class="container mb-5">
        <h4 class="my-4">Pengelolaan Data User</h4>
        <a href="tambah_user.php" class="btn btn-dark">Tambah User</a>
        <div class="table-responsive">
            <hr>
            <table class="table table-striped table-hover display shadow" id="data_user">
                <thead>
                    <tr class="text-center">
                        <th scope="col">ID User</th>
                        <th scope="col">Nama Lengkap</th>
                        <th scope="col">Email</th>
                        <th scope="col">Nomor Telpon</th>
                        <th scope="col">Username</th>
                        <th scope="col">Level</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1;
                    while ($user = mysqli_fetch_array($query)) { ?>
                        <tr class="text-center">
                            <td><?= $user['id_user']; ?></td>
                            <td style="text-align: left;"><?= $user['nama']; ?></td>
                            <td><?= $user['email']; ?></td>
                            <td><?= $user['no_kontak']; ?></td>
                            <td><?= $user['username']; ?></td>
                            <td><?= $user['level']; ?></td>
                            <td scope="col">
                                <a href="form_data_user.php?id_user=<?= $user['id_user']; ?>"
                                    class="btn btn-sm btn-warning">Ubah</a>
                        </tr>
                        <?php $i++;
                    } ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="../assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>