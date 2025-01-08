<?php
// Koneksi ke database
include('../koneksi.php');

// Mengambil data dari form
$judul_film = $_POST['judul_film'];
$genre = $_POST['genre'];
$sutradara = $_POST['sutradara'];
$rating_usia = $_POST['rating_usia'];
$sinopsis = $_POST['sinopsis'];
$durasi_tayang = $_POST['durasi_tayang'];
$tahun_tayang = $_POST['tahun_tayang'];
$image_url = $_POST['image_url']; // URL gambar

// Validasi URL gambar
if (!filter_var($image_url, FILTER_VALIDATE_URL)) {
    die("URL gambar tidak valid.");
}

// Query untuk menambahkan data ke tabel film
$query = "INSERT INTO film (judul_film, genre, sutradara, rating_usia, sinopsis, durasi_tayang, tahun_tayang, image) 
          VALUES ('$judul_film', '$genre', '$sutradara', '$rating_usia', '$sinopsis', '$durasi_tayang', '$tahun_tayang', '$image_url')";

// Eksekusi query
if (mysqli_query($koneksi, $query)) {
    // Redirect ke halaman data film
    header("location:data_film.php");
} else {
    // Menampilkan error jika gagal
    echo "ERROR: Tidak berhasil menambahkan data: " . mysqli_error($koneksi);
}

// Menutup koneksi
mysqli_close($koneksi);
?>