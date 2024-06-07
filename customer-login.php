<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8" />
     <meta name="viewport" content="width=device-width, initial-scale=1.0" />
     <title>Customer-login</title>
     <!-- Custom CSS -->
     <link rel="stylesheet" href="./css/landingPage.css" />
     <link rel="stylesheet" href="./css/customer-login.css" />
     <!-- Bootstap linking -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</head>

<body>
     <?php include 'header.php'; ?>
     <!-- <div class="container text-center">
          <button id="loginButton" class="btn btn-primary mt-5">Login</button>
     </div> -->
     <!-- Main Body -->
     <div class="main bg-image">
          <div class="login-form">
               <h3 class="text-center text-decoration-underline">Customer Login</h3>
               <form action="customer_login_check.php" method="POST">
                    <div class="mb-3">
                         <label for="uname" class="form-label">Username</label>
                         <input type="text" class="form-control" id="username" name="uname" required>
                    </div>
                    <div class="mb-3">
                         <label for="password" class="form-label">Password</label>
                         <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Login</button>
                    <div class="go-signup">
                         <p>Don't have an account?</p>
                         <a href="customer_signup.php">Sign-Up</a>
                    </div>
               </form>
          </div>
     </div>

     <div class="food-container">
          <div class="food-list" id="foodList">
          </div>
     </div>

     <?php include 'footer.php'; ?>


     <script src="./javascript/home_page.js"></script>
     <script src="./javascript/show-food.js"></script>
</body>

</html>