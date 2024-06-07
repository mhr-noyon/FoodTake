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
               <form action="customer_signup_check.php" method="POST">
                    <div class="mb-3">
                         <?php if (isset($_GET['error'])) { ?>
                              <p class="error"><?php echo $_GET['error']; ?></p>
                         <?php } ?>
                         <?php if (isset($_GET['success'])) { ?>
                              <p class="success"><?php echo $_GET['success']; ?></p>
                         <?php } ?>
                    </div>
                    <div class="mb-3">
                         <label for="uname" class="form-label">Username</label>
                         <?php if (isset($_GET['uname'])) { ?>
                              <input type="text" class="form-control" id="uname" name="uname" value="<?php echo $_GET['uname']; ?>" required>
                         <?php } else { ?>
                              <input type="text" class="form-control" id="uname" name="uname" required>
                         <?php } ?>
                    </div>
                    <div class="mb-3">
                         <label for="password" class="form-label">Password</label>
                         <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="mb-3">
                         <label for="email" class="form-label">Email</label>
                         <?php if (isset($_GET['email'])) { ?> <input type="email" class="form-control" id="email" name="email" value="<?php echo $_GET['email']; ?>" required>
                         <?php } else { ?>
                              <input type="email" class="form-control" id="email" name="email" required>
                         <?php } ?>
                    </div>
                    <div class="mb-3">
                         <label for="phone" class="form-label">Phone</label>
                         <?php if (isset($_GET['phone'])) { ?>
                              <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $_GET['phone']; ?>" required>
                         <?php } else { ?>
                              <input type="text" class="form-control" id="phone" name="phone" required>
                         <?php } ?>
                    </div>





                    <div class="mb-3">
                         <label for="city" class="form-label">City</label>
                         <?php if (isset($_GET['city'])) { ?>
                              <input type="text" class="form-control" id="city" name="city" placeholder="City" value="<?php echo $_GET['city']; ?>" required>
                         <?php } else { ?>
                              <input type="text" class="form-control" id="city" name="city" required>
                         <?php } ?>
                    </div>
                    <div class="mb-3">
                         <label for="address" class="form-label">Address</label>
                         <?php if (isset($_GET['address'])) { ?>
                              <input type="text" class="form-control" id="address" name="address" placeholder="Address" value="<?php echo $_GET['address']; ?> required">
                         <?php } else { ?>
                              <input type="text" class="form-control" id="address" name="address" required>
                         <?php } ?>
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


     <script src="./javascript/home_page.js"></script>
     <script src="./javascript/show-food.js"></script>
</body>

</html>