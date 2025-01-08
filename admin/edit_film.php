<?php
include('../koneksi.php');

$id=$_GET['id_film'];
$judul_film = $_GET['judul_film'];
$genre = $_GET['genre'];
$sutradara = $_GET['sutradara'];
$rating = $_GET['rating_usia'];
$sinopsis = $_GET['sinopsis'];
$tahun = $_GET['tahun_tayang'];
$durasi = $_GET['durasi_tayang'];
$image = $_GET['image'];

$query = "UPDATE film SET judul_film='$judul_film', genre='$genre', sutradara='$sutradara', 
rating_usia='$rating', sinopsis='$sinopsis', tahun_tayang='$tahun', 
durasi_tayang='$durasi', image='$image' WHERE film.id_film='$id' ";

if (mysqli_query($koneksi, $query)) {
	header("location:data_film.php");
} else {
	echo "ERROR, data gagal diupdate" . mysqli_error($koneksi);
}

mysqli_close($koneksi);
