<?php
    require_once('../config/connection.php');
    $flag=0;
    $id=$_POST['id'];
    $product_name=$_POST['product_name'];
    $product_text=$_POST['product_text'];
    $price=$_POST['price'];
    $picture=$_POST['product_picture'];
    $picture='images/'.mb_strimwidth($picture, 11, 100);
    if (isset($_POST['id']) and isset($_POST['product_name']) and isset($_POST['product_text']) and isset($_POST['price']) and isset($_POST['product_picture'])) {
        $flag=1;
        $sql = "UPDATE `food_menu` SET `product_name` = '$product_name', `product_text` = '$product_text', `picture` = '$picture', `price` = '$price' WHERE `food_menu`.`id` = $id;";
        $result=mysqli_query($connection, $sql);
        if ($result==false){
            mysqli_error($connection);
        }
    }
    else $flag=-1;
    echo $flag;
?>