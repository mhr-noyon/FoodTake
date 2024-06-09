<?php
session_start();
if (!isset($_SESSION['admin_username'])) {
     echo "
     <script>
          alert('You are not logged in');
          window.location.href = 'admin_login.php';
          </script>
          ";
     echo  $_SESSION['admin_username'];
     header("Location: admin_login.php");
} else
     echo "
     <script>
          </script>
          ";
echo  $_SESSION['admin_username'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Panel</title>
     <link rel="stylesheet" href="../css/landingPage.css" />font awesome cdn link

     <link rel="stylesheet" href="../css/order-page.css" />
     <link rel="stylesheet" href="../css/admin-login.css">

     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

     <!-- Bootstap linking -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
     <?php include 'admin_header.php'; ?>
     <!-- Main Body -->
     <div class="main container">

          <div class="cart-box">
               <h1 class="cart-caption">Orders Details</h1>
          </div>
          <div class="cart-box">
               <h1 class="cart-caption">Progress Orders</h1>
               <table class="table table-striped table-hover">
                    <thead>
                         <tr>
                              <img src="" alt="">
                              <th scope="col">Customer ID</th>
                              <th scope="col">Customer Name</th>
                              <th scope="col">Phone</th>
                              <th scope="col">Address</th>
                              <th scope="col">Food Name</th>
                              <th scope="col">Quantity</th>
                              <th scope="col">Total_Amount</th>
                              <th scope="col">Order Time</th>
                              <th scope="col">Progress</th>
                              <th scope="col">DeliveryMan_ID</th>
                         </tr>
                    </thead>
                    <tbody>
                         <!-- <tr class="cartItems" style="display: none;">
                                   <td></td>
                                   <td></td>
                                   <td id='item-price' class='item-price'>0</td>
                                   <span class="item-id" id="item-id" style="display:none"></span>
                                   <td>
                                        <div data-mdb-input-init class="form-outline quantity-div" style="width: 22rem;"><input type="number" min="1" value="1" id="quantity" class="form-control quantity" />0</div>
                                   </td>
                                   <td><span class="item-total-price" id="item-total-price">0</span></td>'.
                                   '<td><button class="btn btn-danger" onclick="removeFood(this)"></button></td>
                              </tr> -->
                         <?php
                         include "db_conn.php";
                         $_SESSION['prgressOrderCount'] = 0;
                         if (isset($_SESSION['admin_username'])) {
                              $sql = "SELECT order_id,delivery_boy, customer_id, phone,address, food_id, food_name,quantity,total_amount,status,  CONCAT(
                                        DAY(order_date),
                                        CASE
                                             WHEN DAY(order_date) IN (1, 21, 31) THEN 'st'
                                             WHEN DAY(order_date) IN (2, 22) THEN 'nd'
                                             WHEN DAY(order_date) IN (3, 23) THEN 'rd'
                                             ELSE 'th'
                                        END,
                                        ' ',
                                        DATE_FORMAT(order_date, '%M,%Y, %H:%i:%s')
                                   ) AS order_date FROM orders WHERE status != 'delivered'";

                              $result = mysqli_query($conn, $sql);
                              if (mysqli_num_rows($result) > 0) {
                                   while ($row = $result->fetch_assoc()) {

                                        echo '<tr class="cartItems" 
                                        data-customerId="' . $row["customer_id"] . '" 
                                        data-order_id="' . $row["order_id"] . '" 
                                        data-phone="' . $row["phone"] . '" 
                                        data-address="' . $row["address"] . '" 
                                        data-id="' . $row["food_id"] . '" data-name="' . $row["food_name"] . '" data-status="' . $row["status"] . '">
               <td> ' . $row["customer_id"] . ' </td>
               <td>' . '$row["customer_name"]' . '</td>
               <td>' . $row["phone"] . '</td>
               <td>' . $row["address"] . '</td>
               <td>' . $row["food_name"] . '</td>
               <td>' . $row["quantity"] . '</td>
               <td><span class="item-total-price" id="item-total-price">' . $row["total_amount"] . '</span></td> 
               <td>' . $row["order_date"] . '</td>' . '
               <td>' . $row["status"];
                                        if ($row["status"] == 'pending') {
                                             echo '</td>
               <td>
               <input type="number" class="form-control deliveryBoy" name="delivery_boy" placeholder="Not assigned">
               <button class="btn btn-success" onclick="add_delivery_boy(this)">Assign</button></td>';
                                        } else if ($row["status"] == 'assigned') {

                                             echo '<td>' . $row["delivery_boy"] . '</td>';
                                        } else {
                                             echo '<td>----</td>';
                                        }
                                        $_SESSION['prgressOrderCount']++;
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
                    <tfoot>
                    </tfoot>
               </table>
          </div>
          <div class="cart-box">
               <h1 class="cart-caption">Completed Orders</h1>
               <table class="table table-striped">
                    <thead>
                         <tr>
                              <img src="" alt="">
                              <th scope="col">Customer ID</th>
                              <th scope="col">Customer Name</th>
                              <th scope="col">Phone</th>
                              <th scope="col">Address</th>
                              <th scope="col">Food Name</th>
                              <th scope="col">Quantity</th>
                              <th scope="col">Total_Amount</th>
                              <th scope="col">Order Time</th>
                              <th scope="col">Progress</th>
                              <th scope="col">Delivery_Man</th>
                         </tr>
                    </thead>
                    <tbody>
                         <!-- <tr class="cartItems" style="display: none;">
                                   <td></td>
                                   <td></td>
                                   <td id='item-price' class='item-price'>0</td>
                                   <span class="item-id" id="item-id" style="display:none"></span>
                                   <td>
                                        <div data-mdb-input-init class="form-outline quantity-div" style="width: 22rem;"><input type="number" min="1" value="1" id="quantity" class="form-control quantity" />0</div>
                                   </td>
                                   <td><span class="item-total-price" id="item-total-price">0</span></td>'.
                                   '<td><button class="btn btn-danger" onclick="removeFood(this)"></button></td>
                              </tr> -->
                         <?php
                         include "db_conn.php";
                         $_SESSION['completedOrderCount'] = 0;
                         if (isset($_SESSION['admin_username'])) {
                              $sql = "SELECT customer_id, phone,address, food_id, food_name,quantity,total_amount,status,  CONCAT(
                                        DAY(order_date),
                                        CASE
                                             WHEN DAY(order_date) IN (1, 21, 31) THEN 'st'
                                             WHEN DAY(order_date) IN (2, 22) THEN 'nd'
                                             WHEN DAY(order_date) IN (3, 23) THEN 'rd'
                                             ELSE 'th'
                                        END,
                                        ' ',
                                        DATE_FORMAT(order_date, '%M,%Y, %H:%i:%s')
                                   ) AS order_date FROM orders WHERE status='delivered'";

                              $result = mysqli_query($conn, $sql);
                              if (mysqli_num_rows($result) > 0) {
                                   $_SESSION['totalSell'] = 0;
                                   while ($row = $result->fetch_assoc()) {

                                        echo '<tr class="cartItems" 
                                        data-customerId="' . $row["customer_id"] . '" 
                                        data-phone="' . $row["phone"] . '" 
                                        data-address="' . $row["address"] . '" 
                                        data-id="' . $row["food_id"] . '" data-name="' . $row["food_name"] . '" data-status="' . $row["status"] . '">
               <td> ' . $row["customer_id"] . ' </td>
               <td>' . '$row["customer_name"]' . '</td>
               <td>' . $row["phone"] . '</td>
               <td>' . $row["address"] . '</td>
               <td>' . $row["food_name"] . '</td>
               <td>' . $row["quantity"] . '</td>
               <td><span class="item-total-price" id="item-total-price">' . $row["total_amount"] . '</span></td> 
               <td>' . $row["order_date"] . '</td>' . '
               <td>' . $row["status"] . '</td>
               <td>' . $row["delivery_boy"] . '</td>';

                                        echo "</tr>";
                                        $_SESSION['totalSell'] += $row["total_amount"];
                                        $_SESSION['completedOrderCount']++;
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
                    <tfoot>
                         <?php
                         if ($_SESSION['completedOrderCount'] > 0) { ?>

                              <tr style="font-weight:bold;">
                                   <td colspan="4" style="text-align: right;">Total</td>
                                   <td id="total-price"><?php echo $_SESSION['totalSell'] ?> TK</td>
                                   <td></td>
                              </tr>
                         <?php } ?>
                    </tfoot>
               </table>
          </div>
     </div>
     <?php include '../footer.php'; ?>
     <script src="/FoodTake/javascript/admin.js"></script>
</body>

</html>