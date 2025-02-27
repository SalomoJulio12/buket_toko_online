<?php include 'header.php'; ?>

<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Kategori
      <small>Data Kategori</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-beranda"></i> Home</a></li>
      <li class="active">Beranda</li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <section class="col-lg-8">
        <div class="box box-info">
          <div class="box-header">
            <h3 class="box-title">Kategori</h3>
            <div class="btn-group pull-right">
              <a href="kategori_tambah.php" class="btn btn-info btn-sm"><i class="fa fa-plus"></i> &nbsp Tambah kategori</a>              
            </div>
          </div>
          <div class="box-body">
            <div class="table-responsive">
              <table class="table table-bordered table-striped" id="table-datatable">
                <thead>
                  <tr>
                    <th width="1%">NO</th>
                    <th>NAMA</th>
                    <th width="15%">OPSI</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  include '../koneksi.php';
                  $no=1;
                  $data = mysqli_query($koneksi,"SELECT * FROM kategori");
                  while($d = mysqli_fetch_array($data)){
                    ?>
                    <tr>
                      <td><?php echo $no++; ?></td>
                      <td><?php echo $d['kategori_nama']; ?></td>
                      <td>                       
                        <?php if($d['kategori_id'] != 1){ ?>  
                          <a class="btn btn-warning btn-sm" href="kategori_edit.php?id=<?php echo $d['kategori_id'] ?>"><i class="fa fa-cog"></i></a>
                          <!-- Tombol hapus dengan konfirmasi JavaScript -->
                          <a class="btn btn-danger btn-sm" href="javascript:void(0);" onclick="confirmDelete(<?php echo $d['kategori_id']; ?>)"><i class="fa fa-trash"></i></a>
                        <?php } ?>
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
      </section>
    </div>
  </section>
</div>

Script JavaScript untuk Konfirmasi Penghapusan
<script type="text/javascript">
  function confirmDelete(id) {
    // Menampilkan konfirmasi penghapusan
    if (confirm("Apakah Anda yakin ingin menghapus kategori ini?")) {
      // Jika pengguna mengonfirmasi, lakukan penghapusan dengan mengarahkan ke halaman kategori_hapus_konfir.php
      window.location.href = "kategori_hapus.php?id=" + id;
    }
  }
</script>

<?php include 'footer.php'; ?>
