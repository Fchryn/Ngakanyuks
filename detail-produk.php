<?php 
  error_reporting(0);
  include 'db.php';
  $kontak = mysqli_query($conn, "SELECT admin_telp, admin_email, admin_address FROM tb_admin WHERE admin_id = 1");
  $data_kontak = mysqli_fetch_object($kontak);
  $produk = mysqli_query($conn, "SELECT * FROM tb_product WHERE product_id = '".$_GET['id_produk']."' ");
  $p = mysqli_fetch_object($produk);
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

  <!-- detail product -->
  <div class="section">
    <div class="container">
      <h1>Detail Produk</h1>
      <div class="box">
        <div class="column-2">
          <img src="gambar-product/<?php echo $p->product_image ?>" width="100%" height="400px">
        </div>
        <div class="column-2" class="cart">
            <h3><?php echo $p->product_name ?></h3>
            <h4>Rp. <?php echo number_format($p->product_price) ?></h4>
            <p>Deskripsi <br>
              <?php echo $p->product_describe ?>
              <p><a href="https://api.whatshapp.com/send?phone=<?php echo $data_kontak->admin_telp ?>&text=Hai, saya tertarik dengan produk anda." target="_blank">
              Hubungi via whatshapp
              </a></p>
              <button type="submit" name="add_to_cart" class="btn" onclick="tambahKeranjang()">Tambah Keranjang</button>
              <input type="hidden" name="item_name" value="<?php echo $p->product_name ?>">
              <input type="hidden" name="price" value="Rp. <?php echo number_format($p->product_price) ?>">
            </p>
        </div>
      </div>
    </div>
  </div>
  
  <script>
    var isiKeranjang = document.getElementById("cart")
        var Keranjang = isiKeranjang.value
        function tambahKeranjang() {
          Keranjang++
          isiKeranjang.innerHTML = `(${Keranjang})`
        }
  </script>

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

  <script src="js/jquery.js"></script>

  <script>
    function countCart() {
      $.ajax({
        type: "GET",
        url: "manage-cart.php",
        dataType: "JSON",
        success: function(response) {
          console.log(response);
        }
      });
    }
  </script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
</body>
</html>