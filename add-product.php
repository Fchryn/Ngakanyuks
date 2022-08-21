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
        <h3>Tambah Data Produk</h3>
        <div class="box">
          <form action="" method="POST" enctype="multipart/form-data">
            <select name="kategori" class="input-control" required>
              <option value="">-->Pilih<--</option>
              <?php 
                $kategori = mysqli_query($conn, "SELECT * FROM tb_category ORDER BY category_id DESC");
                while($fill = mysqli_fetch_array($kategori)) {
              ?>
              <option value="<?php echo $fill['category_id'] ?>"><?php echo $fill['category_name'] ?></option>
              <?php } ?>
            </select>
            <input type="text" name="nama" class="input-control" placeholder="Nama Produk" required>
            <input type="text" name="harga" class="input-control" placeholder="Harga" required>
            <input type="file" name="gambar" class="input-control" required>
            <textarea name="deskripsi" class="input-control" placeholder="Deskripsi"></textarea> <br>
            <select name="status" class="input-control">
              <option value="">-->Pilih<--</option>
              <option value="1">Aktif</option>
              <option value="0">Tidak Aktif</option>
            </select>
            <input type="submit" name="add" class="btn">
          </form>
          <?php  
            if(isset($_POST['add'])) {
              //print_r($_FILES['gambar']);
              //menampung inputan dari form
                $kategori = $_POST['kategori'];
                $nama = $_POST['nama'];
                $harga = $_POST['harga'];
                $deskripsi = $_POST['deskripsi'];
                $status = $_POST['status'];
              //menampung file yang diupload 
                $filename = $_FILES['gambar']['name'];
                $tmp_name = $_FILES['gambar']['tmp_name'];

                $type1 = explode('.', $filename);
                $type2 = $type1[1];

                $type_file = 'gambar-product'.time().'.'.$type2;
              //menampung data format file yang diizinkan 
                $tipe_file = array('jpg', 'jpeg', 'png', 'gif', 'svg');
              //validasi format size
                if(!in_array($type2, $tipe_file)) {
                  //jika format file tidak diizinkan
                  echo '<script>alert("Format file tidak diizinkan..")</script>';
                }
                else {
                  //jika format file diizinkan
                  //proses upload file sekaligus insert ke db
                  move_uploaded_file($tmp_name, './gambar-product/' .$type_file);

                  $insert = mysqli_query($conn, "INSERT INTO tb_product VALUES ( 
                    null,
                    '".$kategori."',
                    '".$nama."',
                    '".$harga."',
                    '".$deskripsi."',
                    '".$type_file."',
                    '".$status."',
                    null
                    ) ");
                  
                  if($insert) {
                    echo '<script>alert("Simpan data berhasil..")</script>';
                    echo '<script>window.location="data-produk.php"</script>';
                  }
                  else {
                    echo 'Gagal..' .mysqli_error($conn);
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

  <script>
      CKEDITOR.replace( 'deskripsi' );
  </script>

</body>
</html>