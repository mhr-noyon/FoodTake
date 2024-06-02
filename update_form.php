<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "student";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT id, name, email, birth FROM student_details WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $name = $row['name'];
        $email = $row['email'];
        $birth = $row['birth'];
    } else {
        echo "Record not found";
        exit();
    }
} else {
    echo "Invalid request";
    exit();
}
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Student Details</title>
</head>
<body>
    <h2>Update Student Details</h2>
    <form action="update_data.php" method="post">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        Name: <input type="text" name="name" value="<?php echo $name; ?>" required><br>
        Email: <input type="email" name="email" value="<?php echo $email; ?>" required><br>
        Birth Date: <input type="date" name="birth" value="<?php echo $birth; ?>" required><br>
        <input type="submit" value="Update">
    </form>
</body>
</html>
