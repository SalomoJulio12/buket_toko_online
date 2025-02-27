<?php
include 'koneksi.php';

// Ambil data dari form pendaftaran
$nama     = $_POST['nama'];
$email    = $_POST['email'];
$hp       = $_POST['hp'];
$alamat   = $_POST['alamat'];
$password = md5($_POST['password']);

// Cek apakah email sudah digunakan
$cek_email = mysqli_query($koneksi, "SELECT * FROM customer WHERE customer_email='$email'");
if (mysqli_num_rows($cek_email) > 0) {
    // Email sudah terdaftar, alihkan ke halaman daftar dengan alert
    header("location:daftar.php?alert=duplikat");
} else {
    // Tambahkan data pelanggan baru ke database, dengan status "customer_new" = TRUE
    mysqli_query($koneksi, "INSERT INTO customer (customer_id, customer_nama, customer_email, customer_hp, customer_alamat, customer_password, customer_new) VALUES (NULL, '$nama', '$email', '$hp', '$alamat', '$password', TRUE)");

    // Alihkan ke halaman login dengan alert "terdaftar"
    header("location:masuk.php?alert=terdaftar");
}
?>
