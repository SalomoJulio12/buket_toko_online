<?php 
include 'koneksi.php';
session_start();

$id_produk = $_GET['id'];
$redirect = $_GET['redirect'];

if(isset($_SESSION['keranjang'])){
	for($a = 0; $a < count($_SESSION['keranjang']); $a++){
		if($_SESSION['keranjang'][$a]['produk'] == $id_produk){
			unset($_SESSION['keranjang'][$a]);

			// Urutkan kembali indeks keranjang
			$_SESSION['keranjang'] = array_values($_SESSION['keranjang']);
			break;
		}
	}
}

// Tentukan halaman redirect
if($redirect == "katalog"){
	$r = "katalog.php";
} elseif($redirect == "detail"){
	$r = "produk_detail.php?id=".$id_produk;
} elseif($redirect == "keranjang"){
	$r = "keranjang.php";
}

// JavaScript untuk menampilkan pesan sebelum redirect
echo "<script>
	alert('Produk berhasil dihapus dari keranjang!');
	window.location.href = '$r';
</script>";
?>
