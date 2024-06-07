//  From database to the front end
// const cardData = [
//   { name: "Food 1", content: "Content for Food 1", no: 1 },
//   { name: "Food 2", content: "Content for Food 2", no: 2 },
//   { name: "Food 3", content: "Content for Food 3", no: 3 },
//   { name: "Food 4", content: "Content for Food 4", no: 4 },
//   { name: "Food 5", content: "Content for Food 5", no: 5 },
// ];

// // Get the grid container
// const gridContainer = document.getElementById("gridContainer");

// // Loop through the card data and generate HTML for each card
// for (let i = 0; i < cardData.length; i++) {
//   const card = cardData[i];

//   // Create card element
//   const cardElement = document.createElement("div");
//   cardElement.classList.add("food");

//   // Create card content
//   const cardContent = `
//           <img src="https://source.unsplash.com/200x200/?food" alt="food" />
//           <h3 class="food-name">${card.name}</h3>
//           <p class="food-desc">${card.content}</p>
//           <button class="btn  btn-outline-info btn-${card.no}">Order Now</button>
//      `;

//   // Set card content
//   cardElement.innerHTML = cardContent;

//   // Append card to grid container
//   gridContainer.appendChild(cardElement);
// }
// console.log("done");

document.addEventListener("DOMContentLoaded", async function () {
  const foodList = document.getElementById("foodList");
  const waitingText = document.getElementById("waiting_for_food");
  let mealCount = 16;
  const mealPromises = [];

  // Function to fetch a random meal
  const fetchRandomMeal = () =>
    fetch("https://www.themealdb.com/api/json/v1/1/random.php")
      .then((response) => response.json())
      .then((data) => data.meals[0]);

  // Create an array of promises for 16 random meals
  for (let i = 0; i < mealCount; i++) {
    mealPromises.push(fetchRandomMeal());
  }

  // Wait for all promises to resolve
  const meals = await Promise.all(mealPromises);

  // Process and display each meal
  waitingText.style.display = "none";
  meals.forEach((meal) => {
    // Truncate the instructions to the first 100 characters
    const truncatedInstructions =
      meal.strInstructions.length > 100
        ? meal.strInstructions.substring(0, 100) + "..."
        : meal.strInstructions;

    // Create food element
    const foodElement = document.createElement("div");
    foodElement.classList.add("food");

    // Create HTML content for the food element
    const foodHTML = `
          <img src="${meal.strMealThumb}" class="card-img-top" alt="${meal.strMeal}" />
              <h5 class="food-name">${meal.strMeal}</h5>
              <p class="food-desc">${meal.strInstructions}</p>
              <button class="btn btn-outline-info order-button">Order Now</button>
      `;

    // Set HTML content for the food element
    foodElement.innerHTML = foodHTML;

    // Append food element to the food list
    foodList.appendChild(foodElement);

    // Add event listener to the "Order Now" button
    const orderButton = foodElement.querySelector(".order-button");
    orderButton.addEventListener("click", () => {
      alert(`You clicked on: ${meal.strMeal}`);
      console.log("Meal clicked:", meal);
    });
  });
});
