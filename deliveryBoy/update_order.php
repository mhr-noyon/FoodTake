<?php
session_start();
include "db_conn.php";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
     if (isset($_SESSION['staff_username'])) {
          global $conn;
          // Update query
          $order_id = $_POST['orderID'];
          $pinCode = $_POST['pinCode'];
          $curDate = date('Y-m-d H:i:s');
          echo $order_id, $delivery;
          $sql = "SELECT * FROM orders WHERE order_id = $order_id AND pin = $pinCode";
          $result = mysqli_query($conn, $sql);
          if (mysqli_num_rows($result) === 0) {
               echo "Record not found";
               exit();
          } else {
               $sql = "UPDATE orders SET status = 'delivered',
               delivery_date='$curDate' WHERE order_id = $order_id AND pin = $pinCode";
               if (mysqli_query($conn, $sql)) {
                    echo "Record updated successfully";
               } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
               }
          }
     } else {
          echo "";
          echo "<script>
            alert('You are not LOGGED IN!');
               </script>";
     }
}
