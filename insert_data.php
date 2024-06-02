<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "student";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
     $name = $_POST['name'];
     $email = $_POST['email'];
     $birth = $_POST['birth'];

     $sql = "INSERT INTO student_details (name, email, birth) VALUES ('$name', '$email', '$birth')";

     if ($conn->query($sql) === TRUE) {
          echo "New record created successfully";
     } else {
          echo "Error: " . $sql . "<br>" . $conn->error;
     }

     $conn->close();

     // Redirect to the main page to see the updated table
     header("Location: index.html");
     exit();
}
