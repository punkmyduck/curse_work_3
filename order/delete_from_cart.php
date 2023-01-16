<?php
    include('../config/connection.php');
    $id=$_POST['id'];
    if ($id) {
        $sql = "DELETE FROM cart WHERE `cart`.`id` = '$id';";
        $result=mysqli_query($connection, $sql);
        if ($result==false){
            mysqli_error($connection);
        }
    }
?>