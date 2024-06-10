// async function fetchRandomMeals() {
//   const randomMeals = new Set();

//   while (randomMeals.size < 16) {
//     const response = await fetch(
//       "https://www.themealdb.com/api/json/v1/1/random.php"
//     );
//     const data = await response.json();
//     randomMeals.add(data.meals[0]);
//   }
//   return Array.from(randomMeals);
// }

function searchFood() {
  let path = window.location.pathname;
  if(path != "/FoodTake/home_page.php"){
    alert("Please go to the home page to search for food");
    return;
  }
  window.location.href = "#foodList";
  const waitingText = document.getElementById("waiting_for_food");
  waitingText.style.display = "block";
  const query = document.getElementById("search-text").value.trim();
  if (!query) return alert("Please enter a food name.");

  const url = `https://www.themealdb.com/api/json/v1/1/search.php?s=${query}`;
  fetch(url)
    .then((response) => response.json())
    .then((data) => {
      const foodList = document.getElementById("foodList");
      foodList.innerHTML = "";

      let meals = data.meals || [];
      // if (meals.length < 16) {
      //   fetchRandomMeals(16 - meals.length).then((randomMeals) => {
      //     meals = meals.concat(randomMeals);
      //     displayMeals(meals);
      //   });
      // } else {
      //   displayMeals(meals);
      // }
      waitingText.style.display = "none";
      displayMeals(meals);
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

  let count = 0;
  meals.slice(0, 16).forEach((meal) => {
    let price = Math.floor(Math.random() * 1000) + 100;
    count++;
    const foodElement = document.createElement("div");
    console.log(meal);
    foodElement.classList.add("food");
    foodElement.dataset.id = meal.idMeal;
    foodElement.dataset.name = meal.strMeal;
    foodElement.dataset.price = price;
    foodElement.dataset.image = meal.strMealThumb;
    foodElement.dataset.description = meal.strInstructions;

    const foodHTML = `
          <div class="food-image">
             <img src="${meal.strMealThumb}" class="card-img-top"  alt="${
      meal.strMeal
    }">
          </div>
          <div class="food-content">
             <h2 class="food-title">${meal.strMeal}</h2>
             <p class="food-description">${meal.strInstructions.substring(
               0,
               100
             )}...</p>
             <div class="food-footer">
             
                <span>Price: ${price}TK</span>
                <button class="food-button btn btn-outline-info order-button" onclick="add_to_cart(this)">Add To Cart</button>
              </div>
         `;
    foodElement.innerHTML = foodHTML;
    foodList.appendChild(foodElement);
  });
  if(count%4==0){
    const foodElement = document.createElement("div");
    const foodHTML =`No items founds with this name`;
    foodElement.innerHTML = foodHTML;
    foodList.appendChild(foodElement);
  }
}
