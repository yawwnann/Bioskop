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
    <header class="p-3 bg-dark text-white">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-left justify-content-lg-start">
                <a href="../index.php"><img src="../assets/image/panah.png" width="60px"></a>
                <svg class="bi me-0" width="30" height="32" role="img" aria-label="Etiket">
                    <h1 class="text-warning">Register E-TIX</h1>
                </svg>
            </div>
        </div>
    </header>
    <!-- END HEADER -->

    <main>
        <div class="container h-100">
            <div class="row justify-content-sm-center h-100 mt-4">
                <div class="col-xxl-5 col-xl-5 col-lg-5 col-md-9 col-sm-6">
                    <div class="card shadow-lg">
                        <div class="card-body p-5">
                            <form class="form-horizontal" method="post" action="cek_regis.php" enctype="multipart/form-data">
                                    <h3 class="my-3 text-center">Registrasi</h3>
                                    <hr class="mt-3">

                                    <div class="form-group">
                                        <label for="nama" class="form-label">Nama Lengkap</label>
                                        <input type="text" class="form-control text-secondary" id="nama" name="nama" placeholder="Nama Lengkap">
                                    </div>
                                    <div class="form-group">
                                        <label for="email" class="form-label mt-2">Email</label>
                                        <input type="email" class="form-control text-secondary" id="email" name="email" placeholder="Email">
                                    </div>
                                    <div class="form-group">
                                        <label for="no_kontak" class="form-label mt-2">Nomor Telpon</label>
                                        <input type="number" class="form-control text-secondary" id="no_kontak" name="no_kontak" placeholder="Nomor Telpon">
                                    </div>
                                    <div class="form-group">
                                        <label for="username" class="form-label mt-2">Username</label>
                                        <input type="text" class="form-control text-secondary" id="username" name="username" placeholder="Username">
                                    </div>
                                    <div class="form-group">
                                        <label for="password" class="form-label mt-2">Password</label>
                                        <input type="password" class="form-control text-secondary" id="password" name="password" placeholder="Password"></input>
                                    </div>
                                    <hr class="mt-3">
                                    <button class="btn btn-primary mb-3" type="submit">Registrasi</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>