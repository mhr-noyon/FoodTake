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
    url: "./customer_signin/add_to_cart.php",
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
    },
    error: function (xhr, status, error) {
      console.error(xhr.responseText);
    },
  });
}
// total price calculation
function updateCart() {
  const totalPriceElement = document.getElementById("total-price");
  let total = 0;
  console.log("Cart updated");

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
// document.addEventListener("DOMContentLoaded", function () {
//   console.log("DOM loaded");
//   const quantityInputs = document.querySelectorAll(".quantity");
//   // console.log(quantityInputs);
//   const totalPriceElement = document.getElementById("total-price");

//   quantityInputs.forEach((input) => {
//     input.addEventListener("change", updateCart);
//   });

//   function updateCart() {
//     let total = 0;
//     console.log("Cart updated");

//     document.querySelectorAll(".cartItems").forEach((item) => {
//       console.log(item);
//       const price = parseFloat(item.querySelector(".item-price").innerHTML);
//       const quantity = parseInt(item.querySelector(".quantity").value);
//       console.log(quantity,price);
//       const itemTotal = price * quantity;
//       item.querySelector(".item-total-price").textContent = `${itemTotal} TK`;

//       total += itemTotal;
//     });
//     console.log(total);
//     totalPriceElement.textContent = `${total} TK`;
//   }
// });

function removeFood(btn) {
  console.log("clicked");
  var parentDiv = $(btn).closest(".cartItems");
  var id = parentDiv.data("id");
  var name = parentDiv.data("name");
  var price = parentDiv.data("price");
  var image = parentDiv.data("image");
  // console.log(id, name, price, image);
  $.ajax({
    url: "./remove_from_cart.php",
    method: "POST",
    data: {
      id: id,
    },
    success: function (response) {
      console.log(response);
      parentDiv.remove();
      updateCart();
    },
    error: function (xhr, status, error) {
      console.error(xhr.responseText);
    },
  });
}
