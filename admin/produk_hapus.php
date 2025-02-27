<?php
include '../koneksi.php';
$id = $_GET['id'];
$data = mysqli_query($koneksi, "SELECT * FROM produk WHERE produk_id='$id'");
$d = mysqli_fetch_assoc($data);
$foto1 = $d['produk_foto1'];
$foto2 = $d['produk_foto2'];
$foto3 = $d['produk_foto3'];

// Hapus gambar produk jika ada
if ($foto1 != "") unlink("../gambar/produk/$foto1");
if ($foto2 != "") unlink("../gambar/produk/$foto2");
if ($foto3 != "") unlink("../gambar/produk/$foto3");

// Hapus produk dari database
mysqli_query($koneksi, "DELETE FROM produk WHERE produk_id='$id'");

// Hapus transaksi terkait produk
$data = mysqli_query($koneksi, "SELECT * FROM transaksi WHERE transaksi_produk='$id'");
while($d = mysqli_fetch_array($data)){
    $id_invoice = $d['transaksi_invoice'];
    mysqli_query($koneksi, "DELETE FROM invoice WHERE invoice_id='$id_invoice'");
}

// Hapus transaksi produk
mysqli_query($koneksi, "DELETE FROM transaksi WHERE transaksi_produk='$id'");

header("Location: produk.php");
exit;
?>
