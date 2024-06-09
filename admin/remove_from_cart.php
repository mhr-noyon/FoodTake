<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "foodtake";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
     echo "Connection failed!";
}
$id = $_POST['id'];

if (isset($_POST['id']) && isset($_SESSION['customer_user_id'])) {

     $food_id = $_POST['id'];
     $user_id = $_SESSION['customer_user_id'];
     $sql = "DELETE FROM cart WHERE customer_id='$user_id' AND food_id	='$food_id'";

     if (mysqli_query($conn, $sql)) {
          $_SESSION['count'] -= 1;
          echo $_SESSION['count'] . "|Record deleted successfully";
     } else {
          echo "Error deleting record: " . mysqli_error($conn);
     }
} else {
     echo "You are not LOGGED IN!";
}

// Close connection
$conn->close();
