<?php include 'header.php'; ?>

<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Transaksi
      <small>Data Transaksi / Pesanan</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-beranda"></i> Home</a></li>
      <li class="active">Beranda</li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <section class="col-lg-12">
        <div class="box box-info">

          <div class="box-header">
            <h3 class="box-title">Invoice Pesanan</h3>
          </div>
          <div class="box-body">

            <?php 
            // Ambil ID invoice dari URL
            $id_invoice = $_GET['id'];
            // Ambil data invoice
            $invoice = mysqli_query($koneksi, "SELECT * FROM invoice WHERE invoice_id='$id_invoice' ORDER BY invoice_id DESC");
            while ($i = mysqli_fetch_array($invoice)) {
            ?>

            <div class="col-lg-12">
              <a href="transaksi.php" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left"></i> KEMBALI</a>
              <a href="transaksi_invoice_cetak.php?id=<?php echo $_GET['id'] ?>" target="_blank" class="btn btn-default btn-sm"><i class="fa fa-print"></i> CETAK</a>
              <br/><br/>

              <h4>INVOICE-00<?php echo $i['invoice_id'] ?></h4>

              <br/>
              <?php echo $i['invoice_nama']; ?><br/>
              <?php echo $i['invoice_alamat']; ?><br/>
              Hp. <?php echo $i['invoice_hp']; ?><br/>
              <br/>

              <div class="table-responsive">
                <table class="table table-bordered">
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
                    // Perbaiki query dengan alias untuk menghindari ambiguitas
                    $transaksi = mysqli_query($koneksi, "SELECT * FROM transaksi t
                                                          JOIN produk p ON t.transaksi_produk = p.produk_id
                                                          WHERE t.transaksi_invoice = '$id_invoice'");
                    while ($d = mysqli_fetch_array($transaksi)) {
                      $total += $d['transaksi_harga'] * $d['transaksi_jumlah'];
                    ?>
                      <tr>
                        <td class="text-center"><?php echo $no++; ?></td>
                        <td>
                          <center>
                            <?php if ($d['produk_foto1'] == "") { ?>
                              <img src="../gambar/sistem/produk.png" style="width: 50px; height: auto">
                            <?php } else { ?>
                              <img src="../gambar/produk/<?php echo $d['produk_foto1'] ?>" style="width: 50px; height: auto">
                            <?php } ?>
                          </center>
                        </td>
                        <td><?php echo $d['produk_nama']; ?></td>
                        <td class="text-center"><?php echo "Rp. " . number_format($d['transaksi_harga']) . " ,-"; ?></td>
                        <td class="text-center"><?php echo number_format($d['transaksi_jumlah']); ?></td>
                        <td class="text-center"><?php echo "Rp. " . number_format($d['transaksi_jumlah'] * $d['transaksi_harga']) . " ,-"; ?></td>
                      </tr>
                    <?php 
                    }
                    ?>
                  </tbody>
                  <tfoot>
                    <tr>
                      <td colspan="4" style="border: none"></td>
                      <th>Total Belanja</th>
                      <td class="text-center"><?php echo "Rp. " . number_format($total) . " ,-"; ?></td>
                    </tr>
                    
                    <tr>
                      <td colspan="4" style="border: none"></td>
                      <th>Total Bayar</th>
                      <td class="text-center"><?php echo "Rp. " . number_format($i['total_bayar']) . " ,-"; ?></td>
                    </tr>
                  </tfoot>
                </table>
              </div>

              <h5>STATUS :</h5> 
              <?php 
              // Menampilkan status invoice
              if ($i['invoice_status'] == 0) {
                echo "<span class='label label-warning'>Menunggu Pembayaran</span>";
              } elseif ($i['invoice_status'] == 1) {
                echo "<span class='label label-default'>Menunggu Konfirmasi</span>";
              } elseif ($i['invoice_status'] == 2) {
                echo "<span class='label label-danger'>Ditolak</span>";
              } elseif ($i['invoice_status'] == 3) {
                echo "<span class='label label-primary'>Dikonfirmasi & Sedang Diproses</span>";
              } elseif ($i['invoice_status'] == 4) {
                echo "<span class='label label-warning'>Dikirim</span>";
              } elseif ($i['invoice_status'] == 5) {
                echo "<span class='label label-success'>Selesai</span>";
              }
              ?>

            </div>  

            <?php 
            }
            ?>

          </div>

        </div>
      </section>
    </div>
  </section>
</div>

<?php include 'footer.php'; ?>