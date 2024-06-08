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
