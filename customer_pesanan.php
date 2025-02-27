<?php include 'header.php'; ?>

<!-- BREADCRUMB -->
<div id="breadcrumb">
	<div class="container">
		<ul class="breadcrumb">
			<li><a href="index.html">Home</a></li>
			<li class="active">Pesanan Customer</li>
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
				
				<h4>PESANAN</h4>

				<div id="store">
					<div class="row">

						<div class="col-lg-12">

							<?php 
							if(isset($_GET['alert'])){
								if($_GET['alert'] == "gagal"){
									echo "<div class='alert alert-danger'>Gambar gagal diupload!</div>";
								}elseif($_GET['alert'] == "sukses"){
									echo "<div class='alert alert-success'>Pesanan berhasil dibuat, silahkan melakukan pembayaran!</div>";
								}elseif($_GET['alert'] == "upload"){
									echo "<div class='alert alert-success'>Konfirmasi pembayaran berhasil tersimpan, silahkan menunggu konfirmasi dari admin!</div>";
								}
							}
							?>

							<small class="text-muted">
								Semua data pesanan / invoice anda.
							</small>

							<br/>
							<br/>

							<div class="table-responsive">
								<table class="table table-bordered">
									<thead>
										<tr>
											<th>NO</th>
											<th>No.Invoice</th>
											<th>Tanggal</th>
											<th>Nama Penerima</th>
											<th>Total Bayar</th>
											<th>Metode Pembayaran</th>
											<th>Metode Pengiriman</th>
											<th>Status</th>
											<th class="text-center">OPSI</th>
										</tr>
									</thead>
									<tbody>
										<?php
										include 'koneksi.php';
										$no = 1;
										$customer_id = $_SESSION['customer_id']; // Ambil ID pelanggan dari sesi
										
										$data = mysqli_query($koneksi, "SELECT * FROM invoice WHERE invoice_customer='$customer_id' ORDER BY invoice_tanggal DESC");
										while($d = mysqli_fetch_array($data)){
										?>
											<tr>
												<td><?= $no++; ?></td>
												<td>INVOICE-00<?= $d['invoice_id']; ?></td>
												<td><?= date('d-m-Y', strtotime($d['invoice_tanggal'])); ?></td>
												<td><?= $d['invoice_nama']; ?></td>
												<td><?= "Rp. " . number_format($d['total_bayar'], 0, ',', '.') . " ,-"; ?></td>
												<td>
													<?php
													if ($d['invoice_metode_pembayaran'] == 'cod') {
														echo 'COD';
													} elseif ($d['invoice_metode_pembayaran'] == 'transfer') {
														echo 'Transfer Bank';
													} else {
														echo 'Metode Pembayaran Tidak Diketahui';
													}
													?>
												</td>
												<td>
													<?php
													if ($d['invoice_metode_pengiriman'] == 'antar') {
														echo 'Antar ke Alamat';
													} elseif ($d['invoice_metode_pengiriman'] == 'ambil') {
														echo 'Ambil di Tempat';
													} else {
														echo 'Metode Pengiriman Tidak Diketahui';
													}
													
													?>
												</td>
												<td class="text-center">
													<?php 
													if($d['invoice_status'] == 0){
														echo "<span class='label label-warning'>Menunggu Pembayaran</span>";
													}elseif($d['invoice_status'] == 1){
														echo "<span class='label label-default'>Menunggu Konfirmasi</span>";
													}elseif($d['invoice_status'] == 2){
														echo "<span class='label label-danger'>Ditolak</span>";
													}elseif($d['invoice_status'] == 3){
														echo "<span class='label label-primary'>Dikonfirmasi & Sedang Diproses</span>";
													}elseif($d['invoice_status'] == 4){
														echo "<span class='label label-warning'>Dikirim</span>";
													}elseif($d['invoice_status'] == 5){
														echo "<span class='label label-success'>Selesai</span>";
													}
													?>
												</td>
												<td class="text-center">
													<?php 
													if($d['invoice_status'] == 0){
														?>
														<a class='btn btn-sm btn-primary' href="customer_pembayaran.php?id=<?= $d['invoice_id']; ?>"><i class="fa fa-money"></i> Konfirmasi Pembayaran</a>
														<?php
													}
													?>
													<a class='btn btn-sm btn-success' href="customer_invoice.php?id=<?= $d['invoice_id']; ?>"><i class="fa fa-print"></i> Invoice</a>
												</td>
											</tr>
										<?php
										}
										?>
									</tbody>
								</table>
							</div>
						</div>	
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php include 'footer.php'; ?>
