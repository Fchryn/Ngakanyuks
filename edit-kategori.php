<?php  
  session_start();
  include 'db.php';
  if($_SESSION['status_login'] != true) {
    echo '<script>window.location="login.php"</script>';
  }
  $kategori = mysqli_query($conn, "SELECT * FROM tb_category WHERE category_id = '".$_GET['edit']."' ");
  $k = mysqli_fetch_object($kategori);
  if(mysqli_num_rows($kategori) == 0) {
    echo '<script>window.location="data-kategori.php"</script>';
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
        <h3>Edit Data Kategori</h3>
        <div class="box">
          <form action="" method="POST">
            <input type="text" name="nama" placeholder="Nama Kategori" class="input-control" value="<?php echo $k-> category_name ?>" required>
            <input type="submit" name="add" class="btn">
          </form>
          <?php  
            if(isset($_POST['add'])) {
              $nama = ucwords($_POST['nama']);

              $update = mysqli_query($conn, "UPDATE tb_category SET category_name = '".$nama."' WHERE category_id = '".$k->category_id."' ");

              if($update) {
                echo '<script>alert("Edit selesai..")</script>';
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