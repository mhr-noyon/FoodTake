<?php 
session_start();

if (isset($_SESSION['customer_username'])) {

 ?>
<!DOCTYPE html>
<html>
<head>
	<title>HOME</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
     <h1>Hello, <?php echo $_SESSION['customer_username']; ?></h1>
     <a href="customer_logout.php">Logout</a>
</body>
</html>

<?php 
}else{
     header("Location: customer-login.php");
     exit();
}
 ?>