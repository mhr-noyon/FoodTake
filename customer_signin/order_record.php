<?php
session_start();
include "db_conn.php";
if ($_SESSION['count'] > 0) {
     if (isset($_POST['address']) && isset($_POST['phone'])) {
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
                         $address = $_POST['address'];
                         $phone = $_POST['phone'];
                         $pin = rand(10000, 99999);
                         $sql = "INSERT INTO orders (customer_id, food_id, quantity, total_amount,food_name,image,address,phone,pin) VALUES ('$user_id', '$food_id', '$quantity', '$total_amount','$food_name','$image','$address','$phone','$pin')";
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
          echo "
          <script>
               alert('Invalid! May be you didn't complete the form');
               window.location.href = '/FoodTake/customer_signin/place_order.php';
               </script>
               ";
     }
} else {
     echo "Cart is empty:
     <script>
          alert('Cart is empty');
          window.location.href = '/FoodTake/customer_signin/cart_page.php';
     </script>
     ";
}
// Close database connection
$conn->close();
