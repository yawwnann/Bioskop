<?php
//add dbconnect

include('../koneksi.php');

$nama = $_POST['nama'];
$email = $_POST['email'];
$no_kontak = $_POST['no_kontak'];
$username = $_POST['username'];
$password = $_POST['password'];
$level = $_POST['level'];
//query

$query =  "INSERT INTO user (id_user, nama, email, no_kontak, username, password, level) 
VALUES ('$id','$nama', '$email', '$no_kontak', '$username', '$password', '$level')";

if (mysqli_query($koneksi, $query)) {

    header("location:data_user.php");
} else {
    echo "ERROR, tidak berhasil" . mysqli_error($koneksi);
}

mysqli_close($koneksi);
