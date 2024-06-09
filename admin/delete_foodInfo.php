<?php
session_start();
include "db_conn.php";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
     if (isset($_SESSION['admin_username'])) {
          global $conn;
          // Update query
          $foodID = $_POST['foodID'];

          $sql = "Delete from foods WHERE food_id = $foodID";
          if (mysqli_query($conn, $sql)) {
               echo "Record deleted successfully";
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