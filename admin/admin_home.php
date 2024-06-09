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
          alert('You are logged in');
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
     <div class="main">
          <div class="login-form">
               <h3 class="text-center text-decoration-underline">Admin Panel</h3>
               <form action="admin_login_check.php" method="POST">
                    <div class="mb-3">
                         <a href="#.php" class="btn btn-primary">Orders</a>
                    </div>
                    <div class="mb-3">
                         <a href="#.php" class="btn btn-primary">Food management</a>
                    </div>
                    <div class="mb-3">

                         <a href="#.php" class="btn btn-primary">Staff</a>
                    </div>
                    <div class="mb-3">

                         <a href="/FoodTake/logout.php" class="btn btn-primary">Logout</a>
                    </div>
               </form>
          </div>
     </div>
     <?php include '../footer.php'; ?>
</body>

</html>