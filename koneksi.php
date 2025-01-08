<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$database = 'bioskop';

$koneksi = mysqli_connect($servername, $username, $password, $database);

if ($koneksi->connect_error) {
    echo 'Koneksi Gagal : ' . $koneksi->connect_error;
}

