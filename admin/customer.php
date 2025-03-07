<?php include 'header.php'; ?>

<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Customer
      <small>Data Customer</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-beranda"></i> Home</a></li>
      <li class="active">Beranda</li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <section class="col-lg-10 col-lg-offset-1">
        <div class="box box-info">
          <div class="box-header">
            <h3 class="box-title">Customer</h3>
            <a href="customer_tambah.php" class="btn btn-info btn-sm pull-right"><i class="fa fa-plus"></i> &nbsp Tambah Customer Baru</a>              
          </div>
          <div class="box-body">
            <div class="table-responsive">
              <table class="table table-bordered table-striped" id="table-datatable">
                <thead>
                  <tr>
                    <th width="1%">NO</th>
                    <th>NAMA</th>
                    <th>EMAIL</th>
                    <th>HP</th>
                    <th>ALAMAT</th>
                    <th width="10%">OPSI</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  include '../koneksi.php';

                  // Cek koneksi
                  if (!$koneksi) {
                      die("Koneksi database gagal: " . mysqli_connect_error());
                  }

                  $no = 1;
                  $data = mysqli_query($koneksi, "SELECT * FROM customer");

                  if (mysqli_num_rows($data) == 0) {
                      echo "<tr><td colspan='6'>Tidak ada data customer ditemukan.</td></tr>";
                  } else {
                      while ($d = mysqli_fetch_array($data)) {
                          ?>
                          <tr>
                              <td><?php echo $no++; ?></td>
                              <td><?php echo $d['customer_nama']; ?></td>
                              <td><?php echo $d['customer_email']; ?></td>
                              <td><?php echo $d['customer_hp']; ?></td>
                              <td><?php echo $d['customer_alamat']; ?></td>
                              <td>                        
                                <a class="btn btn-warning btn-sm" href="customer_edit.php?id=<?php echo $d['customer_id']; ?>"><i class="fa fa-cog"></i></a>
                                <a class="btn btn-danger btn-sm" href="javascript:void(0);" onclick="confirmDelete(<?php echo $d['customer_id']; ?>)"><i class="fa fa-trash"></i></a>
                              </td>
                          </tr>
                          <?php 
                      }
                  }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </section>
    </div>
  </section>
</div>

<script type="text/javascript">
  function confirmDelete(id) {
    if (confirm("Apakah Anda yakin ingin menghapus customer ini?")) {
      window.location.href = "customer_hapus.php?id=" + id;
    }
  }
</script>

<?php include 'footer.php'; ?>
