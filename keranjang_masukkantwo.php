<?php
include 'koneksi.php';

session_start();

// Memeriksa apakah form dikirim dengan metode POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Mengambil data yang dikirimkan oleh form
    $quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 0;
    $produk_id = isset($_POST['produk_id']) ? $_POST['produk_id'] : null;

    // Ambil harga per tangkai dari database berdasarkan produk_id
    $data = mysqli_query($koneksi, "SELECT * FROM produk WHERE produk_id='$produk_id'");
    $d = mysqli_fetch_assoc($data);
    $harga_per_tangkai = $d['produk_harga'];

    // Validasi jika produk ID dan quantity valid
    if ($produk_id && $quantity > 0) {
        // Hitung total harga berdasarkan jumlah tangkai
        $total_harga = $harga_per_tangkai * $quantity;

        // Jika keranjang sudah ada
        if (isset($_SESSION['keranjang'])) {
            $keranjang = $_SESSION['keranjang'];
            $sudah_ada = false;

            // Cek apakah produk sudah ada di keranjang
            foreach ($keranjang as $key => $item) {
                if ($item['produk'] == $produk_id) {
                    // Jika produk ada, tambahkan jumlahnya
                    $_SESSION['keranjang'][$key]['jumlah'] += $quantity;
                    $_SESSION['keranjang'][$key]['total_price'] += $total_harga;
                    $sudah_ada = true;
                    break;
                }
            }

            // Jika produk belum ada, tambahkan produk baru ke dalam keranjang
            if (!$sudah_ada) {
                $_SESSION['keranjang'][] = [
                    'produk' => $produk_id,
                    'jumlah' => $quantity,
                    'total_price' => $total_harga
                ];
            }
        } else {
            // Jika keranjang belum ada, buat keranjang dan tambah produk pertama
            $_SESSION['keranjang'] = [
                [
                    'produk' => $produk_id,
                    'jumlah' => $quantity,
                    'total_price' => $total_harga
                ]
            ];
        }

        // Tentukan halaman redirect
        $redirect = isset($_GET['redirect']) ? $_GET['redirect'] : 'keranjang';
        if ($redirect == "index") {
            $r = "katalog.php";
        } elseif ($redirect == "detail") {
            $r = "produk_detail.php?id=" . $produk_id;
        } elseif ($redirect == "keranjang") {
            $r = "keranjang.php";
        }

        // JavaScript untuk menampilkan pesan dan redirect
        echo "<script>
            alert('Produk berhasil ditambahkan ke keranjang!');
            window.location.href = '$r';
        </script>";
    } else {
        echo "Jumlah atau produk tidak valid!";
    }
}
?>
