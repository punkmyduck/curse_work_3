<?php
    include('../config/connection.php');
    $user_id = $_POST['user_id'] ?? null;

    if ($user_id){
        $sql = "DELETE FROM `cart` WHERE `cart`.`user_id` = $user_id;";
        $result=mysqli_query($connection, $sql);
        if ($result==false){
            mysqli_error($connection);
        }
    }
    unset($_COOKIE['user_id']);
?>