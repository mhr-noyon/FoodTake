<?php
session_start();
echo $_SESSION['customer_user_id'];
if (!isset($_SESSION['customer_user_id'])) {
     header('location:./customer-login.php');
} else if ($_SESSION['count'] == 0) {
     echo "Cart is empty:
     <script>
          alert('Cart is empty');
          window.location.href = '/FoodTake/customer_signin/cart_page.php';
     </script>
     ";
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

     <link rel="stylesheet" href="../css/order-page.css" />

     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

     <!-- Bootstap linking -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


</head>

<body>
     <?php include '../header.php'; ?>
     <!-- <div class="container text-center">
          <button id="loginButton" class="btn btn-primary mt-5">Login</button>
     </div> -->
     <!-- Main Body -->

     <!-- <div class="main bg-image"> -->
     <div class="main bg-image">
          <!-- Bill details -->
          <div class="container ">
               <div class="row bill-container   cart-box">
                    <div class="col-lg-6">
                         <form action="/FoodTake/customer_signin/order_record.php" method="post">
                              <div class="bill-details">
                                   <h3>Bill Details</h3>
                                   <div class="mb-3">
                                        <label for="uname" class="form-label">Username</label>
                                        <input type="text" class="form-control" id="username" name="uname" value="<?php echo $_SESSION['customer_username']; ?>" required disabled>
                                   </div>
                                   <div class="mb-3">
                                        <label for="address" class="form-label">Address</label>
                                        <input type="text" class="form-control" id="address" name="address" required>
                                   </div>
                                   <div class="mb-3">
                                        <label for="phone" class="form-label">Phone</label>
                                        <input type="text" class="form-control" id="phone" name="phone" required>
                                   </div>
                                   <div class="mb-3">
                                        <label for="total" class="form-label">Total</label>
                                        <input type="text" class="form-control" id="total-price" name="total" required value="
                                   <?php
                                   include "db_conn.php";
                                   $user_id = $_SESSION['customer_user_id'];
                                   $sql = "SELECT SUM(price*quantity) total_price FROM cart WHERE customer_id='$user_id'";
                                   $result = mysqli_query($conn, $sql);
                                   // echo $result;
                                   if (mysqli_num_rows($result) > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                             $totalPrice = $row["total_price"];
                                        }
                                   }
                                   echo $totalPrice;
                                   $conn->close();
                                   ?>
                                   " disabled>
                                   </div>
                                   <div class="mb-3">
                                        <label for="payment" class="form-label">Payment Method</label>
                                        <select class="form-select" id="payment" name="payment" required>
                                             <option value="cash">Cash</option>
                                             <option value="card">Bkash</option>
                                        </select>
                                   </div>
                              </div>
                              <button type="submit" class="btn btn-primary">Confirm Order</button>
                         </form>
                    </div>

                    <div class="col-lg-6">
                         <img src="/FoodTake/images/eating.png" id="eating" alt="">
                    </div>
               </div>
          </div>
     </div>

     <?php include '../footer.php'; ?>


     <script src="../javascript/home_page.js"></script>
     <script src="../javascript/show-food.js"></script>
     <script src="../javascript/add_to_cart.js"></script>
     <script src="../javascript/order_food.js"></script>
     <script src="/FoodTake/javascript/show_own_api_food.js"></script>
</body>

</html>