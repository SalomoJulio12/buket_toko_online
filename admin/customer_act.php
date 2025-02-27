<?php
include '../koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $hp = $_POST['hp'];
    $alamat = $_POST['alamat'];
    $password = $_POST['password']; // Jangan lupa untuk hash password jika diperlukan

    // Hash password jika perlu
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Query INSERT
    $query = "INSERT INTO customer (customer_nama, customer_email, customer_hp, customer_alamat, customer_password) 
              VALUES ('$nama', '$email', '$hp', '$alamat', '$hashed_password')";

    // Eksekusi query
    if (mysqli_query($koneksi, $query)) {
        echo "Data customer berhasil ditambahkan!";
        // Anda bisa mengarahkan kembali ke halaman customer.php setelah berhasil
        header("Location: customer.php");
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}
?>
