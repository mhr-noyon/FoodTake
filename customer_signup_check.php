<?php
session_start();
include "db_conn.php";

if (
	isset($_POST['uname']) && isset($_POST['password'])
	&& isset($_POST['email']) && isset($_POST['phone']) && isset($_POST['city']) && isset($_POST['address'])
) {

	function validate($data)
	{
		// $data = trim($data);
		// $data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
	$uname = validate($_POST['uname']);
	$pass = validate($_POST['password']);
	$email = validate($_POST['email']);
	$phone = validate($_POST['phone']);
	$city = validate($_POST['city']);
	$address = validate($_POST['address']);

	$user_data = 'uname=' . $uname . '&email=' . $email . '&phone=' . $phone . '&city=' . $city . '&address=' . $address;


	if (empty($uname)) {
		header("Location: customer_signup.php?error=User Name is required&$user_data");
		exit();
	} else if (empty($pass)) {
		header("Location: customer_signup.php?error=Password is required&$user_data");
		exit();
	} else if (empty($email)) {
		header("Location: customer_signup.php?error=Email is required&$user_data");
		exit();
	} else if (empty($phone)) {
		header("Location: customer_signup.php?error=Phone number is required&$user_data");
		exit();
	} else if (empty($city)) {
		header("Location: customer_signup.php?error=City is required&$user_data");
		exit();
	} else if (empty($address)) {
		header("Location: customer_signup.php?error=Address is required&$user_data");
		exit();
	} else {

		// hashing the password
		$pass = md5($pass);

		$sql = "SELECT * FROM users WHERE username='$uname' ";
		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) > 0) {
			unset($_GET['uname']);
			header("Location: customer_signup.php?error=The username is taken try another&$user_data");
			exit();
		}


		$sql = "SELECT * FROM users WHERE email='$email' ";
		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) > 0) {
			unset($_GET['email']);
			header("Location: customer_signup.php?error=The email is taken try another&$user_data");
			exit();
		}
		$sql = "SELECT * FROM users WHERE phone='$phone' ";
		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) > 0) {
			unset($_GET['phone']);
			header("Location: customer_signup.php?error=The phone number is taken try another&$user_data");
			exit();
		}

		$sql2 = "INSERT INTO users(username, password, email, phone, city, address) VALUES('$uname', '$pass', '$email','$phone','$city','$address')";

		$result2 = mysqli_query($conn, $sql2);
		if ($result2) {
			header("Location: customer_signup.php?success=Your account has been created successfully");
			exit();
		} else {
			header("Location: customer_signup.php?error=unknown error occurred&$user_data");
			exit();
		}
	}
} else {
	header("Location: customer_signup.php");
	exit();
}
