<?php 
	$link = include_once "config.php";
    session_start();
	if($_GET["method"]==="del"){
		$id = $_GET["id"];
		$sql = "SELECT * FROM `mes` WHERE `id`=$id";
		$result = mysqli_query($link , $sql);
		$row = mysqli_fetch_array($result);
		if($row["uid"]!==$_SESSION["id"]){
			$_GET["method"]="1";
			header("location: index.php");
		}
	}
	switch ($_GET["method"]) {
		case "add":
			add();
			break;
		case "update":
			update();
			break;
		case "del":
			del();
			break;
		default:
			break;
	}

	function add(){
        $uid = $_SESSION["id"];
		$name = $_SESSION["name"];
		$title = $_POST["title"];
		$content = $_POST["content"];
		$size = $_FILES['file']['size'];
		$file_name = $_FILES['file']['name'];
		if($size>0){
			$tmpname = $_FILES['file']['tmp_name']; // 圖片暫存位置
			$type = $_FILES['file']['type']; // 圖片類型
			$file = fopen($tmpname, 'r'); // 以二進位制開啟圖片
        	$fileContent = fread($file, $size); // 讀取文件
        	fclose($file); // 關閉圖片
        	$fileContent = base64_encode($fileContent);
			$sql = "INSERT INTO `mes` (uid, `name`, `title`, `content`,`file`,`type`,`file_name`)
			VALUES ('$uid','$name', '$title', '$content','$fileContent','$type','$file_name')";
			$result = mysqli_query($GLOBALS['link'] , $sql);
		}
		else{
			$sql = "INSERT INTO `mes` (uid, `name`, `title`, `content`,`file`,`type`,`file_name`)
			VALUES ('$uid','$name', '$title', '$content','','','')";
			$result = mysqli_query($GLOBALS['link'] , $sql);
		}
		#$sql = "SELECT * FROM `mes` WHERE ";
		#$row = mysqli_fetch_array($result);
		#echo $row['id'];
        echo "新增留言成功";
		echo '<a href="index.php">返回主頁</a>';
	}

	function update(){
		$id = $_GET["id"];
		$title = $_POST["title"];
		$content = $_POST["content"];
		$sql = "UPDATE `mes` SET title = '$title', content = '$content' WHERE id = '$id'";
		$result = mysqli_query($GLOBALS['link'] , $sql) or die('MySQL query error');
		header("location: index.php");
	}

	function del(){
		$id = $_GET["id"];
		$sql = "DELETE FROM `mes` WHERE id = $id";
		$result = mysqli_query($GLOBALS['link'] , $sql) or die('MySQL query error');
		header("location: index.php");
	}

?>