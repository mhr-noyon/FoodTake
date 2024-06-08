<?php
include "db_conn.php";

if (isset($_SESSION['customer_username'])) {
     $user_id = $_SESSION['customer_user_id'];
     $uname = $_SESSION['customer_username'];
     echo "<h1>Welcome $uname</h1>";
     $sql = "SELECT * FROM cart WHERE customer_id='$user_id'";

     $result = mysqli_query($conn, $sql);
     //      <tr>
     //      <th scope="col">Food Name</th>
     //      <th scope="col">Price</th>
     //      <th scope="col">Quantity</th>
     //      <th scope="col">Total</th>
     // </tr>
     if (mysqli_num_rows($result) > 0) {
          $count = 1;
          while ($row = $result->fetch_assoc()) {
               echo "<tr><td>" . $count . "</td><td>" . $row["name"] . "</td><td>" . $row["price"] . "</td><td>" . `<div data-mdb-input-init class="form-outline" style="width: 22rem; z-index: 1;"><input min="1" type="number" value='1' id="typeNumber" class="form-control" /><label class="form-label" for="typeNumber">Number input</label>
</div>` . "</td> <td>" . `<span id="total">0</span>` . "</td>";
               $count++;
          }
     } else {
?>
          <tr>
               <td colspan="5" style="text-align: center;">No items in the cart</td>
          </tr>
<?php
     }
} else {
     header("Location: customer-login.php");
}

$conn->close();
