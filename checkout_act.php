<?php
include 'koneksi.php';

session_start();

// Ambil data pelanggan dari sesi
$id_customer = $_SESSION['customer_id'];
$tanggal = date('Y-m-d');

// Ambil data checkout dari form
$nama = $_POST['nama'];
$hp = $_POST['hp'];
$alamat = $_POST['alamat'];
$total_bayar = $_POST['total_bayar']; // Total sebelum diskon
$metode_pembayaran = $_POST['metode_pembayaran']; // Payment method from form
$metode_pengiriman = $_POST['metode_pengiriman']; // Shipping method from form
$invoice_status = 0; // Status default: 0 (belum diproses)

// Cek apakah pelanggan adalah pelanggan baru
$query = "SELECT customer_new FROM customer WHERE customer_id = '$id_customer'";
$result = mysqli_query($koneksi, $query);
$customer = mysqli_fetch_assoc($result);

// Terapkan diskon jika pelanggan baru
if ($customer['customer_new']) {
    $total_bayar = $total_bayar * 0.85; // Terapkan diskon 15%
    // Update status pelanggan menjadi bukan pelanggan baru
    mysqli_query($koneksi, "UPDATE customer SET customer_new = FALSE WHERE customer_id = '$id_customer'");
}

// Simpan data invoice
$query_invoice = "INSERT INTO invoice 
    (invoice_tanggal, invoice_customer, invoice_nama, invoice_hp, invoice_alamat, total_bayar, invoice_metode_pembayaran, invoice_metode_pengiriman, invoice_status)
    VALUES ('$tanggal', '$id_customer', '$nama', '$hp', '$alamat', '$total_bayar', '$metode_pembayaran', '$metode_pengiriman', '$invoice_status')";

mysqli_query($koneksi, $query_invoice) or die(mysqli_error($koneksi));

// Ambil ID invoice terakhir yang dimasukkan
$last_id = mysqli_insert_id($koneksi);

// Proses transaksi berdasarkan isi keranjang
$jumlah_isi_keranjang = count($_SESSION['keranjang']);

for ($a = 0; $a < $jumlah_isi_keranjang; $a++) {
    $id_produk = $_SESSION['keranjang'][$a]['produk'];
    $jml = $_SESSION['keranjang'][$a]['jumlah'];

    // Ambil data produk dari database
    $isi = mysqli_query($koneksi, "SELECT * FROM produk WHERE produk_id='$id_produk'");
    $i = mysqli_fetch_assoc($isi);

    // Ambil data produk yang diperlukan
    $produk = $i['produk_id'];
    $harga = $i['produk_harga'];
    $subtotal = $harga * $jml; // Total harga per produk

    // Simpan data transaksi (termasuk total_bayar dan invoice_status)
    mysqli_query($koneksi, "INSERT INTO transaksi 
        (transaksi_id, transaksi_invoice, transaksi_produk, transaksi_jumlah, transaksi_harga, total_bayar, invoice_status) 
        VALUES (NULL, '$last_id', '$produk', '$jml', '$harga', '$subtotal', '$invoice_status')");

    // Hapus item dari keranjang setelah disimpan
    unset($_SESSION['keranjang'][$a]);
}

// Arahkan ke halaman pesanan dengan pesan sukses
header("location:customer_pesanan.php?alert=sukses");
?>