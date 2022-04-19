<?php
    $link=require_once("config.php");
    $username=$_POST["username"];
    $password=$_POST["password"];
    $name=$_POST["name"];
    $sql = "SELECT * FROM users WHERE `username` = '$username';";
    $result = mysqli_query($link, $sql);
    if(mysqli_num_rows($result)===0){
        $sql = "INSERT INTO `users` (username, password, name)
        VALUES ('$_POST[username]','$_POST[password]','$_POST[name]')";
        mysqli_query($link, $sql);
        #header("location: login.php");
        echo "註冊成功";
        require_once('login.php');
        mysqli_close($link);
        exit;
    }
    else{
        echo "該帳號已有人使用!<br>";
        require_once('register.php');
        exit;
    }

?>