<?php 
  include 'db.php';

  $request = $_SERVER['REQUEST_METHOD'];

  switch($request) {
    case 'GET': 
      $query = mysqli_query($conn, "SELECT * FROM tb_cart")->num_rows;
      echo json_encode($query);
      break;

    default:
    break;
  }
?>