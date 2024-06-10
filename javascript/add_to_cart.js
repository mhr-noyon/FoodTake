function add_to_cart(btn) {
  console.log("Button clicked");
  var parentDiv = $(btn).closest(".food");
  var id = parentDiv.data("id");
  var name = parentDiv.data("name");
  var price = parentDiv.data("price");
  var image = parentDiv.data("image");
  var description = parentDiv.data("description");
  //   console.log(id, name, price, image, description);
  $.ajax({
    url: "/FoodTake/customer_signin/add_to_cart.php",
    method: "POST",
    data: {
      id: id,
      name: name,
      price: price,
      image: image,
      description: description,
    },
    success: function (response) {
      console.log(response);
      if (response.includes("You are not LOGGED IN")) {
        alert("Please Sign in first to add items to cart");
      } else if (response.includes("stored successfully")) {
        alert(` ${name} -> Added to cart successfully`);
      } else if (response.includes("already exists")) {
        alert(` ${name} Already in cart`);
      } else {
        alert("Something went wrong");
      }

      console.log(response);
    },
    error: function (xhr, status, error) {
      alert(responseText);
      console.error(xhr.responseText);
    },
  });
}

function placeOrder() {
  quantityChanged();
  // window.location.href = "/FoodTake/customer_signin/place_order.php";
  // console.log("Order placed");
}
// total price calculation
function quantityChanged() {
  // console.log("Quantity changed");
  const quantityInputs = document.querySelectorAll(".quantity");
  // console.log(quantityInputs.length);
  // alert(quantityInputs.length);
  if (quantityInputs.length == 0) {
    return;
  } else
    quantityInputs.forEach((input) => {
      var parentDiv = input.closest(".cartItems");
      var id = parentDiv.dataset.id;
      var quantity = input.value;

      console.log(id, quantity);
      $.ajax({
        url: "/FoodTake/customer_signin/quantity_change.php",
        method: "POST",
        data: {
          food_id: id,
          quantity: quantity,
        },
        success: function (response) {
          console.log(response);
          if (response.includes("Record updated successfully")) {
            // console.log("Record updated successfully");
          } else {
            // alert("Something went wrong");
          }
        },
        error: function (xhr, status, error) {
          alert("Something went wrong");
        },
      });
    });
}
function updateCart() {
  const totalPriceElement = document.getElementById("total-price");

  console.log("Cart updated");

  let total = 0;
  document.querySelectorAll(".cartItems").forEach((item) => {
    const price = parseFloat(item.querySelector(".item-price").innerHTML);
    const quantity = parseInt(item.querySelector(".quantity").value);
    console.log(quantity, price);
    const itemTotal = price * quantity;
    item.querySelector(".item-total-price").textContent = `${itemTotal} TK`;

    total += itemTotal;
  });

  totalPriceElement.textContent = `${total} TK`;
}
// Total price calculation
document.addEventListener("DOMContentLoaded", function () {
  const quantityInputs = document.querySelectorAll(".quantity");

  quantityInputs.forEach((input) => {
    input.addEventListener("change", updateCart);
  });
});

function removeFood(btn) {
  console.log("clicked");
  var parentDiv = $(btn).closest(".cartItems");
  var id = parentDiv.data("id");
  $.ajax({
    url: "./remove_from_cart.php",
    method: "POST",
    data: {
      id: id,
    },
    success: function (response) {
      // if (response.includes("successfully")) {
      //   // console.log("Record updated successfully");
      //   let parts = response.split("|");

      //   // Assign the parts to separate variables
      //   let a = parseInt(parts[0]); // Convert the first part to an integer
      //   let b = parts[1];
      //   let close_div = document.getElementById("close_div");
      //   if (a <= 0) {
      //     console.log("zero\n");
      //     console.log(close_div.style.display);
      //     close_div.style.display = "none !important";
      //     console.log(close_div.style.display);
      //   } else if (a > 0) {
      //     console.log("ekhono: ", a, b);
      //     close_div.style.display = "block";
      //   }
      // }
      console.log(response);
      parentDiv.remove();
      updateCart();
    },
    error: function (xhr, status, error) {
      console.error(xhr.responseText);
    },
  });
}
function cancelFood(btn) {
  console.log("Button clicked");
  if (!confirm("Are you sure you want to cancel this order?")) {
    return;
  }
  var parentDiv = $(btn).closest(".cartItems");
  var foodID = parentDiv.data("id");
  var orderID = parentDiv.data("order_id");
  $.ajax({
    url: "/FoodTake/customer_signin/cancel_order.php",
    method: "POST",
    data: {
      foodID: foodID,
      orderID: orderID,
    },
    success: function (response) {
      console.log(response);
      if (response.includes("successfully")) {
        parentDiv.remove();
      } else {
        alert("Something went wrong");
      }
    },
    error: function (xhr, status, error) {
      alert(responseText);
      console.error(xhr.responseText);
    },
  });
}
