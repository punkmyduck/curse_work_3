<?php
    include('../config/connection.php');
    $user_id = $_POST['user_id'] ?? null;
    $product_id = $_POST['product_id'] ?? null;
    $count = $_POST['count'] ?? null;

    if ($user_id and $product_id and $count){
        $sql = "INSERT INTO `cart` (`user_id`, `product_id`, `count`) VALUES ('$user_id', '$product_id', '$count');";
        $result=mysqli_query($connection, $sql);
        if ($result==false){
            mysqli_error($connection);
        }
    }
?>