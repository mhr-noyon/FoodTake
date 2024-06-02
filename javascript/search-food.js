async function fetchRandomMeals() {
  const randomMeals = new Set();

  while (randomMeals.size < 16) {
    const response = await fetch(
      "https://www.themealdb.com/api/json/v1/1/random.php"
    );
    const data = await response.json();
    randomMeals.add(data.meals[0]);
  }
  return Array.from(randomMeals);
}

function searchFood() {
  const query = document.getElementById("search-text").value.trim();
  if (!query) return alert("Please enter a food name.");

  const url = `https://www.themealdb.com/api/json/v1/1/search.php?s=${query}`;

  fetch(url)
    .then((response) => response.json())
    .then((data) => {
      const foodList = document.getElementById("foodList");
      foodList.innerHTML = "";

      let meals = data.meals || [];
      if (meals.length < 16) {
        fetchRandomMeals(16 - meals.length).then((randomMeals) => {
          meals = meals.concat(randomMeals);
          displayMeals(meals);
        });
      } else {
        displayMeals(meals);
      }
    })
    .catch((error) => {
      console.error("Error fetching data:", error);
      document.getElementById("foodList").innerHTML =
        "<p>Error fetching data. Please try again later.</p>";
    });
}

function displayMeals(meals) {
  const foodList = document.getElementById("foodList");
  foodList.innerHTML = "";

  meals.slice(0, 16).forEach((meal) => {
    const foodDiv = document.createElement("div");
    foodDiv.className = "food";

    foodDiv.innerHTML = `
             <img src="${meal.strMealThumb}" class="card-img-top"  alt="${
      meal.strMeal
    }">
             <h3 class="food-name">${meal.strMeal}</h3>
             <p class="food-desc">${meal.strInstructions.substring(
               0,
               100
             )}...</p><button class="btn btn-outline-info order-button">Order Now</button>
         `;

    foodList.appendChild(foodDiv);
  });
}
