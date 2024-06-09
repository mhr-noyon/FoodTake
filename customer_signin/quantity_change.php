<?php
session_start();
include "db_conn.php";
$quantity = $_POST['quantity'];
$food_id = $_POST['food_id'];
if (isset($_SESSION['customer_user_id'])) {
     // echo "Quantity: " . $quantity . " Food ID: " . $food_id;
     $user_id = $_SESSION['customer_user_id'];
     $sql = "UPDATE cart SET quantity = $quantity WHERE customer_id=$user_id AND food_id=$food_id";
     // echo $sql;
     if (mysqli_query($conn, $sql)) {
          echo "Success: Record updated successfully";
     } else {
          echo "Error: " . $sql . "<br>" . mysqli_error($conn);
     }
} else {
     // header("Location: FoodTake/customer_signin/customer-login.php");
     echo "You are not LOGGED IN!";
}

$conn->close();
