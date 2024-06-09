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
$name = $_POST['name'];
$price = $_POST['price'];
$image = $_POST['image'];
$description = $_POST['description'];

if (isset($_POST['id']) && isset($_POST['name']) && isset($_POST['price']) && isset($_POST['image']) && isset($_POST['description']) && isset($_SESSION['customer_user_id'])) {
     $food_id = $_POST['id'];
     $user_id = $_SESSION['customer_user_id'];

     $sql = "SELECT * FROM cart WHERE customer_id='$user_id' AND food_id	='$food_id'";
     $result = mysqli_query($conn, $sql);
     if (mysqli_num_rows($result) === 0) {
          $sql2 = "INSERT INTO cart (customer_id, food_id, name, image, description, price) VALUES ('$user_id', '$food_id', '$name', '$image', '$description', '$price')";
          $result2 = mysqli_query($conn, $sql2);
          if ($result2) {
               echo "Data stored successfully!";
          } else {
               echo "Error: " . $sql2 . "<br>" . mysqli_error($conn);
          }
     } else {
          echo "Data already exists!";
     }
} else {
     echo "Error: You are not LOGGED IN!<br>";
}
// Close connection
$conn->close();
