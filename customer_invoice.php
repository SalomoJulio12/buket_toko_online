<?php include 'header.php'; ?>

<!-- BREADCRUMB -->
<div id="breadcrumb">
	<div class="container">
		<ul class="breadcrumb">
			<li><a href="index.html">Home</a></li>
			<li class="active">Invoice Customer</li>
		</ul>
	</div>
</div>
<!-- /BREADCRUMB -->

<div class="section">
	<div class="container">
		<div class="row">

			<?php 
			include 'customer_sidebar.php'; 
			?>

			<div id="main" class="col-md-9">

				<h4>INVOICE</h4>

				<div id="store">
					<div class="row">

						<?php 
						$id_invoice = $_GET['id'];
						$id = $_SESSION['customer_id'];
						$invoice = mysqli_query($koneksi, "SELECT * FROM invoice WHERE invoice_customer='$id' AND invoice_id='$id_invoice' ORDER BY invoice_id DESC");
						while ($i = mysqli_fetch_array($invoice)) {
						?>

							<div class="col-lg-12">

								<a href="customer_invoice_cetak.php?id=<?php echo $_GET['id'] ?>" target="_blank" class="btn btn-default btn-sm"><i class="fa fa-print"></i> CETAK</a>

								<br />
								<br />

								<h4>INVOICE-00<?php echo $i['invoice_id'] ?></h4>

								<br />
								<strong>Nama Penerima:</strong> <?php echo $i['invoice_nama']; ?><br />
								<strong>Alamat:</strong> <?php echo $i['invoice_alamat']; ?><br />
								<strong>Nomor HP:</strong> <?php echo $i['invoice_hp']; ?><br />
								<br />

								<!-- Menambahkan informasi Metode Pembayaran dan Pengiriman -->
								<strong>Metode Pembayaran:</strong> 
								<?php echo $i['invoice_metode_pembayaran'] == 'cod' ? 'COD (Bayar di Tempat)' : 'Transfer Bank'; ?><br />
								<strong>Metode Pengiriman:</strong> 
								<?php echo $i['invoice_metode_pengiriman'] == 'diantar' ? 'Diantar ke Alamat' : 'Ambil di Tempat'; ?><br />
								<br />

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
											$transaksi = mysqli_query($koneksi, "SELECT * FROM transaksi JOIN produk ON transaksi.transaksi_produk=produk.produk_id WHERE transaksi_invoice='$id_invoice'");
											while ($t = mysqli_fetch_array($transaksi)) {
												$total = $t['transaksi_jumlah'] * $t['transaksi_harga'];
											?>
												<tr>
													<td class="text-center"><?php echo $no++; ?></td>
													<td colspan="2"><?php echo $t['produk_nama']; ?></td>
													<td class="text-center"><?php echo number_format($t['transaksi_harga'], 0, ',', '.'); ?></td>
													<td class="text-center"><?php echo $t['transaksi_jumlah']; ?></td>
													<td class="text-center"><?php echo number_format($total, 0, ',', '.'); ?></td>
												</tr>
											<?php } ?>
											<tr>
												<td colspan="5" class="text-right"><b>Total Bayar</b></td>
												<td class="text-center"><?php echo number_format($i['total_bayar'], 0, ',', '.'); ?></td>
											</tr>
										</tbody>
									</table>
								</div>

							</div>

						<?php 
						}
						?>

					</div>
				</div>

			</div>

		</div>
	</div>
</div>
