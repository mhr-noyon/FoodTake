<?php
session_start();
include "db_conn.php";
if (isset($_SESSION['admin_username'])) {
     global $conn;
     $foodName = $_POST['food_name'];
     $foodPrice = $_POST['price'];
     $foodDescription = $_POST['description'];


     $target_dir = "../images/";
     $target_file = $target_dir . basename($_FILES["image"]["name"]);
     $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

     // Check if file is an actual image
     $check = getimagesize($_FILES["image"]["tmp_name"]);
     if ($check === false) {
          die("File is not an image.");
     }

     // Check file size (limit to 5MB)
     if ($_FILES["image"]["size"] > 5000000) {
          die("Sorry, your file is too large.");
     }

     // Allow certain file formats
     if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
          die("Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
     }

     //Check if file is not already exists
     if (!file_exists($target_file)) {
          // Try to move uploaded file to the target directory
          if (!move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
               die("Sorry, there was an error uploading your file.");
          } else {
               echo "The file " . htmlspecialchars(basename($_FILES["image"]["name"])) . " has been uploaded.";
          }
     } else {
          echo "Sorry, file already exists.";
     }



     echo $foodName, "<br> ", $foodPrice, "<br> ", $foodDescription, "<br> ", substr($target_file, 1), "<br> ";
     $target_file = substr($target_file, 1);
     echo $target_file;
     $sql = "INSERT INTO foods (name, price, description, image) VALUES ('$foodName', $foodPrice, '$foodDescription', '$target_file')";
     if (mysqli_query($conn, $sql)) {
          echo "Record added successfully";
          echo "<script>
          alert('Record added successfully');
          </script>";

          header("Location: food_management.php");
     } else {
          echo "<script>

          alert('Error: ' . $sql . '<br>' . mysqli_error($conn));
          </script>";
          echo "Error: " . $sql . "<br>" . mysqli_error($conn);
     }
} else {
     echo "";
     echo "<script>
       alert('You are not LOGGED IN!');
          </script>";
     header("Location: customer-login.php");
}

$conn->close();
