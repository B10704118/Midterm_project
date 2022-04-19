<?php 
    $link=include_once "config.php";
    session_start();
    $sql3 = "SELECT name FROM `title`";
	$res = mysqli_query($link , $sql3)  or die('MySQL query error');
	$res = mysqli_fetch_array($res);
	$res2 = $res['name'];
    if($_SESSION["id"] !== '1'){
    	#echo "您不是管理員，所以無法進行管理<br>";
        #echo '<a href="index.php">返回主頁</a>';
        header ('location:index.php');
    }
?>

<!DOCTYPE html>
<head>
	<meta charset="UTF-8">
	<title>管理頁面</title>
</head>
<body>
    <?php if($_SESSION["id"] === '1'){ ?>
	<div class="container">
		<h1>歡迎進入管理頁面，管理員可以修改首頁標題</h1>
		<form role="form" action="handle_admin.php" method="post">
            <div class="form-group">
                <label for="title">修改首頁標題</label>
                <input type="text" class="form-control" id="title" placeholder="text" name="title" value="<?php echo $res2?>" required />
            </div>
            <button type="submit" class="btn btn-primary">提交</button>
            <a href="index.php">返回主頁</a>
        </form>
	</div>
	<?php } ?>
</body>
</html>