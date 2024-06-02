<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8" />
     <meta name="viewport" content="width=device-width, initial-scale=1.0" />
     <title>Customer-Signup</title>
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
          <div class="login-form ">
               <h3 class="text-center text-decoration-underline">Customer Sign-Up</h3>
               <form action="customer-signup.php" method="POST">
                    <div class="mb-3">
                         <label for="username" class="form-label">Username</label>
                         <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="mb-3">
                         <label for="password" class="form-label">Password</label>
                         <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="mb-3">
                         <label for="email" class="form-label">Email</label>
                         <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                         <label for="phone" class="form-label">Phone</label>
                         <input type="text" class="form-control" id="phone" name="phone" required>
                    </div>
                    <div class="mb-3">
                         <label for="city" class="form-label">City</label>
                         <input type="text" class="form-control" id="city" name="city" required>
                    </div>
                    <div class="mb-3">
                         <label for="address" class="form-label">Address</label>
                         <input type="text" class="form-control" id="address" name="address" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Sign-Up</button>
                    <div class="go-signup">
                         <p>Already have an account?</p>
                         <a href="customer-login.php">Log-In</a>
                    </div>
          </div>
     </div>

     <div class="food-container">
          <div class="food-list" id="foodList">
          </div>
     </div>

     <?php include 'footer.php'; ?>


     <script src="./javascript/home-page.js"></script>
     <script src="./javascript/show-food.js"></script>
</body>

</html>