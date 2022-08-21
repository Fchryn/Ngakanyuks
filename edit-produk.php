<?php  
  session_start();
  include 'db.php';
  if($_SESSION['status_login'] != true) {
    echo '<script>window.location="login.php"</script>';
  }
  $produk = mysqli_query($conn, "SELECT * FROM tb_product WHERE product_id = '".$_GET['edit_product']."' ");
  if(mysqli_num_rows($produk) == 0) {
    echo '<script>window.location="data-produk.php"</script>';
  }
  $product_fill = mysqli_fetch_object($produk); 
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>NgakanYuk!!</title>
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link href="https://fonts.googleapis.com/css2?family=Antonio:wght@400;600&family=Nunito:wght@300;700&display=swap" rel="stylesheet">
  <script src="https://cdn.ckeditor.com/4.19.1/standard/ckeditor.js"></script>
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
        <h3>Edit Data Produk</h3>
        <div class="box">
          <form action="" method="POST" enctype="multipart/form-data">
            <select name="kategori" class="input-control" required>
              <option value="">-->Pilih<--</option>
              <?php 
                $kategori = mysqli_query($conn, "SELECT * FROM tb_category ORDER BY category_id DESC");
                while($fill = mysqli_fetch_array($kategori)) {
              ?>
              <option value="<?php echo $fill['category_id'] ?>" <?php echo ($fill['category_id'] == $product_fill->category_id)? 'selected':''; ?>><?php echo $fill['category_name'] ?></option>
              <?php } ?>
            </select>
            <input type="text" name="nama" class="input-control" placeholder="Nama Produk" value="<?php echo $product_fill->product_name ?>" required>
            <input type="text" name="harga" class="input-control" placeholder="Harga" value="<?php echo $product_fill->product_price ?>" required>

            <img src="gambar-product/<?php echo $product_fill->product_image ?>" width="150px">
            <input type="hidden" name="foto" value="<?php echo $product_fill->product_image ?>">
            <input type="file" name="gambar" class="input-control">
            <textarea name="deskripsi" class="input-control" placeholder="Deskripsi"><?php echo $product_fill->product_describe ?></textarea> <br>
            <select name="status" class="input-control">
              <option value="">-->Pilih<--</option>
              <option value="1" <?php echo ($product_fill->product_status == 1)? 'selected':''; ?>>Aktif</option>
              <option value="0" <?php echo ($product_fill->product_status == 0)? 'selected':''; ?>>Tidak Aktif</option>
            </select>
            <input type="submit" name="add" class="btn">
          </form>
          <?php  
            if(isset($_POST['add'])) {
              //data inputan dari form
              $kategori = $_POST['kategori'];
              $nama = $_POST['nama'];
              $harga = $_POST['harga'];
              $deskripsi = $_POST['deskripsi'];
              $status = $_POST['status'];
              $foto = $_POST['foto'];

              //data gambar yang baru
              $filename = $_FILES['gambar']['name'];
              $tmp_name = $_FILES['gambar']['tmp_name'];

              $type1 = explode('.', $filename);
              $type2 = $type1[1];

              $type_file = 'gambar-product'.time().'.'.$type2;

              //menampung data format file yang diizinkan 
              $tipe_file = array('jpg', 'jpeg', 'png', 'gif', 'svg');

              //jika admin ganti gambar
              if($filename != '') {

                if(!in_array($type2, $tipe_file)) {
                  //jika format file tidak diizinkan
                  echo '<script>alert("Format file tidak diizinkan..")</script>';
                }
                else {
                  unlink('./gambar-product'.$foto);
                  move_uploaded_file($tmp_name, './gambar-product/' .$type_file);
                  $nama_gambar = $type_file;
                }
              }
              else {
                //jika admin tidak ganti gambar
                $nama_gambar = $foto;
              }
              //query update data produk
              $update = mysqli_query($conn, "UPDATE tb_product SET 
                                    category_id = '".$kategori."',
                                    product_name = '".$nama."',
                                    product_price = '".$harga."',
                                    product_describe = '".$deskripsi."',
                                    product_image = '".$nama_gambar."', 
                                    product_status = '".$status."'
                                    WHERE product_id = '".$product_fill->product_id."' ");
              
              if($update) {
                echo '<script>alert("Ubah data berhasil..")</script>';
                echo '<script>window.location="data-produk.php"</script>';
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

  <script>
      CKEDITOR.replace( 'deskripsi' );
  </script>

</body>
</html>