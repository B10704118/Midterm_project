<?php 
    $link = include_once "config.php";
    session_start();
    if($_SESSION["id"] !== '1'){
        header("location: index.php");
    }
    $sql = "UPDATE `title` SET name = '$_POST[title]'";
	$result = mysqli_query($link , $sql) or die('MySQL query error');
	echo "修改成功!";
    
?>


<!DOCTYPE html>
<body>
    <a href="index.php"><br>返回主頁</a>
    <a href="admin.php">返回管理頁面</a>
</body>