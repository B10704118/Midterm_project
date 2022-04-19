<?php 
	$link=require_once "config.php"; 
	$sql = "SELECT * FROM `users` WHERE `username` = '$_POST[username]' and `password` = '$_POST[password]';";
	$result = mysqli_query($link, $sql);
    #$row = mysqli_fetch_array($result);
	if(mysqli_num_rows($result)===1){
		session_start();
		$row = mysqli_fetch_array($result);
        $_SESSION["id"] = $row['id'];
		$_SESSION["name"] = $row['name'];
        mysqli_close($link);
        header("Location: index.php");
		exit();
	}else{
		echo "帳號或密碼錯誤!";
	    require_once('login.php');
	}
	    
    
?>