<?php
session_start();
include "db_conn.php";
if ($_SESSION['count'] > 0) {
     if ($_SERVER["REQUEST_METHOD"] == "POST") {
          if (isset($_SESSION['customer_user_id'])) {
               // Retrieve form data and sanitize inputs (to prevent SQL injection)
               $user_id = $_SESSION['customer_user_id'];
               $sql = "SELECT * FROM cart WHERE customer_id='$user_id'";
               $result = mysqli_query($conn, $sql);
               if (mysqli_num_rows($result) > 0) {
                    while ($row = $result->fetch_assoc()) {
                         $food_id = $row["food_id"];
                         $quantity = $row["quantity"];
                         $food_name = $row["name"];
                         $image = $row["image"];
                         $total_amount = $row["price"] * $quantity;
                         $sql = "INSERT INTO orders (customer_id, food_id, quantity, total_amount,food_name,image) VALUES ('$user_id', '$food_id', '$quantity', '$total_amount','$food_name','$image')";
                         if (mysqli_query($conn, $sql)) {
                              echo "
                         <script>
                              alert('Order placed successfully');
                              window.location.href = '/FoodTake/customer_signin/orders_show.php';
                              </script>
                              ";
                         } else {
                              echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                         }
                    }
               } else {
                    echo "Cart data is not set or empty";
               }
          } else {
               echo "You are not logged in";
          }
     } else {
          echo "Invalid request method";
     }
} else {
     echo "Cart is empty:'
     <script>
          alert('Cart is empty');
          window.location.href = '/FoodTake/customer_signin/cart_page.php';
     </script>
     ";
}
// Close database connection
$conn->close();