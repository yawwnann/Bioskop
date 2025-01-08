<?php
include('../koneksi.php');

$nama = $_GET['nama'];
$email = $_GET['email'];
$nomor = $_GET['no_kontak'];
$username = $_GET['username'];
$password = $_GET['password'];

$query = "UPDATE user SET nama='$nama', email='$email', no_kontak=$nomor, username='$username', password='$password' WHERE user.username='$username'";

if (mysqli_query($koneksi, $query)) {
	header("location:profile.php");
} else {
	echo "ERROR, data gagal diupdate" . mysqli_error($koneksi);
}

mysqli_close($koneksi);
?>