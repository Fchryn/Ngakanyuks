<?php  
  include 'db.php';

  if(isset($_GET['delete'])) {
    $delete = mysqli_query($conn, "DELETE FROM tb_category WHERE category_id = '".$_GET['delete']."' ");
    echo '<script>window.location="data-kategori.php"</script>';
  }

  if(isset($_GET['delete_produk'])) {
    $product = mysqli_query($conn, "SELECT product_image FROM tb_product WHERE product_id = '".$_GET['delete_produk']."' ");
    $product_fill = mysqli_fetch_object($product);

    unlink('./gambar-product/'.$product_fill->product_image);

    $delete = mysqli_query($conn, "DELETE FROM tb_product WHERE product_id = '".$_GET['delete_produk']."' ");
    echo '<script>window.location="data-produk.php"</script>';
  }  
?>