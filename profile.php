<?php  
  session_start();
  include 'db.php';
  if($_SESSION['status_login'] != true) {
    echo '<script>window.location="login.php"</script>';
  }
  $query = mysqli_query($conn, "SELECT * FROM tb_admin WHERE admin_id = '".$_SESSION['admin_id']."' ");
  $d = mysqli_fetch_object($query);
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>NgakanYuk!!</title>
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link href="https://fonts.googleapis.com/css2?family=Antonio:wght@400;600&family=Nunito:wght@300;700&display=swap" rel="stylesheet">
</head>
<body>

  <header>

    <div class="container">
      <h1><a href="dashboard.php">NgakanYuk!!</a></h1>
      <ul>
        <li><a href="dashboard.php">Dashboard</a></li>
        <li><a href="profile.php">Profile</a></li>
        <li><a href="data-kategori.php">Data-Kategori</a></li>
        <li><a href="data-produk.php">Data Produk</a></li>
        <li><a href="logout.php">Logout</a></li>
      </ul>
    </div>

    <div class="section">
      <div class="container">
        <h3>Profile</h3>
        <div class="box">
          <form action="" method="POST">
            <input type="text" name="nama" placeholder="Nama Lengkap" class="input-control" value="<?php echo $d->admin_name?>" required>
            <input type="text" name="user" placeholder="Username" class="input-control" value="<?php echo $d->username?>" required>
            <input type="text" name="no_telp" placeholder="No Telpon/Hp" class="input-control" value="<?php echo $d->admin_telp?>" required>
            <input type="email" name="email" placeholder="Email" class="input-control" value="<?php echo $d->admin_email?>" required>
            <input type="text" name="alamat" placeholder="Alamat" class="input-control" value="<?php echo $d->admin_address?>" required>
            <input type="submit" name="submit" class="btn">
          </form>
          <?php 
            if(isset($_POST['submit'])) {
              $nama = ucwords($_POST['nama']);
              $user = ($_POST['user']);
              $no_telp = ($_POST['no_telp']);
              $email = ($_POST['email']);
              $alamat = ucwords($_POST['alamat']);

              $update = mysqli_query($conn, "UPDATE tb_admin SET
                        admin_name = '".$nama."',
                        username = '".$user."',
                        admin_telp = '".$no_telp."',
                        admin_email = '".$email."',
                        admin_address = '".$alamat."'
                        WHERE admin_id = '".$d->admin_id."' ");
              if($update) {
                echo '<script>alert("Ubah data berhasil..")</script>';
                echo '<script>window.location="profile.php"</script>';
              }
            }
          ?>
        </div>

        <h3>Ubah Password</h3>
        <div class="box">
          <form action="" method="POST">
            <input type="password" name="pass" placeholder="Password" class="input-control" required>
            <input type="password" name="confirm_pass" placeholder="Confirm Password" class="input-control" required>
            <input type="submit" name="change_pass" value="Change Password" class="btn">
          </form>
          <?php 
            if(isset($_POST['change_pass'])) {

              $pass = ($_POST['pass']);
              $confirm_pass = ($_POST['confirm_pass']);

              if($confirm_pass != $pass) {
                echo '<script>alert("Confirm password tidak sesuai..")</script>';
              }
              else {
                $change_pass = mysqli_query($conn, "UPDATE tb_admin SET
                        password = '".MD5($pass)."'
                        WHERE admin_id = '".$d->admin_id."' ");
                  if($change_pass) {
                    echo '<script>alert("Ubah data berhasil..")</script>';
                    echo '<script>window.location="profile.php"</script>';
                  }
                  else {
                    echo 'gagal'.mysqli_error($conn);
                  }
              }
            }
          ?>
        </div>
      </div>
    </div>
  </header>

  <footer>
    <div>
      <small>Copyright &copy; 2022-NgakanYuk!!.</small>
    </div>
  </footer>

</body>
</html>