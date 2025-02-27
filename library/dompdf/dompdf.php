<?php
// Memuat file autoload Dompdf
require_once '../vendor/autoload.php'; // Pastikan path ini sesuai

use Dompdf\Dompdf;

// Membuat objek Dompdf
$dompdf = new DOMPDF();

// Koneksi ke database
include '../koneksi.php';

if (isset($_GET['tanggal_sampai']) && isset($_GET['tanggal_dari'])) {
    $tgl_dari = $_GET['tanggal_dari'];
    $tgl_sampai = $_GET['tanggal_sampai'];

    // Memulai HTML untuk laporan PDF
    $html = "
    <style>
        body { font-family: sans-serif; }
        .table { width: 100%; border-collapse: collapse; }
        .table, .table th, .table td { padding: 5px; border: 1px solid black; }
    </style>
    <center><h2>Laporan Penjualan Toko Online Nayla Buket</h2></center>
    <br/>
    <table>
        <tr><td width='20%'>DARI TANGGAL</td><td width='1%'>:</td><td>$tgl_dari</td></tr>
        <tr><td>SAMPAI TANGGAL</td><td>:</td><td>$tgl_sampai</td></tr>
    </table>
    <br/>
    <table class='table'>
        <thead>
            <tr>
                <th width='1%'>NO</th>
                <th>INVOICE</th>
                <th>TANGGAL MASUK</th>
                <th>NAMA PEMBELI</th>
                <th>JUMLAH</th>
                <th>STATUS</th>
            </tr>
        </thead>
        <tbody>";

    $no = 1;
    $data = mysqli_query($koneksi, "SELECT * FROM invoice, customer WHERE invoice_customer=customer_id AND date(invoice_tanggal) >= '$tgl_dari' AND date(invoice_tanggal) <= '$tgl_sampai'");
    
    while ($i = mysqli_fetch_array($data)) {
        $invoice_id = $i['invoice_id'];
        $invoice_tanggal = date('d-m-Y', strtotime($i['invoice_tanggal']));
        $customer_nama = $i['customer_nama'];
        $invoice_total_bayar = "Rp. " . number_format($i['invoice_total_bayar']) . " ,-";
        $status = match ($i['invoice_status']) {
            0 => "Menunggu Pembayaran",
            1 => "Menunggu Konfirmasi",
            2 => "Ditolak",
            3 => "Dikonfirmasi & Sedang Diproses",
            4 => "Dikirim",
            5 => "Selesai",
            default => "Tidak Diketahui"
        };

        $html .= "
        <tr>
            <td>$no</td>
            <td>INVOICE-00$invoice_id</td>
            <td>$invoice_tanggal</td>
            <td>$customer_nama</td>
            <td>$invoice_total_bayar</td>
            <td>$status</td>
        </tr>";
        $no++;
    }

    $html .= "</tbody></table>";
} else {
    $html = "<div style='text-align: center;'>Silahkan Filter Laporan Terlebih Dulu.</div>";
}

// Memuat HTML ke dalam objek Dompdf
$dompdf->loadHtml($html);

// Mengatur ukuran kertas dan orientasi
$dompdf->setPaper('A4', 'portrait');

// Render HTML menjadi PDF
$dompdf->render();

// Menampilkan PDF di browser
$dompdf->stream("Laporan_Penjualan.pdf", ["Attachment" => false]);
?>
