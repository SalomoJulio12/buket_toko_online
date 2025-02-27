<?php include 'header.php'; ?>



<!-- Section -->
<div class="section">
	<div class="container">
		<div class="row">

			<!-- MAIN -->
			<div id="main" class="col-md-12">
				<!-- Store Top Filter -->
				<form action="" method="get">
					<div class="store-filter clearfix">
						<div class="pull-right">
							<div class="sort-filter">
								<span class="text-uppercase">Urutkan :</span>
								<select class="input" name="urutan" onchange="this.form.submit()">
									<option value="terbaru" <?= (isset($_GET['urutan']) && $_GET['urutan'] == "terbaru") ? "selected" : "" ?>>Terbaru</option>
									<option value="harga" <?= (isset($_GET['urutan']) && $_GET['urutan'] == "harga") ? "selected" : "" ?>>Harga</option>
								</select>
							</div>
						</div>
					</div>
				</form>
			

				<!-- STORE -->
				<div id="store">
					<div class="row">
						<?php
						// Pagination and Filtering Logic
						$halaman = 12;
						$page = isset($_GET["halaman"]) ? (int)$_GET["halaman"] : 1;
						$mulai = ($page > 1) ? ($page * $halaman) - $halaman : 0;

						//  total products
						$result = mysqli_query($koneksi, "SELECT * FROM produk");
						$total = mysqli_num_rows($result);
						$pages = ceil($total / $halaman);

						$order_by = isset($_GET['urutan']) && $_GET['urutan'] == "harga" ? "produk_harga ASC" : "produk_id DESC";
						$search_query = isset($_GET['cari']) ? "AND produk_nama LIKE '%" . mysqli_real_escape_string($koneksi, $_GET['cari']) . "%'" : "";

						// Fetch products
						$data = mysqli_query($koneksi, "SELECT * FROM produk, kategori WHERE kategori_id=produk_kategori $search_query ORDER BY $order_by LIMIT $mulai, $halaman");

						while ($d = mysqli_fetch_array($data)) {
						?>
							<!-- Product Single -->
							<div class="col-md-3 col-sm-6 col-xs-6">
								<div class="product product-single">
									<div class="product-thumb">
										<div class="product-label">
											<span><?= $d['kategori_nama'] ?></span>
										</div>
										<a href="produk_detail.php?id=<?= $d['produk_id'] ?>" class="main-btn quick-view"><i class="fa fa-search-plus"></i> Quick view</a>
										<img src="<?= $d['produk_foto1'] ? "gambar/produk/" . $d['produk_foto1'] : "gambar/sistem/produk.png" ?>" style="height: 250px">
									</div>
									<div class="product-body">
										<h3 class="product-price">
											<?= "Rp. " . number_format($d['produk_harga']) . ",-" ?>
											<?php if ($d['produk_jumlah'] == 0) { ?> 
												<del class="product-old-price">Kosong</del>
											<?php } ?>
										</h3>
										<div class="product-rating">
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star-o empty"></i>
										</div>
										<h2 class="product-name"><a href="produk_detail.php?id=<?= $d['produk_id'] ?>"><?= $d['produk_nama'] ?></a></h2>
										<div class="product-btns">
											<a class="main-btn btn-block text-center" href="produk_detail.php?id=<?= $d['produk_id'] ?>"><i class="fa fa-search"></i> Lihat</a>
											<a class="primary-btn add-to-cart btn-block text-center" href="keranjang_masukkan.php?id=<?= $d['produk_id']; ?>&redirect=index"><i class="fa fa-shopping-cart"></i> Masukkan Keranjang</a>
										</div>
									</div>
								</div>
							</div>
							<!-- /Product Single -->
						<?php } ?>
					</div>
				</div>
				<!-- /STORE -->

				<!-- Pagination -->
				<div class="store-filter clearfix">
					<div class="pull-right">
						<ul class="store-pages">
							<li><span class="text-uppercase">Page:</span></li>
							<?php
							for ($i = 1; $i <= $pages; $i++) {
								$cari = isset($_GET['cari']) ? "&cari=" . $_GET['cari'] : "";
								$urutan = isset($_GET['urutan']) ? "&urutan=" . $_GET['urutan'] : "";
								$isActive = ($page == $i) ? "class='active'" : "";
								echo "<li $isActive><a href='?halaman=$i$cari$urutan'>$i</a></li>";
							}
							?>
						</ul>
					</div>
				</div>
				<!-- /Pagination -->

			</div>
			<!-- /MAIN -->
		</div>
	</div>
</div>
<!-- /Section -->

<?php include 'footer.php'; ?>