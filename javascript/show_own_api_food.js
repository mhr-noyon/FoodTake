let countShowFood = 0;

document.addEventListener("DOMContentLoaded", () => {
  const ajax = new XMLHttpRequest();
  const foodList = document.getElementById("foodList");
  const waitingText = document.getElementById("waiting_for_food");
  ajax.open("GET", "/FoodTake/javascript/meal.json", true);
  ajax.onload = function () {
    if (this.status == 200) {
      const val = JSON.parse(this.responseText);
      console.log(val);
      let count = 0;
      waitingText.style.display = "none";

      for (let i = 0; i < val.length; i++) {
        if (count == 20) {
          break;
        }
        const meal = val[i + countShowFood++];
        const foodElement = document.createElement("div");
        foodElement.classList.add("food");
        foodElement.dataset.id = meal.id;
        foodElement.dataset.name = meal.name;
        foodElement.dataset.price = meal.price;
        foodElement.dataset.image = meal.image;
        foodElement.dataset.description = meal.description;

        const foodHTML = `
          <div class="food-image">
                <img src="${meal.image}" class="card-img-top" alt="${meal.strMeal}" />
          </div>
          <div class="food-content">
              <h2 class="food-title">${meal.name}</h2>
              <p class="food-description">${meal.description}
                 <a href="#">See more</a>
              </p>

              <div class="food-footer">
                <span>Price: ${meal.price}TK</span>
                <button class="food-button btn btn-outline-info order-button" onclick="add_to_cart(this)">Add To Cart</button>
              </div>
          </div>
        `;

        foodElement.innerHTML = foodHTML;
        foodList.appendChild(foodElement);
        count++;
        // foodElement.addEventListener("click", () => {
        //   alert(`You clicked on: ${meal.name}`);
        // });
      }
    }
  };
  ajax.send();
});
// let countShowFood = 0;
// document.addEventListener("DOMContentLoaded", () => {
//   const ajax = new XMLHttpRequest();
//   const foodList = document.getElementById("foodList");
//   const waitingText = document.getElementById("waiting_for_food");
//   ajax.open("GET", "/FoodTake/javascript/meal.json", true);
//   ajax.onload = function () {
//     if (this.status == 200) {
//       const val = JSON.parse(this.responseText);
//       console.log(val);
//       let count = 0;
//       waitingText.style.display = "none";

//       for (let i = 0; i < val.length; i++) {
//         if (count == 20) {
//           break;
//         }
//         const meal = val[i + countShowFood++];
//         const foodElement = document.createElement("div");
//         foodElement.classList.add("food");
//         // foodElement.dataset = meal;
//         foodElement.dataset.id = meal.id;
//         foodElement.dataset.name = meal.name;
//         foodElement.dataset.price = meal.price;
//         foodElement.dataset.image = meal.image;
//         foodElement.dataset.description = meal.description;

//         const foodHTML = `
//           <div class="food-image">
//                 <img src="${meal.image}" class="card-img-top" alt="${meal.strMeal}" />
//           </div>
//           <div class="food-content">
//               <h2 class="food-title">${meal.name}</h2>
//               <p class="food-description">${meal.description}
//                  <a href="#">See more</a>
//               </p>
//               <div class="food-footer">
//                 <span>Price: ${meal.price}TK</span>
//                 <button class="food-button btn btn-outline-info order-button" id="${meal.id}">Add To Cart</button>
//               </div>
//           </div>
//                `;

//         foodElement.innerHTML = foodHTML;

//         foodList.appendChild(foodElement);
//         count++;

//         document
//           .querySelector(".order-button")
//           .addEventListener("click", () => {
//             console.log("Home clicked");
//           });

//         document
//           .querySelector(".order-button")
//           .addEventListener("click", () => {
//             alert(`You clicked on: ${meal.name}`);

