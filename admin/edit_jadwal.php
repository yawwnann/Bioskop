<?php
include('../koneksi.php');

$id = $_GET['id_tayang'];
$id_film = $_GET['id_film'];
$id_studio = $_GET['id_studio'];
$tanggal = $_GET['tanggal'];
$jam = $_GET['jam'];
$harga = $_GET['harga'];

$query = "UPDATE jadwal_tayang SET id_film='$id_film', id_studio='$id_studio', tanggal='$tanggal', jam='$jam', harga='$harga' WHERE id_tayang='$id' ";

if (mysqli_query($koneksi, $query)) {
	header("location:./jadwal.php");
} else {
	echo "ERROR, data gagal diupdate" . mysqli_error($koneksi);
}

mysqli_close($koneksi);
