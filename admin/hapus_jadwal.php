<?php 

$id = $_GET['id_tayang'];

//include(dbconnect.php);
include('../koneksi.php');

//query hapus
$query = "DELETE FROM jadwal_tayang WHERE id_tayang = '$id' ";

if (mysqli_query($koneksi , $query)) {
	# redirect ke index.php
	header("location:./jadwal.php");
}
else{
	echo "ERROR, data gagal dihapus". mysqli_error($conn);
}

mysqli_close($koneksi);
