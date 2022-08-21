<?php 
  error_reporting(0);
  include 'db.php';
  $kontak = mysqli_query($conn, "SELECT admin_telp, admin_email, admin_address FROM tb_admin WHERE admin_id = 1");
  $data_kontak = mysqli_fetch_object($kontak);
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>NgakanYuk!!</title>
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link href="https://fonts.googleapis.com/css2?family=Antonio:wght@200;400;600&family=Nunito:wght@700&display=swap" rel="stylesheet">
</head>
<body>

  <header>

    <div class="container">
      <h1><a href="index.php">NgakanYuk!!</a></h1>
      <ul>
        <li><a href="produk.php">Produk</a></li>
        <li><a href="keranjang.php">Keranjang<button id="cart">(0)</button></a></li>
      </ul>
    </div>

  </header>

  <!--Search-->
  <div class="search">
    <div class="container">
      <form action="produk.php">
        <input type="text" name="search" placeholder="Cari Produk" value="<?php echo $_GET['search'] ?>">
        <input type="hidden" name="kategori_id" value="<?php echo $_GET['kategori_id'] ?>">
        <input type="submit" name="cari" value="Cari Produk">
      </form>
    </div>
  </div>
  

  <footer>
    <div>
      <div class="container">
        <h4>Alamat</h4>
        <p><?php echo $data_kontak->admin_address ?></p>

        <h4>Email</h4>
        <p><?php echo $data_kontak->admin_email ?></p>

        <h4>No. Handphone</h4>
        <p><?php echo $data_kontak->admin_telp ?></p>
      </div>
      <small>Copyright &copy; 2022-NgakanYuk!!.</small>
    </div>
  </footer>

</body>
</html>