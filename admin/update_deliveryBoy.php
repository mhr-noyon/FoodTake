<?php
session_start();
include "db_conn.php";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
     if (isset($_SESSION['admin_username'])) {
          global $conn;
          // Update query
          $order_id = $_POST['orderID'];
          $delivery = $_POST['deliveryBoyID'];
          echo $order_id, $delivery;

          $sql = "UPDATE orders SET status = 'assigned',
    delivery_boy = $delivery WHERE order_id = $order_id";
          if (mysqli_query($conn, $sql)) {
               echo "Record updated successfully";
          } else {
               echo "Error: " . $sql . "<br>" . mysqli_error($conn);
          }
     } else {
          echo "";
          echo "<script>
            alert('You are not LOGGED IN!');
               </script>";
     }
}
?>