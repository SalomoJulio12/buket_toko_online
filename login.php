<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <title>Toko Online Nayla Buket</title>
  <link rel="stylesheet" href="assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="assets/bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="assets/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="assets/plugins/iCheck/square/blue.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <style>
    body {
      background-image: url('assets/img/bglogin.png');
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      overflow: hidden;
    }

    .background-blur {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      backdrop-filter: blur(8px);
      background-color: rgba(0, 0, 0, 0.5);
      z-index: -1;
    }

    .login-box {
      background: rgba(255, 255, 255, 0.3); /* Make the background semi-transparent */
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
      text-align: center;
      backdrop-filter: blur(10px); /* Add blur effect */
      -webkit-backdrop-filter: blur(10px); /* For Safari */
    }

    .login-box img {
      width: 100px;
      margin-bottom: 15px;
    }

    .login-box h2, .login-box h3 {
      color: #333;
      font-weight: bold;
    }

    .btn-primary {
      background-color: #007bff;
      border: none;
    }

    .btn-primary:hover {
      background-color: #0056b3;
    }

    .form-control {
      background: rgba(255, 255, 255, 0.3); /* Make input fields semi-transparent */
      border: 1px solid #ccc;
      color: #333;
      backdrop-filter: blur(5px); /* Add blur effect to input fields */
      -webkit-backdrop-filter: blur(5px); /* For Safari */
    }

    .form-control:focus {
      border-color: #007bff;
      box-shadow: none;
      background: rgba(255, 255, 255, 0.5); /* Increase opacity on focus */
    }

    .login-box-body {
      background: rgba(255, 255, 255, 0.3); /* Set semi-transparent background */
      padding: 15px;
      border-radius: 10px;
      backdrop-filter: blur(5px); /* Add blur effect */
      -webkit-backdrop-filter: blur(5px); /* For Safari */
    }

    .password-field {
      position: relative;
    }

    .toggle-password {
      position: absolute;
      right: 10px;
      top: 50%;
      transform: translateY(-50%);
      cursor: pointer;
      color: #666;
    }
  </style>
</head>
<body>
  <div class="background-blur"></div>

  <div class="container">
    <div class="login-box">
      <img src="frontend/img/logobuket.png" alt="Logo Toko Online Nayla Buket">

      <h2>TOKO ONLINE</h2>
      <h3>NAYLA BUKET</h3>

      <br/>

      <?php 
      if (isset($_GET['alert'])) {
        if ($_GET['alert'] == "login berhasil") {
          echo "<div class='alert alert-danger'>Login gagal! Username atau password salah.</div>";
        } elseif ($_GET['alert'] == "logout") {
          echo "<div class='alert alert-success'>Anda telah berhasil logout.</div>";
        } elseif ($_GET['alert'] == "belum_login") {
          echo "<div class='alert alert-warning'>Anda harus login untuk mengakses halaman admin.</div>";
        } elseif ($_GET['alert'] == "berhasil") {
          echo "<div class='alert alert-success'>Login berhasil! Selamat datang.</div>";
        }
      }
      ?>

      <div class="login-box-body">
        <p class="login-box-msg text-bold">LOGIN</p>

        <form action="periksa_login.php" method="POST">
          <div class="form-group has-feedback">
            <input type="text" class="form-control" placeholder="Username" name="username" required="required" autocomplete="off">
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback password-field">
            <input type="password" class="form-control" placeholder="Password" name="password" required="required" autocomplete="off" id="password">
            <span class="toggle-password"><i class="fa fa-eye-slash"></i></span>
          </div>
          <div class="row">
            <div class="col-xs-offset-8 col-xs-4">
              <button type="submit" class="btn btn-primary btn-block btn-flat">LOGIN</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script src="assets/bower_components/jquery/dist/jquery.min.js"></script>
  <script src="assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <script>
    document.querySelector('.toggle-password').addEventListener('click', function () {
      const passwordInput = document.getElementById('password');
      const icon = this.querySelector('i');
      
      if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
      } else {
        passwordInput.type = 'password';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
      }
    });
  </script>
</body>
</html>
