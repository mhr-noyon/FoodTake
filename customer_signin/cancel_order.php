<?php
session_start();
include "db_conn.php";

if (isset($_POST['foodID']) && isset($_SESSION['customer_user_id'])) {

     $food_id = $_POST['foodID'];
     $order_id = $_POST['orderID'];
     $sql = "DELETE FROM orders WHERE order_id='$order_id'";

     if (mysqli_query($conn, $sql)) {
          echo "Record deleted successfully";
     } else {
          echo "Error deleting record: " . mysqli_error($conn);
     }
} else {
     echo "You are not LOGGED IN!";
}

// Close connection
$conn->close();
