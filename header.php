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
     <!-- Option 1: Include in HTML -->
     <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
     <!-- <div class="container"> -->
     <!-- Navbar -->
     <div class="header bg-light" id="header">
          <nav class="navbar navbar-expand-lg navbar-light bg-light">
               <div class="container-fluid">
                    <a class="navbar-brand" href="#up">FoodTake</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                         <ul class="navbar-nav">
                              <li class="nav-item"><a class="nav-link active" aria-current="page" href="./home-page.php">Home</a></li>
                              <li class="nav-item"><a class="nav-link" href="#">About</a></li>
                              <li class="nav-item"><a class="nav-link" href="#">Contact</a></li>
                              <li class="nav-item" id="loginButton"><a class="nav-link" href="#">Login</a></li>
                         </ul>
                    </div>
                    <div class="input-group search-container">
                         <input type="search" id="search-text" class="form-control" placeholder="Search" />
                         <button type="button" class="btn btn-primary" onclick="searchFood()">
                              <i class="fas fa-search"></i>
                         </button>
                    </div>
               </div>
     </div>
     <div id="loginModal" class="modal-overlay">
          <div class="modal-content">
               <button type="button" class="btn" id="closeModal" onclick="">
                    <i class="fas fa-times"></i>
               </button>
               <img src="./images/login.png" class="security-image" alt="login">
               <button class="btn btn-info mb-3" onclick="goToAdminLoginPage('./customer-login.php')">Customer Login</button>
               <button class="btn btn-info mb-3" onclick="goToAdminLoginPage('./delivery-boy-login.php')">Delivery Boy Login</button>
               <button class="btn btn-info" onclick="goToAdminLoginPage('./admin-login.php')">Admin Login</button>
          </div>
     </div>
     <script src="./javascript/search-food.js"></script>
</body>

</html>