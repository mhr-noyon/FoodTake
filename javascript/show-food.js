// document.addEventListener("DOMContentLoaded", async function () {
//   const foodList = document.getElementById("foodList");
//   const waitingText = document.getElementById("waiting_for_food");
//   let mealCount = 16;
//   const mealPromises = [];

//   const fetchRandomMeal = () =>
//     fetch("https://www.themealdb.com/api/json/v1/1/random.php")
//       .then((response) => response.json())
//       .then((data) => data.meals[0]);

//   // Create an array of promises for 16 random meals
//   for (let i = 0; i < mealCount; i++) {
//     mealPromises.push(fetchRandomMeal());
//   }

//   // Wait for all promises to resolve
//   const meals = await Promise.all(mealPromises);

//   waitingText.style.display = "none";
//   // Process and display each meal
//   meals.forEach((meal) => {
//     // Truncate the instructions to the first 100 characters
//     const truncatedInstructions =
//       meal.strInstructions.length > 60
//         ? meal.strInstructions.substring(0, 60) + "..."
//         : meal.strInstructions;

//     // Create food element
//     const foodElement = document.createElement("div");
//     foodElement.classList.add("food");
//     let price = Math.floor(Math.random() * 1000);
//     // Create HTML content for the food element
//     const foodHTML = `
//           <div class="food-image">
//                 <img src="${meal.strMealThumb}" class="card-img-top" alt="${meal.strMeal}" />
//           </div>
//           <div class="food-content">
//               <h2 class="food-title">${meal.strMeal}</h2>
//               <p class="food-description">${meal.strInstructions}
//                  <a href="#">See more</a>
//               </p>
//               <div class="food-footer">
//                 <span>Price: ${price}TK</span>
//                 <button class="food-button btn btn-outline-info order-button">Add To Cart</button>
//               </div>
//           </div>
//       `;

//     // Set HTML content for the food element
//     foodElement.innerHTML = foodHTML;

//     // Append food element to the food list
//     foodList.appendChild(foodElement);

//     // Add event listener to the "Order Now" button
//     const orderButton = foodElement.querySelector(".order-button");
//     orderButton.addEventListener("click", () => {
//       alert(`You clicked on: ${meal.strMeal}`);
//       console.log("Meal clicked:", meal);

//       // Send meal data to the server
//       fetch("./customer_signin/add_to_cart.php", {
//         method: "POST",
//         headers: {
//           "Content-Type": "application/json",
//         },
//         body: JSON.stringify({
//           id: meal.idMeal,
//           name: meal.strMeal,
//           price: price,
//           description: meal.strInstructions,
//           image: meal.strMealThumb,
//         }),
//       })
//         .then((response) => response.json())
//         .then((data) => {
//           console.log("Success:", data);
//         })
//         .catch((error) => {
//           console.error("Error:", error);
//         });
//     });
//   });
// });
