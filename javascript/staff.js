function orderCompleted(btn) {
  console.log("Button clicked");
  var parentDiv = $(btn).closest(".cartItems");
  var orderID = parentDiv.data("order_id");
  var pinCode = parseInt(parentDiv.find(".pinCode").val());
  console.log(orderID, pinCode);
  $.ajax({
    url: "/FoodTake/deliveryBoy/update_order.php",
    method: "POST",
    data: {
      orderID: orderID,
      pinCode: pinCode,
    },
    success: function (response) {
      console.log(response);
      if (response.includes("successfully")) {
        window.location.href = "/FoodTake/deliveryBoy/order_management.php";
      } else {
        alert("Something went wrong! Maybe the pin code is incorrect.");
      }
    },
    error: function (xhr, status, error) {
      alert(responseText);
      console.error(xhr.responseText);
    },
  });
}

function delete_food_nfo(btn) {
  console.log("Button clicked");
  if (!confirm("Are you sure you want to delete this food item?")) {
    return;
  }
  var parentDiv = $(btn).closest(".cartItems");
  var foodID = parentDiv.data("food_id");
  $.ajax({
    url: "/FoodTake/admin/delete_foodInfo.php",
    method: "POST",
    data: {
      foodID: foodID,
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
