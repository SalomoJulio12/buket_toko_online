<?php
include '../koneksi.php';

$invoice = mysqli_real_escape_string($koneksi, $_POST['invoice']);
$status = mysqli_real_escape_string($koneksi, $_POST['status']);

$query = "UPDATE invoice SET invoice_status='$status' WHERE invoice_id='$invoice'";
if (!mysqli_query($koneksi, $query)) {
    die("Error: " . mysqli_error($koneksi));
}

header("location:transaksi.php?alert=update_sukses");
exit();
?>
