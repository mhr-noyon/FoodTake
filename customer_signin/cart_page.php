<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8" />
     <meta name="viewport" content="width=device-width, initial-scale=1.0" />
     <title>Home Page</title>
     <!-- Custom CSS -->
     <link rel="stylesheet" href="/FoodTake/css/landingPage.css" />
     <!-- Bootstap linking -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</head>

<body id="up">
     <?php include '../header.php'; ?>
     <!-- Main Body -->
     <div class="main">
          <!-- Card items details -->
          <div class="container">
               <div class="row">
                    <div class="col-lg-12">
                         <div class="card">
                              <div class="card-body">
                                   <h5 class="card-title">Cart</h5>
                                   <div class="card-text">
                                        <table class="table">
                                             <thead>
                                                  <tr>
                                                       <th scope="col">S.No</th>
                                                       <th scope="col">Food Name</th>
                                                       <th scope="col">Price</th>
                                                       <th scope="col">Quantity</th>
                                                       <th scope="col">Total</th>
                                                  </tr>
                                             </thead>
                                             <tbody id="cartItems">
                                                  <?php include 'cart_details.php'; ?>

                                   </div>
                                   </tbody>
                                   </table>
                                   <div class="d-flex justify-content-end">
                                        <button class="btn btn-primary" onclick="placeOrder()">Place Order</button>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </div>

     </div>
     <?php include '../footer.php'; ?>

     <script src="/FoodTake/javascript/home_page.js"></script>
</body>

</html>