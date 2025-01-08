<?php
session_start();
include('../koneksi.php');

// Periksa apakah sesi username ada
if (!isset($_SESSION['username'])) {
	header("Location: ../login.php");
	exit();
}

// Proses update data jika form di-submit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$nama = trim($_POST['nama']);
	$email = trim($_POST['email']);
	$no_kontak = trim($_POST['no_kontak']);
	$username = trim($_POST['username']);
	$password = trim($_POST['password']); // Harus di-hash pada aplikasi nyata

	$id_user = $_SESSION['id_user'];

	$sql = "UPDATE user SET nama = ?, email = ?, no_kontak = ?, username = ?, password = ? WHERE id_user = ?";
	$stmt = $koneksi->prepare($sql);
	$stmt->bind_param("sssssi", $nama, $email, $no_kontak, $username, $password, $id_user);

	if ($stmt->execute()) {
		$_SESSION['message'] = "Profil berhasil diperbarui.";
		header("Location: profile.php");
		exit();
	} else {
		$error_message = "Terjadi kesalahan saat memperbarui data.";
	}
}
?>

<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://cdn.tailwindcss.com"></script>
	<title>Update Profil</title>
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
		</div>
	</header>
	<!-- END HEADER -->

	<main class="container mx-auto py-12 px-6">
		<div class="max-w-2xl mx-auto bg-gray-800 rounded-lg shadow-lg p-8">
			<h3 class="text-3xl font-bold text-center mb-8">Update Data Profil</h3>

			<!-- Tampilkan pesan error jika ada -->
			<?php if (isset($error_message)): ?>
				<div class="bg-red-600 text-white p-4 rounded mb-4">
					<?= htmlspecialchars($error_message) ?>
				</div>
			<?php endif; ?>

			<form action="update_profile.php" method="POST" class="space-y-6">
				<div>
					<label for="nama" class="block text-sm font-medium">Nama Lengkap</label>
					<input type="text" id="nama" name="nama" required
						class="w-full mt-2 p-3 bg-gray-700 text-gray-100 rounded border border-gray-600"
						value="<?= htmlspecialchars($_POST['nama'] ?? ''); ?>">
				</div>
				<div>
					<label for="email" class="block text-sm font-medium">Email</label>
					<input type="email" id="email" name="email" required
						class="w-full mt-2 p-3 bg-gray-700 text-gray-100 rounded border border-gray-600"
						value="<?= htmlspecialchars($_POST['email'] ?? ''); ?>">
				</div>
				<div>
					<label for="no_kontak" class="block text-sm font-medium">Nomor Handphone</label>
					<input type="text" id="no_kontak" name="no_kontak" required
						class="w-full mt-2 p-3 bg-gray-700 text-gray-100 rounded border border-gray-600"
						value="<?= htmlspecialchars($_POST['no_kontak'] ?? ''); ?>">
				</div>
				<div>
					<label for="username" class="block text-sm font-medium">Username</label>
					<input type="text" id="username" name="username" required
						class="w-full mt-2 p-3 bg-gray-700 text-gray-100 rounded border border-gray-600"
						value="<?= htmlspecialchars($_POST['username'] ?? ''); ?>">
				</div>
				<div>
					<label for="password" class="block text-sm font-medium">Password</label>
					<input type="password" id="password" name="password" required
						class="w-full mt-2 p-3 bg-gray-700 text-gray-100 rounded border border-gray-600">
				</div>
				<button type="submit"
					class="w-full bg-yellow-500 text-gray-900 py-3 rounded-lg hover:bg-yellow-600 font-semibold">
					Simpan Perubahan
				</button>
			</form>
		</div>
	</main>
</body>

</html>