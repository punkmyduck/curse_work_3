<?php
    require_once('../config/connection.php');
    $id=$_POST['id'];
    $sql = "DELETE FROM `food_menu` WHERE `food_menu`.`id` = $id;";
    $result=mysqli_query($connection, $sql);
    if ($result==false){
        mysqli_error($connection);
    }
?>