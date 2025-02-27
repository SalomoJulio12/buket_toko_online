<?php
session_start();  // Start the session at the very top

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the form data
    $produk_id = $_POST['produk_id'];
    $harga = $_POST['harga'];
    $jumlah_produk = $_POST['jumlah_produk'];

    // Add to the cart (session)
    if (!isset($_SESSION['keranjang'])) {
        $_SESSION['keranjang'] = [];  // Initialize the cart if it doesn't exist
    }

    // Add the new product to the cart array
    $_SESSION['keranjang'][] = [
        'produk_id' => $produk_id,
        'harga' => $harga,
        'jumlah' => $jumlah_produk
    ];

    echo "Redirecting to checkout...";
    header('Location: checkout.php');
    exit();
}

?>