<!DOCTYPE html>
<html>
<head>
    <title>Invoice</title>
</head>
<body>

    <?php 
    session_start();
    include 'koneksi.php';
    ?>

    <style>
        body {
            font-family: sans-serif;
        }

        .table {
            border-collapse: collapse;
        }

        .table th, .table td {
            padding: 5px 10px;
            border: 1px solid black;
        }
    </style>

    <div>

        <?php 
        // Get the invoice ID from the URL
        $id_invoice = $_GET['id'];
        $id = $_SESSION['customer_id'];

        // Query to get the invoice details based on customer ID and invoice ID
        $invoice_query = "SELECT * FROM invoice WHERE invoice_customer='$id' AND invoice_id='$id_invoice' ORDER BY invoice_id DESC";
        $invoice_result = mysqli_query($koneksi, $invoice_query);

        while($i = mysqli_fetch_array($invoice_result)){
        ?>

        <div>
            <center>
                <h3>Toko Online Nayla Buket</h3>
            </center>

            <h4>INVOICE-00<?php echo $i['invoice_id']; ?></h4>

            <br/>
            <?php echo $i['invoice_nama']; ?><br/>
            <?php echo $i['invoice_alamat']; ?><br/>
            Hp. <?php echo $i['invoice_hp']; ?><br/>
            <br/>

            <table class="table">
                <thead>
                    <tr>
                        <th class="text-center" width="1%">NO</th>
                        <th colspan="2">Produk</th>
                        <th class="text-center">Harga</th>
                        <th class="text-center">Jumlah</th>
                        <th class="text-center">Total Harga</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1;
                    $total = 0;

                    // Join transaksi and produk tables to fetch the product details for the invoice
                    $transaksi_query = "SELECT t.*, p.produk_nama, p.produk_foto1, p.produk_harga FROM transaksi AS t 
                                        JOIN produk AS p ON t.transaksi_produk = p.produk_id 
                                        WHERE t.transaksi_invoice = '$id_invoice'";
                    $transaksi_result = mysqli_query($koneksi, $transaksi_query);

                    while($d = mysqli_fetch_array($transaksi_result)){
                        $total += $d['transaksi_harga'];
                    ?>
                    <tr>
                        <td class="text-center"><?php echo $no++; ?></td>
                        <td>
                            <center>
                                <?php if($d['produk_foto1'] == "") { ?>
                                    <img src="gambar/sistem/produk.png" style="width: 50px;height: auto">
                                <?php } else { ?>
                                    <img src="gambar/produk/<?php echo $d['produk_foto1']; ?>" style="width: 50px;height: auto">
                                <?php } ?>
                            </center>
                        </td>
                        <td><?php echo $d['produk_nama']; ?></td>
                        <td class="text-center"><?php echo "Rp. ".number_format($d['transaksi_harga']).",-"; ?></td>
                        <td class="text-center"><?php echo number_format($d['transaksi_jumlah']); ?></td>
                        <td class="text-center"><?php echo "Rp. ".number_format($d['transaksi_jumlah'] * $d['transaksi_harga'])." ,-"; ?></td>
                    </tr>
                    <?php 
                    }
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4" style="border: none"></td>
                        <th>Total Belanja</th>
                        <td class="text-center"><?php echo "Rp. ".number_format($total)." ,-"; ?></td>
                    </tr>
                    <tr>
                        <td colspan="4" style="border: none"></td>
                        <th>Total Bayar</th>
                        <td class="text-center"><?php echo "Rp. ".number_format($i['total_bayar'])." ,-"; ?></td>
                    </tr>
                </tfoot>
            </table>

            <h5>STATUS :</h5> 
            <?php 
            if($i['invoice_status'] == 0){
                echo "<span class='label label-warning'>Menunggu Pembayaran</span>";
            } elseif($i['invoice_status'] == 1){
                echo "<span class='label label-default'>Menunggu Konfirmasi</span>";
            } elseif($i['invoice_status'] == 2){
                echo "<span class='label label-danger'>Ditolak</span>";
            } elseif($i['invoice_status'] == 3){
                echo "<span class='label label-primary'>Dikonfirmasi & Sedang Diproses</span>";
            } elseif($i['invoice_status'] == 4){
                echo "<span class='label label-warning'>Dikirim</span>";
            } elseif($i['invoice_status'] == 5){
                echo "<span class='label label-success'>Selesai</span>";
            }
            ?>
        </div>  

        <?php 
        }
        ?>

    </div>

    <script>
        window.print();
    </script>

</body>
</html>