<?php
    require_once('../config/connection.php');
    $flag=0;
    $login=$_POST['login'];
    $password=$_POST['password'];
    $sql = "SELECT *  FROM `admins` WHERE `login` LIKE '$login' AND `password` LIKE '$password';";
    $result=mysqli_query($connection, $sql);
    if ($result==false){
        mysqli_error($connection);
    }
    $count=mysqli_num_rows($result);
    if ($count>0){
        $flag=1;
    }
    else $flag=-1;
    echo $flag;
?>