<?php 
session_start();

session_unset();
session_destroy();

header("Location: /FoodTake/home_page.php");