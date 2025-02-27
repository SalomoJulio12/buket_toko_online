<?php
// Menghubungkan dengan koneksi
include 'koneksi.php';

// Menangkap data yang dikirim dari form
$email = $_POST['email'];
$password = md5($_POST['password']);

// Cek keberadaan akun dengan email dan password yang sesuai
$login = mysqli_query($koneksi, "SELECT * FROM customer WHERE customer_email='$email' AND customer_password='$password'");
$cek = mysqli_num_rows($login);

if ($cek > 0) {
    session_start();
    $data = mysqli_fetch_assoc($login);

    // Hapus session lain agar tidak bentrok dengan session customer
    unset($_SESSION['id']);
    unset($_SESSION['nama']);
    unset($_SESSION['username']);
    unset($_SESSION['status']);

    // Buat session untuk customer
    $_SESSION['customer_id'] = $data['customer_id'];
    $_SESSION['customer_name'] = $data['customer_nama'];
    $_SESSION['customer_new'] = $data['customer_new']; // Tandai apakah customer baru
    $_SESSION['customer_status'] = "login";

    // Arahkan ke halaman customer
    header("location:customer.php");
} else {
    // Jika login gagal, kembali ke halaman login dengan alert
    header("location:masuk.php?alert=gagal");
}
?>
