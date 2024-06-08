<?php
session_start();
include "db_conn.php";

if (isset($_POST['uname']) && isset($_POST['password'])) {

	function validate($data)
	{
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

	$uname = validate($_POST['uname']);
	$pass = validate($_POST['password']);

	if (empty($uname)) {
		header("Location: /FoodTake/home_page.php?error=User Name is required");
		exit();
	} else if (empty($pass)) {
		header("Location: /FoodTake/home_page.php?error=Password is required");
		exit();
	} else {
		// hashing the password
		$pass = md5($pass);


		$sql = "SELECT * FROM Customers WHERE username='$uname' AND password='$pass'";

		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) === 1) {
			$row = mysqli_fetch_assoc($result);
			if ($row['username'] === $uname && $row['password'] === $pass) {
				$_SESSION['customer_username'] = $row['username'];
				$_SESSION['customer_email'] = $row['email'];
				$_SESSION['customer_phone'] = $row['phone'];
				$_SESSION['customer_user_id'] =  $row['customer_id'];
				header("Location: /FoodTake/home_page.php");
				exit();
			} else {
				header("Location: customer-login.php?error=Incorect User name or password");
				exit();
			}
		} else {
			header("Location: customer-login.php?error=Incorrect User name or password");
			exit();
		}
	}
} else {
	header("Location: customer-login.php");
	exit();
}

// Close connection
$conn->close();