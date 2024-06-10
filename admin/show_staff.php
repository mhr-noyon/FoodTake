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
               <h1 class="cart-caption">Staff details</h1>
               <table class="table table-striped">
                    <thead>
                         <tr>
                              <img src="" alt="">
                              <th scope="col">Staff ID</th>
                              <th scope="col">Name</th>
                              <th scope="col">Phone</th>
                              <th scope="col">Address</th>
                              <th scope="col">amount</th>
                         </tr>
                    </thead>
                    <tbody>

                         <?php
                         include "db_conn.php";
                         if (isset($_SESSION['admin_username'])) {
                              $sql = "SELECT  * FROM deliveryboys  ";

                              $result = mysqli_query($conn, $sql);
                              if (mysqli_num_rows($result) > 0) {
                                   $_SESSION['totalSell'] = 0;
                                   while ($row = $result->fetch_assoc()) {
                                        echo '<tr class="cartItems"">
               <td> ' . $row["delivery_boy_id"] . ' </td>
               <td>' . $row["username"] . '</td>
               <td>' . $row["phone"] . '</td>
               <td>' . $row["address"] . '</td>
               <td>' . $row["bonus_amount"] + 20 * $row["deliveries_count"] . '</td>';
                                   }
                              } else {
                         ?>
                                   <tr>
                                        <td colspan="7" style="text-align: center;">No staff info</td>
                                   </tr>
                         <?php
                              }
                         } else {
                              header("Location: ../home_page.php");
                         }

                         $conn->close();
                         ?>
                    </tbody>
                    <tfoot>
                    </tfoot>
               </table>
          </div>
     </div>
     <?php include '../footer.php'; ?>
     <script src="/FoodTake/javascript/admin.js"></script>
</body>

</html>