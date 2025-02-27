<?php 
include 'koneksi.php';

$id_produk = $_GET['id'];
$redirect = $_GET['redirect'];

$data = mysqli_query($koneksi,"SELECT * FROM produk, kategori WHERE kategori_id=produk_kategori AND produk_id='$id_produk'");
$d = mysqli_fetch_assoc($data);

session_start();

// Cek jika sudah ada keranjang
if(isset($_SESSION['keranjang'])){
    $jumlah_isi_keranjang = count($_SESSION['keranjang']);
    $sudah_ada = false;

    // Cek apakah produk sudah ada di dalam keranjang
    for($a = 0; $a < $jumlah_isi_keranjang; $a++){
        if($_SESSION['keranjang'][$a]['produk'] == $id_produk){
            // Jika produk ada, tambah jumlahnya
            $_SESSION['keranjang'][$a]['jumlah'] += 1;
            $sudah_ada = true;
            break;
        }
    }

    // Jika produk belum ada, tambahkan produk baru ke dalam keranjang
    if(!$sudah_ada){
        $_SESSION['keranjang'][$jumlah_isi_keranjang] = array(
            'produk' => $id_produk,
            'jumlah' => 1
        );
    }

} else {
    // Jika keranjang belum ada, buat keranjang dan tambah produk pertama
    $_SESSION['keranjang'][0] = array(
        'produk' => $id_produk,
        'jumlah' => 1
    );
}

// Tentukan halaman redirect
if($redirect == "index"){
    $r = "katalog.php";
} elseif($redirect == "detail"){
    $r = "produk_detail.php?id=".$id_produk;
} elseif($redirect == "keranjang"){
    $r = "keranjang.php";
}

// JavaScript untuk menampilkan pesan sebelum redirect
echo "<script>
    alert('Produk berhasil ditambahkan ke keranjang!');
    window.location.href = '$r';
</script>";
?>
