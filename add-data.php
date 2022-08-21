<?php  
  session_start();
  include 'db.php';
  if($_SESSION['status_login'] != true) {
    echo '<script>window.location="login.php"</script>';
  }
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
        <h3>Tambah Data Kategori</h3>
        <div class="box">
          <form action="" method="POST">
            <input type="text" name="nama" placeholder="Nama Kategori" class="input-control" required>
            <input type="submit" name="add" class="btn">
          </form>
          <?php  
            if(isset($_POST['add'])) {
              $nama = ucwords($_POST['nama']);

              $insert = mysqli_query($conn, "INSERT INTO tb_category VALUES (null, '".$nama."')");

              if($insert) {
                echo '<script>alert("Berhasil di tambah..")</script>';
                echo '<script>window.location="data-kategori.php"</script>';
              }
              else {
                echo 'Gagal..' .mysqli_error($conn);
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