<?php
session_start();

if (isset($_SESSION['customer_username'])) {

?>
     <!DOCTYPE html>
     <html>

     <head>
          <meta charset="UTF-8" />
          <meta name="viewport" content="width=device-width, initial-scale=1.0" />
          <title>Logged</title>
          <!-- Custom CSS -->
          <link rel="stylesheet" href="./css/landingPage.css" />
          <!-- Bootstap linking -->
          <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
          <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

     </head>

     <body>

          <?php include 'header.php'; ?>
          <div class="main">
               <h1>Hello, <?php echo $_SESSION['customer_username']; ?></h1>
               <a href="/FoodTake/customer_signin/customer_logout.php">Logout</a>
          </div>



          <?php include 'footer.php'; ?>
          <script src="./javascript/home_page.js"></script>
          <script src="./javascript/show-food.js"></script>
          <script src="./javascript/search-food.js"></script>
     </body>

     </html>

<?php
} else {
     header("Location: /FoodTake/customer_signin/customer-login.php");
     exit();
}
?>