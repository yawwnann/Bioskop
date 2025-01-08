<?php
//add dbconnect

include('../koneksi.php');

$id_film = $_POST['id_film'];
$id_studio = $_POST['id_studio'];
$tanggal = $_POST['tanggal'];
$jam = $_POST['jam'];
$harga = $_POST['harga'];
//query

$query =  "INSERT INTO jadwal_tayang (id_tayang, id_film, id_studio, tanggal, jam, harga) 
VALUES ('$id','$id_film', '$id_studio', '$tanggal', '$jam', '$harga')";

if (mysqli_query($koneksi, $query)) {

    header("location:./jadwal.php");
} else {
    echo "ERROR, tidak berhasil" . mysqli_error($koneksi);
}

mysqli_close($koneksi);
