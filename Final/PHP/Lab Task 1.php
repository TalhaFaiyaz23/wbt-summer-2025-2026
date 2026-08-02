<?php

$StudentName = "John Doe";
$StudentID = "25";
$FoodItems = array("Burger","Pizza","Sandwich","Coffee");
$Choice = array(1,2,3,4);
$Price = array(5,8,4,3);

for ($i = 0; $i < 5; $i++) {

echo "Food Item: " . $FoodItems[$i] . " - Price: $" . $Price[$i] . "<br>";

}

switch($Choice) {
    case 1:
        echo "You have selected $FoodItems[0]. The price is $Price[0]. <br>";
        break;
    case 2:
        echo "You have selected $FoodItems[1]  . The price is $Price[1]. <br>";
        break;
    case 3:
        echo "You have selected $FoodItems[2]. The price is $Price[2]. <br>";
        break;
    case 4:
        echo "You have selected $FoodItems[3]. The price is $Price[3]. <br>";
        break;
    default:
        echo "Invalid choice.";
}



echo "simple echo";
?>



