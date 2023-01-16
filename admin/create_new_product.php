<?php
    require_once('../config/connection.php');
    $product_name=$_POST['product_name'];
    $product_text=$_POST['product_text'];
    $price=$_POST['price'];
    $picture=$_POST['picture'];
    $picture='images/'.mb_strimwidth($picture, 11, 100);

    $sql = "INSERT INTO `food_menu` (`id`, `product_name`, `product_text`, `picture`, `price`) VALUES (NULL, '$product_name', '$product_text', '$picture', '$price');";
    $result=mysqli_query($connection, $sql);
    if ($result==false){
        mysqli_error($connection);
    }
?>