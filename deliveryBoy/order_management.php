<?php
session_start();
if (!isset($_SESSION['staff_username'])) {
     echo "
     <script>
          alert('You are not logged in');
          window.location.href = 'deliveryBoy-login.php';
          </script>
          ";
     header("Location: deliveryBoy-login.php");
} else
     echo "
     <script>
          </script>
          ";
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
     <?php include 'deliveryBoy_header.php'; ?>
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
                              <th scope="col">SL.</th>
                              <th scope="col">Customer Name</th>
                              <th scope="col">Phone</th>
                              <th scope="col">Address</th>
                              <th scope="col">Food Name</th>
                              <th scope="col">Total_Amount</th>
                              <th scope="col">Order Time</th>
                              <th scope="col">Progress</th>
                              <th scope="col">isComplete</th>
                         </tr>
                    </thead>
                    <tbody>
                         <?php
                         include "db_conn.php";
                         $_SESSION['prgressOrderCount'] = 1;
                         if (isset($_SESSION['staff_username'])) {
                              $staff_id = $_SESSION['staff_userID'];
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
                                   ) AS order_date FROM orders WHERE status = 'assigned'
                                    AND delivery_boy= $staff_id";

                              $result = mysqli_query($conn, $sql);
                              if (mysqli_num_rows($result) > 0) {
                                   while ($row = $result->fetch_assoc()) {
                                        $sql = "SELECT username FROM customers WHERE customer_id = " . $row['customer_id'];
                                        $result2 = mysqli_query($conn, $sql);
                                        $row2 = $result2->fetch_assoc();
                                        echo '<tr class="cartItems" 
                                        data-customerId="' . $row["customer_id"] . '" 
                                        data-order_id="' . $row["order_id"] . '" 
                                        data-phone="' . $row["phone"] . '" 
                                        data-address="' . $row["address"] . '" 
                                        data-id="' . $row["food_id"] . '" data-name="' . $row["food_name"] . '" data-status="' . $row["status"] . '">
               <td> ' . $_SESSION['prgressOrderCount'] . ' </td>
               <td>' . $row2["username"] . '</td>
               <td>' . $row["phone"] . '</td>
               <td>' . $row["address"] . '</td>
               <td>' . $row["food_name"] . '</td>
               <td><span class="item-total-price" id="item-total-price">' . $row["total_amount"] . '</span></td> 
               <td>' . $row["order_date"] . '</td>' . '
               <td>' . $row["status"];
                                        echo '</td>
               <td>
               <input type="number" class="form-control pinCode" name="delivery_boy" placeholder="Enter Pin">
               <button class="btn btn-success" onclick="orderCompleted(this)">Completed</button></td>';
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
                              header("Location: deliveryBoy-login.php");
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
                              <th scope="col">SL.</th>
                              <th scope="col">Customer Name</th>
                              <th scope="col">Phone</th>
                              <th scope="col">Address</th>
                              <th scope="col">Total_Amount</th>
                              <th scope="col">Order Time</th>
                              <th scope="col">Delivered Time</th>
                              <th scope="col">Progress</th>
                         </tr>
                    </thead>
                    <tbody>
                         <?php
                         include "db_conn.php";
                         $_SESSION['completedOrderCount'] = 1;
                         if (isset($_SESSION['staff_username'])) {
                              $staff_id = $_SESSION['staff_userID'];
                              $sql = "SELECT delivery_date,customer_id, phone,address, food_id, food_name,quantity,total_amount, delivery_boy ,status,  CONCAT(
                                        DAY(order_date),
                                        CASE
                                             WHEN DAY(order_date) IN (1, 21, 31) THEN 'st'
                                             WHEN DAY(order_date) IN (2, 22) THEN 'nd'
                                             WHEN DAY(order_date) IN (3, 23) THEN 'rd'
                                             ELSE 'th'
                                        END,
                                        ' ',
                                        DATE_FORMAT(order_date, '%M,%Y, %H:%i:%s')
                                   ) AS order_date FROM orders WHERE status='delivered' and delivery_boy=$staff_id";

                              $result = mysqli_query($conn, $sql);
                              if (mysqli_num_rows($result) > 0) {
                                   $_SESSION['totalSell'] = 0;
                                   $_SESSION['countDelivery']=0;
                                   while ($row = $result->fetch_assoc()) {
                                        $_SESSION['countDelivery']++;
                                        $sql = "SELECT username FROM customers WHERE customer_id = " . $row['customer_id'];
                                        $result2 = mysqli_query($conn, $sql);
                                        $row2 = $result2->fetch_assoc();
                                        echo '<tr class="cartItems" 
                                        data-customerId="' . $row["customer_id"] . '" 
                                        data-phone="' . $row["phone"] . '" 
                                        data-address="' . $row["address"] . '" 
                                        data-id="' . $row["food_id"] . '" data-name="' . $row["food_name"] . '" data-status="' . $row["status"] . '">
                <td> ' . $_SESSION['completedOrderCount'] . ' </td>
               <td>' . $row2["username"] . '</td>
               <td>' . $row["phone"] . '</td>
               <td>' . $row["address"] . '</td>
               <td><span class="item-total-price" id="item-total-price">' . $row["total_amount"] . '</span></td> 
               <td>' . $row["order_date"] . '</td>' . '
               <td>' . $row["delivery_date"] . '</td>
               <td><img src="../images/tikMark.png" width="50px"></td>';

                                        echo "</tr>";
                                        $_SESSION['completedOrderCount']++;
                                   }
                              } else {
                         ?>
                                   <tr>
                                        <td colspan="7" style="text-align: center;">No items in the cart</td>
                                   </tr>
                         <?php
                              }
                         } else {
                              header("Location: deliveryBoy-login.php");
                         }

                         $conn->close();
                         ?>
                    </tbody>
                    <tfoot>
                         <div class="total-sell">
                              <h3>Total delivery: <?php echo $_SESSION['countDelivery']; ?></h3>
                              <h3>Total Earn: <?php echo $_SESSION['countDelivery']*20; ?> TK</h3>
                         </div>
                    </tfoot>
               </table>
          </div>
     </div>
     <?php include '../footer.php'; ?>
     <script src="/FoodTake/javascript/staff.js"></script>
</body>

</html>