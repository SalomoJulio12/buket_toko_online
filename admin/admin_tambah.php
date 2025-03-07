<?php include 'header.php'; ?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>
      Admin
      <small>Tambah Admin Baru</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-beranda"></i> Home</a></li>
      <li class="active">Beranda</li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <section class="col-lg-6 col-lg-offset-3">       
        <div class="box box-info">

          <div class="box-header">
            <h3 class="box-title">Tambah Admin</h3>
            <a href="admin.php" class="btn btn-info btn-sm pull-right"><i class="fa fa-reply"></i> &nbsp Kembali</a> 
          </div>
          <div class="box-body">
            <form action="admin_act.php" method="post" enctype="multipart/form-data">
              <div class="form-group">
                <label>Nama</label>
                <input type="text" class="form-control" name="nama" required="required" placeholder="Masukkan Nama ..">
              </div>
              <div class="form-group">
                <label>Username</label>
                <input type="text" class="form-control" name="username" required="required" placeholder="Masukkan Username ..">
              </div>
              <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" name="password" required="required" min="5" placeholder="Masukkan Password ..">
              </div>
              <div class="form-group">
                <label>Foto</label>
                <input type="file" name="foto">
              </div>
              <div class="form-group">
                <input type="submit" class="btn btn-sm btn-primary" value="Simpan">
              </div>
            </form>
          </div>

        </div>
      </section>
    </div>
  </section>

</div>
<?php include 'footer.php'; ?>