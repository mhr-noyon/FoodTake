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
                    <h1 class="cart-caption">Cart Details</h1>
                    <table class="table">
                         <thead>
                              <tr>
                                   <img src="" alt="">
                                   <th scope="col"></th>
                                   <th scope="col">Food Name</th>
                                   <th scope="col">Price</th>
                                   <th scope="col">Quantity</th>
                                   <th scope="col">Total</th>
                                   <th scope="col">Action</th>
                              </tr>
                         </thead>
                         <tbody>
                              <tr class="cartItems" style="display: none;">
                                   <td></td>
                                   <td></td>
                                   <td id='item-price' class='item-price'>0</td>
                                   <span class="item-id" id="item-id" style="display:none"></span>
                                   <td>
                                        <div data-mdb-input-init class="form-outline quantity-div" style="width: 22rem;"><input type="number" min="1" value="1" id="quantity" class="form-control quantity" />0</div>
                                   </td>
                                   <td><span class="item-total-price" id="item-total-price">0</span></td>'.
                                   '<td><button class="btn btn-danger" onclick="removeFood(this)"></button></td>
                              </tr>
                              <?php include 'cart_details.php';
                              ?>
                         </tbody>
                         <tfoot>
                              <?php
                              if ($_SESSION['count'] > 0) { ?>

                                   <tr style="font-weight:bold;">
                                        <td colspan="4" style="text-align: right;">Total</td>
                                        <td id="total-price"><?php echo $totalPrice; ?> TK</td>
                                        <td></td>
                                   </tr>
                              <?php } ?>
                         </tfoot>
                    </table>
                    <div class="d-flex justify-content-end">
                         <button class="btn btn-primary" onclick="placeOrder()">Place Order</button>
                    </div>
               </div>

          </div>
     </div>

     </div>
     <?php include '../footer.php'; ?>

     <script src="/FoodTake/javascript/home_page.js"></script>
     <script src="/FoodTake/javascript/add_to_cart.js"></script>
</body>

</html>