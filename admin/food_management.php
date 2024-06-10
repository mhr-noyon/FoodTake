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
               <h1 class="cart-caption">Add foods</h1>
               <form action="add_food.php" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                         <label for="food_name" class="form-label">Food Name</label>
                         <input type="text" class="form-control" value="" id="food_name" name="food_name" required>
                    </div>
                    <div class="mb-3">
                         <label for="price" class="form-label">Price</label>
                         <input type="number" class="form-control" value="" id="price" name="price" required>
                    </div>
                    <div class="mb-3">
                         <label for="description" class="form-label">Description</label>
                         <input type="text" class="form-control" id="description" value="" name="description" required>
                    </div>
                    <div class="mb-3">
                         <label for="image" class="form-label">Image</label>
                         <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
                    </div>
                    <div class="mb-3">
                         <button type="submit" class="btn btn-primary">Add Food</button>
                    </div>
               </form>
          </div>
          <div class="cart-box">
               <h1 class="cart-caption">Food Details</h1>
               <table class="table table-hover">
                    <thead>
                         <tr>
                              <img src="" alt="">
                              <th scope="col"></th>
                              <th scope="col">Food ID</th>
                              <th scope="col">Food Name</th>
                              <th scope="col">Description</th>
                              <th scope="col">Price</th>
                              <th scope="col">Remove</th>
                         </tr>
                    </thead>
                    <tbody>
                         <?php
                         include "db_conn.php";
                         $_SESSION['foodInfoCount'] = 0;
                         if (isset($_SESSION['admin_username'])) {
                              $sql = "SELECT * FROM foods  ";

                              $result = mysqli_query($conn, $sql);
                              if (mysqli_num_rows($result) > 0) {
                                   while ($row = $result->fetch_assoc()) {

                                        echo '<tr class="cartItems" 
                                        data-food_id="' . $row["food_id"] . '" 
                                        data-food_name="' . $row["name"] . '" 
                                        data-image="' . $row["image"] . '" 
                                        data-price="' . $row["price"] . '" 
                                        data-availabe="' . $row["available"] . '" 
                                        data-description="' . $row["description"] . '" 
                                        ">';
                                        if (strpos($row["image"], 'http') === false)
                                             echo '<td> <img src=".' . $row["image"] . '" alt="Food Image"  class="cart-food-img"> </td>';
                                        else
                                             echo '<td> <img src="' . $row["image"] . '" alt="Food Image"  class="cart-food-img"> </td>';
                                        echo '
               <td>' . $row["food_id"] . '</td>
               <td>' . $row["name"] . '</td>
               <td class="">' . $row["description"] . '</td>
               <td>' . $row["price"] . 'TK</td>';
                                        echo '</td>
               <td>
               <button class="btn btn-danger" onclick="delete_food_nfo(this)">Delete</button></td>';
                                        $_SESSION['foodInfoCount']++;
                                        echo "</tr>";
                                   }
                              } else {
                         ?>
                                   <tr>
                                        <td colspan="7" style="text-align: center;">No items in the cart</td>
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

     </div>
     <?php include '../footer.php'; ?>
     <script src="/FoodTake/javascript/admin.js"></script>
</body>

</html>