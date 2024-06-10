function add_delivery_boy(btn) {
  console.log("Button clicked");
  var parentDiv = $(btn).closest(".cartItems");
  var orderID = parentDiv.data("order_id");
  var deliveryBoyID = parentDiv.find(".deliveryBoy").val();
  console.log(orderID, deliveryBoyID);
  $.ajax({
    url: "/FoodTake/admin/update_deliveryBoy.php",
    method: "POST",
    data: {
      orderID: orderID,
      deliveryBoyID: deliveryBoyID,
    },
    success: function (response) {
      console.log(response);
      if (response.includes("successfully")) {
        window.location.href = "/FoodTake/admin/order_management.php";
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