//             fetch("./customer_signin/add_to_cart.php", {
//               method: "POST",
//               headers: {
//                 "Content-Type": "application/json",
//               },
//               body: JSON.stringify({
//                 id: meal.id,
//                 name: meal.name,
//                 price: meal.price,
//                 description: meal.description,
//                 image: meal.image,
//               }),
//             })
//               .then((response) => response.json())
//               .then((data) => {
//                 if (data.status === "success") {
//                   console.log("Success:", data.message);
//                 } else {
//                   console.error("Error:", data.message);
//                 }
//               })
//               .catch((error) => {
//                 console.error("Fetch Error:", error);
//               });
//           });
//         if (count == 20) {
//           return;
//         }
//         // const orderButton = document.querySelector(".order-button");

//         // if (orderButton) {
//         //   orderButton.addEventListener("click", () => {
//         //     console.log("Okay");
//         //   });
//         // } else {
//         //   console.error("Element with class 'order-button' not found.");
//         // }
//       }
//     } else {
//       foodList.innerHTML = "<p>Error fetching food data</p>";
//     }
//   };
//   ajax.send();
// });
// document.getElementById("home").addEventListener("click", () => {
//   console.log("Home clicked");
// });
// // document.querySelector(".order-button").addEventListener("click", () => {
// //   // let foodElement = document.querySelector(".food");
// //   console.log(foodElement);

// //   // const meal = {
// //   //   id: foodElement.dataset.id,
// //   //   name: foodElement.dataset.name,
// //   //   price: foodElement.dataset.price,
// //   //   description: foodElement.dataset.description,
// //   //   image: foodElement.dataset.image,
// //   // };
// //   // alert(`You clicked on: ${meal.name}`);
// // });
// /*
// foodElement.addEventListener("click", () => {
//   alert(`You clicked on: ${meal.name}`);
//   const xmlPayload = `
//             <meal>
//                 <id>${meal.id}</id>
//                 <name>${meal.name}</name>
//                 <price>${meal.price}</price>
//                 <description>${meal.description}</description>
//                 <image>${meal.image}</image>
//             </meal>
//         `;
//   // Create a new XMLHttpRequest object
//   const xhr = new XMLHttpRequest();
//   xhr.open("POST", "./customer_signin/add_to_cart.php", true);
//   // xhr.setRequestHeader("Content-Type", "application/xml");

//   // Define what happens on successful data submission
//   xhr.onload = function () {
//     if (xhr.status >= 200 && xhr.status < 300) {
//       console.log("Raw response:", xhr.responseText);
//       try {
//         const data = JSON.parse(xhr.responseText); // Parse JSON
//         if (data.status === "success") {
//           console.log("Success:", data.message);
//         } else {
//           console.error("Error:", data.message);
//         }
//       } catch (error) {
//         console.error(
//           "JSON Parse Error:",
//           error,
//           "Response Text:",
//           xhr.responseText
//         );
//       }
//     } else {
//       console.error("Request failed. Status:", xhr.status);
//     }
//   };

//   // Define what happens in case of an error
//   xhr.onerror = function () {
//     console.error("Request Error");
//   };

//   // Send the XML payload
//   xhr.send(xmlPayload);
// });
// */

// // document.addEventListener("DOMContentLoaded", function () {
// //      const foodList = document.getElementById("foodlist");
// //      fetch("https://www.themealdb.com/api/json/v1/1/search.php?s=burger")
// //        .then((response) => response.json())
// //        .then((data) => {
// //          console.log(data.meals);
// //          if (data.meals) {
// //            data.meals.forEach((meal) => {

// //     let price = Math.floor(Math.random() * 1000);
// //              const foodElement = document.createElement("div");
// //              foodElement.classList.add("food");

// //              const foodHTML = `{
// //                "id": "${meal.idMeal}",
// //                "name": "${meal.strMeal}",
// //                "price": "${price}",
// //                "description": "${meal.strInstructions}",
// //                "image": "${meal.strMealThumb}"
// //                  },<br>`;

// //              foodElement.innerHTML = foodHTML;

// //              foodList.appendChild(foodElement);
// //            });
// //          } else {
// //            foodList.innerHTML = "<p>No meals found</p>";
// //          }
// //        })
// //        .catch((error) => {
// //          console.error("Error fetching food data:", error);
// //        });
// //    });
