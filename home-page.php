<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8" />
     <meta name="viewport" content="width=device-width, initial-scale=1.0" />
     <title>Home Page</title>
     <!-- Custom CSS -->
     <link rel="stylesheet" href="./css/landingPage.css" />
     <!-- Bootstap linking -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</head>

<body id="up">
     <?php include 'header.php'; ?>
     <!-- <div class="container text-center">
          <button id="loginButton" class="btn btn-primary mt-5">Login</button>
     </div> -->

     <!-- Main Body -->
     <div class="main">
          <div class="blank-image">
          </div>
          <div class="blank-text">
               <div class="row">
                    <div class="col-lg-4">
                         <div class="food-text mx-auto mb-5 mb-lg-0 mb-lg-3">
                              <h3>Food</h3>
                              <p class="lead mb-0">We offer a variety of food items to choose from. You can select your favourite food from our menu.</p>
                         </div>
                    </div>
                    <div class="col-lg-4">
                         <div class="food-text mx-auto mb-5 mb-lg-0 mb-lg-3">
                              <h3>Delivery</h3>
                              <p class="lead mb-0">We deliver your food to your doorstep. You can track your order and know the status of your delivery.</p>
                         </div>
                    </div>
                    <div class="col-lg-4">
                         <div class="food-text mx-auto mb-0 mb-lg-3">
                              <h3>Payment</h3>
                              <p class="lead mb-0">You can pay for your order online. We accept all major credit and debit cards.</p>
                         </div>
                    </div>
               </div>
          </div>
          <div class="food-container">
               <div class="food-list" id="foodList">
               </div>
          </div>
     </div>

     <?php include 'footer.php'; ?>


     <script src="./javascript/home-page.js"></script>
     <script src="./javascript/show-food.js"></script>
     <script src="./javascript/search-food.js"></script>
</body>

</html>