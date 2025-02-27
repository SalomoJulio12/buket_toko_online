<?php 
include '../koneksi.php';

$nama       = $_POST['nama'];
$kategori   = $_POST['kategori'];
$harga      = $_POST['harga'];
$keterangan = $_POST['keterangan'];
$berat      = $_POST['berat'];
$jumlah     = $_POST['jumlah'];

$rand = rand();
$allowed =  array('gif','png','jpg','jpeg');

$filename1 = $_FILES['foto1']['name'];
$filename2 = $_FILES['foto2']['name'];
$filename3 = $_FILES['foto3']['name'];

// Insert produk data tanpa foto terlebih dahulu
mysqli_query($koneksi, "insert into produk values (NULL,'$nama','$kategori','$harga','$keterangan','$jumlah','$berat','','','')");

$last_id = mysqli_insert_id($koneksi);

// Proses upload foto 1
if($filename1 != "") {
    $ext = pathinfo($filename1, PATHINFO_EXTENSION);
    if(in_array($ext, $allowed)) {
        $new_filename1 = $rand . '_' . $filename1;
        move_uploaded_file($_FILES['foto1']['tmp_name'], '../gambar/produk/' . $new_filename1);
        mysqli_query($koneksi, "update produk set produk_foto1='$new_filename1' where produk_id='$last_id'");
    }
}

// Proses upload foto 2
if($filename2 != "") {
    $ext = pathinfo($filename2, PATHINFO_EXTENSION);
    if(in_array($ext, $allowed)) {
        $new_filename2 = $rand . '_' . $filename2;
        move_uploaded_file($_FILES['foto2']['tmp_name'], '../gambar/produk/' . $new_filename2);
        mysqli_query($koneksi, "update produk set produk_foto2='$new_filename2' where produk_id='$last_id'");
    }
}

// Proses upload foto 3
if($filename3 != "") {
    $ext = pathinfo($filename3, PATHINFO_EXTENSION);
    if(in_array($ext, $allowed)) {
        $new_filename3 = $rand . '_' . $filename3;
        move_uploaded_file($_FILES['foto3']['tmp_name'], '../gambar/produk/' . $new_filename3);
        mysqli_query($koneksi, "update produk set produk_foto3='$new_filename3' where produk_id='$last_id'");
    }
}

// Redirect ke halaman produk dengan pesan sukses
header("location:produk.php?status=success");
?>
