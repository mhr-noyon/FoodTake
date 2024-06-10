<?php
session_start();
echo $_SESSION['customer_user_id'];
if (!isset($_SESSION['customer_user_id'])) {
     header('location:./customer-login.php');
} else
?>
<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8" />
     <meta name="viewport" content="width=device-width, initial-scale=1.0" />
     <title>Home Page</title>
     <!-- Custom CSS -->
     <link rel="stylesheet" href="../css/landingPage.css" />font awesome cdn link


     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

     <!-- Bootstap linking -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</head>

<body id="up">
     <?php include '../header.php'; ?>
     <!-- Main Body -->
     <div class="main">
          <div class="container">
               <!-- Card items details -->
               <div class="cart-box">
                    <h1 class="cart-caption">Pending Orders</h1>
                    <table class="table table-hover">
                         <thead>
                              <tr>
                                   <img src="" alt="">
                                   <th scope="col"></th>
                                   <th scope="col">Food Name</th>
                                   <th scope="col">Quantity</th>
                                   <th scope="col">Total_Amount</th>
                                   <th scope="col">Order Time</th>
                                   <th scope="col">Pin codes</th>
                                   <th scope="col">Progress</th>
                                   <th scope="col">Action</th>
                              </tr>
                         </thead>
                         <tbody>
                              <?php
                              include "db_conn.php";
                              $_SESSION['count'] = 0;
                              if (isset($_SESSION['customer_username'])) {
                                   $user_id = $_SESSION['customer_user_id'];
                                   $uname = $_SESSION['customer_username'];
                                   $sql = "SELECT order_id, pin,food_id, food_name,quantity,total_amount, image,status,  CONCAT(
                                        DAY(order_date),
                                        CASE
                                             WHEN DAY(order_date) IN (1, 21, 31) THEN 'st'
                                             WHEN DAY(order_date) IN (2, 22) THEN 'nd'
                                             WHEN DAY(order_date) IN (3, 23) THEN 'rd'
                                             ELSE 'th'
                                        END,
                                        ' ',
                                        DATE_FORMAT(order_date, '%M,%Y, %H:%i:%s')
                                   ) AS order_date FROM orders WHERE customer_id='$user_id' AND  status!='delivered' ORDER BY order_date DESC";

                                   $result = mysqli_query($conn, $sql);
                                   if (mysqli_num_rows($result) > 0) {
                                        $_SESSION['totalPrice'] = 0;
                                        while ($row = $result->fetch_assoc()) {
                                             echo '<tr class="cartItems" 
                                             data-order_id = "' . $row["order_id"] . '"
                                             data-id="' . $row["food_id"] . '" data-name="' . $row["food_name"] . '" data-image="' . $row["image"] . '" data-status="' . $row["status"] . '">
               <td> <img src="' . $row["image"] . '" alt="Food Image"  class="cart-food-img"> </td><td>' . $row["food_name"] . '</td>
               <span class="item-id" id="item-id" style="display:none">' . $row["food_id"] . '</span> 
               <td>
                    ' . $row["quantity"] . '</td>
               <td><span class="item-total-price" id="item-total-price">' . $row["total_amount"] . '</span></td> <td>' . $row["order_date"] . '</td>' . '<td>' . $row["pin"] . '</td>' .
                                                  '<td>' . $row["status"] . '</td>' .
                                                  '<td>';

                                             if ($row["status"] == 'pending')    echo '<button class="btn btn-danger" onclick="cancelFood(this)">Cancel</button></td>';
                                             else echo '<button class="btn btn-danger"  disabled style="color:black;"">Cancel</button></td>';

                                             echo "</tr>";
                                        }
                                   } else {
                              ?>
                                        <tr>
                                             <td colspan="8" style="text-align: center;">No items in the cart</td>
                                        </tr>
                              <?php
                                   }
                              } else {
                                   header("Location: customer-login.php");
                              }

                              $conn->close();
                              ?>
                         </tbody>
                         <tfoot>
                              <?php
                              if ($_SESSION['count'] > 0) { ?>

                                   <tr style="font-weight:bold;">
                                        <td colspan="4" style="text-align: right;">Total</td>
                                        <td id="total-price"><?php echo $_SESSION['totalPrice'] ?> TK</td>
                                        <td></td>
                                   </tr>
                              <?php } ?>
                         </tfoot>
                    </table>
               </div>
               <div class="cart-box">
                    <h1 class="cart-caption">Orders History</h1>
                    <table class="table table-hover">
                         <thead>
                              <tr>
                                   <img src="" alt="">
                                   <th scope="col"></th>
                                   <th scope="col">Food Name</th>
                                   <th scope="col">Quantity</th>
                                   <th scope="col">Total_Amount</th>
                                   <th scope="col">Order Time</th>
                                   <th scope="col">Delivery Time</th>
                                   <th scope="col">Progress</th>
                              </tr>
                         </thead>
                         <tbody>
                              <?php
                              include "db_conn.php"; 
                              if (isset($_SESSION['customer_username'])) {
                                   $user_id = $_SESSION['customer_user_id'];
                                   $uname = $_SESSION['customer_username'];
                                   $sql = "SELECT pin,food_id, food_name,quantity,total_amount, image,status,  CONCAT(
                                        DAY(order_date),
                                        CASE
                                             WHEN DAY(order_date) IN (1, 21, 31) THEN 'st'
                                             WHEN DAY(order_date) IN (2, 22) THEN 'nd'
                                             WHEN DAY(order_date) IN (3, 23) THEN 'rd'
                                             ELSE 'th'
                                        END,
                                        ' ',
                                        DATE_FORMAT(order_date, '%M,%Y, %H:%i:%s')
                                   ) AS order_date,CONCAT(
                                        DAY(delivery_date),
                                        CASE
                                             WHEN DAY(delivery_date) IN (1, 21, 31) THEN 'st'
                                             WHEN DAY(delivery_date) IN (2, 22) THEN 'nd'
                                             WHEN DAY(delivery_date) IN (3, 23) THEN 'rd'
                                             ELSE 'th'
                                        END,
                                        ' ',
                                        DATE_FORMAT(delivery_date, '%M,%Y, %H:%i:%s')
                                   ) AS delivery_date FROM orders WHERE customer_id='$user_id' and status='delivered' ORDER BY order_date DESC";

                                   $result = mysqli_query($conn, $sql);
                                   if (mysqli_num_rows($result) > 0) {
                                        $_SESSION['totalPrice'] = 0;
                                        $_SESSION['countOrder'] = 0;
                                        while ($row = $result->fetch_assoc()) {
                                             // $_SESSION['totalPrice']+=
                                             $_SESSION['countOrder']++;
                                             echo '<tr class="cartItems" data-id="' . $row["food_id"] . '" data-name="' . $row["food_name"] . '" data-image="' . $row["image"] . '" data-status="' . $row["status"] . '">
               <td> <img src="' . $row["image"] . '" alt="Food Image"  class="cart-food-img"> </td><td>' . $row["food_name"] . '</td>
               <span class="item-id" id="item-id" style="display:none">' . $row["food_id"] . '</span> 
               <td>
                    ' . $row["quantity"] . '</td>
               <td><span class="item-total-price" id="item-total-price">' . $row["total_amount"] . '</span></td> <td>' . $row["order_date"] . '</td>' .
                                                  '<td>' . $row["order_date"] . '</td>' .
                                                  '<td><img src="../images/tikMark.png" width="50px"></td>';

                                             echo "</tr>";
                                        }
                                   } else {
                              ?>
                                        <tr>
                                             <td colspan="6" style="text-align: center;">No items in the cart</td>
                                        </tr>
                              <?php
                                   }
                              } else {
                                   header("Location: customer-login.php");
                              }

                              $conn->close();
                              ?>
                         </tbody>
                         <!-- <img src="../images/tikMark.png" alt=""> -->
                         <tfoot>
                              <?php
                              if ($_SESSION['countOrder'] > 0) { ?>

                                   <tr style="font-weight:bold;">
                                        <td colspan="3" style="text-align: right;">Total</td>
                                        <td id="total-price"><?php echo $_SESSION['totalPrice'] ?> TK</td>
                                        <td></td>
                                   </tr>
                                   
                              <?php } ?>
                              
                              <h3>Order done: <?php echo $_SESSION['countOrder']; ?></h3>
                              <h3>Discount: <?php echo $_SESSION['totalPrice']/20; ?> %</h3>
                         </tfoot>
                    </table>
               </div>
          </div>
     </div>

     </div>
     <?php include '../footer.php'; ?>

     <script src="/FoodTake/javascript/home_page.js"></script>
     <script src="/FoodTake/javascript/add_to_cart.js"></script>
</body>

</html>