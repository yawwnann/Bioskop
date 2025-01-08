<!doctype html>
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
    $query = mysqli_query($koneksi, $sql);

    if (!$query) {
        die('SQL Error : ' . mysqli_error($koneksi));
    }
    ?>
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
        <h3 class="my-4">Pengelolaan Data Film</h3>
        <a href="tambah_film.php" class="btn btn-dark">Tambah Film</a>
        <div class="table-responsive">
            <hr>
            <table class="table table-striped table-hover display shadow" id="data_film">
                <thead>
                    <tr class="text-center">
                        <th scope="col">ID Film</th>
                        <th scope="col">Judul Film</th>
                        <th scope="col">Genre</th>
                        <th scope="col">Sutradara</th>
                        <th scope="col">Rating Usia</th>
                        <th scope="col">Sinopsis</th>
                        <th scope="col">Tahun Tayang</th>
                        <th scope="col">Durasi Tayang</th>
                        <th scope="col">Image</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($fil = mysqli_fetch_array($query)) { ?>
                        <tr class="text-center">
                            <td><?= $fil['id_film']; ?></td>
                            <td style="text-align: left;"><?= $fil['judul_film']; ?></td>
                            <td><?= $fil['genre']; ?></td>
                            <td><?= $fil['sutradara']; ?></td>
                            <td><?= $fil['rating_usia']; ?></td>
                            <td style="text-align: justify;"><?= $fil['sinopsis']; ?></td>
                            <td><?= $fil['tahun_tayang']; ?></td>
                            <td><?= $fil['durasi_tayang']; ?></td>
                            <td><img src="<?= htmlspecialchars($fil['image']); ?>" alt="..." width="60" height="85"></td>

                            <td scope="col">
                                <a href="form_edit_film.php?id_film=<?= $fil['id_film']; ?>"
                                    class="btn btn-sm btn-warning">Ubah</a>
                                <a href="hapus_film.php?id_film=<?= $fil['id_film']; ?>" type="button"
                                    class="btn btn-danger btn-sm">Hapus</a>
                            </td>
                        </tr>
                        <?php
                    } ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="../assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>