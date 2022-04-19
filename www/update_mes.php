<?php
	$link = include_once "config.php";
	session_start();
	$id = $_GET["id"];
    $sql="SELECT * FROM `mes` WHERE id = '$id'";
	$result = mysqli_query($link , $sql) or die('MySQL query error');
   	$row = mysqli_fetch_array($result);
	if($_SESSION["id"]!=$row["uid"]){
    	header("Location: login.php");
    }
?>

<script>
        
        function validateForm() {
            var x = document.forms["addForm"]["content"].value;
            if(x.length>256){
                alert("內容不得大於256個字元!");
                return false;
            }
        }
</script>

<!DOCTYPE html>
<head>
	<meta charset="UTF-8">
	<title>編輯留言</title>
</head>
<body>
	<div class="container">
		<h1>編輯留言</h1>
		<span>
			<a href="index.php">首頁</a>
		</span>
		<form name="addForm" role="form" action="mes.php?method=update&id=<?php echo $row["id"]?>" method="post" onsubmit="return validateForm()">
            <div class="form-group">
                <label for="title">標題</label>
                <input type="text" class="form-control" id="title" placeholder="title" name="title" value="<?php echo $row["title"]?>" required>
            </div>
            <div class="form-group">
                <label for="content">內容</label>
                <textarea rows="4" cols="60"  class="form-control" id="content" placeholder="content" name="content" required><?php echo $row["content"]?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">修改</button>
        </form>
	</div>
	    
</body>
</html>