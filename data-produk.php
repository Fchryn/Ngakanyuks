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
  <link href="https://fonts.googleapis.com/css2?family=Antonio:wght@200;400;600&family=Nunito:wght@700&display=swap" rel="stylesheet">
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
        <h3>Tambah Produk</h3>
        <div class="box">
          <p><a href="add-product.php" class="btn">Tambah Data</a></p>
          <table border="1" cellspacing="0" class="table">
            <thead>
              <tr>
                <th width= "60px">No.</th>
                <th>Kategori</th>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>Deskripsi</th>
                <th>Gambar</th>
                <th>Status</th>
                <th width= "200px">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php 
                $No = 1;
                $produk = mysqli_query($conn, "SELECT * FROM tb_product LEFT JOIN tb_category USING (category_id) ORDER BY product_id DESC");
                if(mysqli_num_rows($produk) > 0) {
                while ($row = mysqli_fetch_array($produk)) {
                ?>
              <tr>
                <td><?php echo $No++?></td>
                <td><?php echo $row['category_name'] ?></td>
                <td><?php echo $row['product_name'] ?></td>
                <td>Rp. <?php echo number_format($row['product_price']) ?></td>
                <td><?php echo $row['product_describe'] ?></td>
                <td><a href="gambar-product/<?php echo $row['product_image'] ?>" target="_blank"> <img src="gambar-product/<?php echo $row['product_image'] ?>" width="100px"> </a></td>
                <td><?php echo ($row['product_status'] == 0)? 'Tidak Aktif':'Aktif'; ?></td>
                <td>
                  <a href="edit-produk.php?edit_product=<?php echo $row['product_id'] ?>" class="btn"><i class="fas fa-edit"></i>Edit</a> ||
                  <a href="delete-kategori.php?delete_produk=<?php echo $row['product_id'] ?>" onclick="return confirm('Yakin anda ingin menghapus ini ?')" class="btn"><i class="fas fa-trash"></i>Delete</a>
                </td>
              </tr>
              <?php } } else { ?>
                  <tr>
                    <td colspan="8">Tidak ada data</td>
                  </tr>
                <?php } ?>

            </tbody>
          </table>
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