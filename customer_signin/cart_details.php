<?php
include "db_conn.php";
$_SESSION['count'] = 0;
if (isset($_SESSION['customer_username'])) {
     $user_id = $_SESSION['customer_user_id'];
     $uname = $_SESSION['customer_username'];
     $sql = "SELECT * FROM cart WHERE customer_id='$user_id'";

     $result = mysqli_query($conn, $sql);
     //      <tr>
     //      <th scope="col">Food Name</th>
     //      <th scope="col">Price</th>
     //      <th scope="col">Quantity</th>
     //      <th scope="col">Total</th>
     // </tr>
     if (mysqli_num_rows($result) > 0) {
          $_SESSION['totalPrice'] = 0;
          while ($row = $result->fetch_assoc()) {
               echo '<tr class="cartItems" data-id="' . $row["food_id"] . '" data-name="' . $row["name"] . '" data-image="' . $row["image"] . '"data-quantity="'. $row["quantity"].'data-price="' . $row["price"] . '">
               <td> <img src="' . $row["image"] . '" alt="Food Image"  class="cart-food-img"> </td><td>' . $row["name"] . "</td>
               <td id='item-price' class='item-price'>" . $row["price"] . '</td>
               <span class="item-id" id="item-id" style="display:none">' . $row["food_id"] . '</span> 
               <td>
                    <div data-mdb-input-init class="form-outline quantity-div" style="width: 22rem;"><input type="number" min="1"  id="quantity" value="' . $row["quantity"] . '" class="form-control quantity" />' . '</div></td>
               <td><span class="item-total-price" id="item-total-price">' . $row["price"] . '</span></td>' .
                    '<td><button class="btn btn-danger" onclick="removeFood(this)">Remove</button></td>';

               echo "</tr>";
               $_SESSION['count']++;
               $_SESSION['totalPrice'] += $row["price"];
          }
     } else {
?>
          <tr>
               <td colspan="6" style="text-align: center;">No items in the cart</td>
          </tr>
<?php
     }
} else {
     header("Location: customer-login.php");
}

$conn->close();
