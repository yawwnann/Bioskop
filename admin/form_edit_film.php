<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="../assets/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
	<title>Update Data Film</title>
</head>

<body>
	<?php
	$id = $_GET['id_film'];

	// Koneksi database
	include('../koneksi.php');

	// Query untuk mengambil data film berdasarkan ID
	$query = "SELECT * FROM film WHERE id_film='$id'";
	$result = mysqli_query($koneksi, $query);
	if (!$result) {
		die('SQL Error: ' . mysqli_error($koneksi));
	}
	?>
	<!-- HEADER -->
	<header class="p-2 bg-dark text-white">
		<div class="container">
			<div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
				<img src="../assets/image/logo.png" width="130px">
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

	<!-- MAIN -->
	<main>
		<div class="container mb-5">
			<h3 class="my-5">Update Data Film</h3>
			<form class="form-control shadow" method="post" action="edit_film.php">
				<?php
				while ($row = mysqli_fetch_assoc($result)) {
					?>
					<input type="hidden" name="id_film" value="<?php echo $row['id_film']; ?>">
					<div class="row p-3">
						<div class="col-sm-6">
							<div class="form-group">
								<label for="judul" class="form-label">Judul Film</label>
								<input type="text" class="form-control text-secondary" id="judul_film" name="judul_film"
									value="<?php echo htmlspecialchars($row['judul_film']); ?>">
							</div>
							<div class="form-group">
								<label for="genre" class="form-label mt-2">Genre</label>
								<input type="text" class="form-control text-secondary" id="genre" name="genre"
									value="<?php echo htmlspecialchars($row['genre']); ?>">
							</div>
							<div class="form-group">
								<label for="sutradara" class="form-label mt-2">Sutradara</label>
								<input type="text" class="form-control text-secondary" id="sutradara" name="sutradara"
									value="<?php echo htmlspecialchars($row['sutradara']); ?>">
							</div>
							<div class="form-group">
								<label for="rating_usia" class="form-label mt-2">Rating Usia</label>
								<input type="text" class="form-control text-secondary" id="rating_usia" name="rating_usia"
									value="<?php echo htmlspecialchars($row['rating_usia']); ?>">
							</div>
							<div class="form-group">
								<label for="sinopsis" class="form-label mt-2">Sinopsis</label>
								<textarea class="form-control text-secondary" id="sinopsis"
									name="sinopsis"><?php echo htmlspecialchars($row['sinopsis']); ?></textarea>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label for="durasi" class="form-label">Durasi</label>
								<input type="text" class="form-control text-secondary" id="durasi_tayang"
									name="durasi_tayang" value="<?php echo htmlspecialchars($row['durasi_tayang']); ?>">
							</div>
							<div class="form-group">
								<label for="tahun_tayang" class="form-label mt-2">Tahun Tayang</label>
								<input type="number" class="form-control text-secondary" id="tahun_tayang"
									name="tahun_tayang" value="<?php echo htmlspecialchars($row['tahun_tayang']); ?>">
							</div>
							<div class="form-group">
								<label for="image" class="form-label mt-2">URL Gambar</label>
								<input type="text" class="form-control text-secondary" id="image" name="image"
									placeholder="Masukkan URL Gambar"
									value="<?php echo htmlspecialchars($row['image']); ?>">
							</div>
						</div>
					</div>
					<hr class="mt-3">
					<button type="submit" class="btn btn-success mx-3 mb-3">Update Film</button>
					<?php
				}
				mysqli_close($koneksi);
				?>
			</form>
		</div>
	</main>
	<script src="../assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>