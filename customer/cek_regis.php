<?php
include "../koneksi.php";

$nama= $_POST['nama'];
$email=$_POST['email'];
$nomor=$_POST['no_kontak'];
$username=$_POST['username'];
$password=$_POST['password'];
$level= 'customer';

$query="INSERT INTO user(id_user,nama, email, no_kontak, username, password, level) 
VALUES ('$id_user','$nama','$email','$nomor','$username','$password','$level')";
if (mysqli_query($koneksi, $query)) {
    
    header("location:../login.php");
} else {
    echo "ERROR, tidak berhasil" . mysqli_error($koneksi);
}

mysqli_close($koneksi);
?>