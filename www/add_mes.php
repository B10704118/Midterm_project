<?php include_once "config.php";
    session_start();
    if(!isset($_SESSION["id"])){
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
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>新增留言</title>
</head>
<body>
	<div class="container">
		<h1>新增留言</h1>
		<span>
			<a href="index.php">首頁</a>
		</span>
		<form name="addForm" role="form" action="mes.php?method=add" method="post" onsubmit="return validateForm()" enctype="multipart/form-data">
            <div class="form-group">
                <label for="title">標題</label>
                <input type="text" class="form-control" id="title" placeholder="title" name="title" required>
            </div>
            <div class="form-group">
                <label for="content">內容</label>
                <textarea rows="4" cols="60" class="form-control" id="content" placeholder="content" name="content" required></textarea>
            </div>
            <div class="form-group">
                <label for="file" >添加附件檔案:</label>
  				<input type="file" class="form-control" id="file" name="file" />
            </div>
            <button type="submit" class="btn btn-primary">新增</button>
        </form>
	</div>
	     
</body>
</html>