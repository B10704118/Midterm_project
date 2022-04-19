<?php 
	session_start();
    $link = include_once "config.php";
    $sql = "SELECT * FROM `mes`";
	$result = mysqli_query($link , $sql) or die('MySQL query error');
	$sql3 = "SELECT name FROM `title`";
	$res = mysqli_query($link , $sql3)  or die('MySQL query error');
	$res = mysqli_fetch_array($res);
	$res2 = $res['name'];
	function getHeadShot($uid) {
		$link = include_once "config.php";
		$sql2 = "SELECT * FROM `photo` WHERE `uid`='$uid';";
		$result2 = mysqli_query($GLOBALS['link'],$sql2) or die('MySQL query error');
		if (mysqli_num_rows($result2) > 0) {
			$row2 = mysqli_fetch_array($result2);
			$img = $row2['image'];
			$type = $row2['type'];
			$result3 = '"data:' . $type . ';base64,' . $img;
		}
		
		return $result3;
	  }
?>

<html>
    <head>
        <?php echo"<title>$res2</title>"; ?>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
        <link rel="stylesheet" href="main.css">
    </head>
    <body>
        <div class="container" >		    
		    <span>
            <?php if(isset($_SESSION["id"])&& $_SESSION["id"]==1){?>
				<h4><span style="color: #FF0000;"><b>您為管理員!</b></span><h4>
                <h1>留言板</h1>
				<a href="logout.php">登出</a>
				<a href="add_mes.php">新增留言</a>
                <a href="admin.php">進入管理頁面</a>
				<form method="POST"  id="img-load" action="upload.php"  enctype="multipart/form-data">
					<label for="file" >上傳大頭貼:</label>
  					<input type="file"  id="file" name="file" required/>
					<button type="submit" >上傳</button>
				</form>
				<form method="POST"  id="url-load" action="upload2.php"  enctype="multipart/form-data">
					<label for="file" >利用網址上傳大頭貼:</label>
  					<input type="url" size=26  id="file" name="file" placeholder="https://example.jpg" required/>
					<button type="submit" >上傳</button>
				</form>
			<?php }else if(isset($_SESSION["id"])){?>
				<h1>留言板</h1>
				<a href="logout.php">登出</a>
				<a href="add_mes.php">新增留言</a>
				<form method="POST"  id="img-load" action="upload.php"  enctype="multipart/form-data">
					<label for="file" >上傳大頭貼:</label>
  					<input type="file"  id="file" name="file" required/>
					<button type="submit" >上傳</button>
				</form>
				<form method="POST"  id="url-load" action="upload2.php"  enctype="multipart/form-data">
					<label for="file" >利用網址上傳大頭貼:</label>
  					<input type="url" size=26  id="file" name="file" placeholder="https://example.jpg" required/>
					<button type="submit" >上傳</button>
				</form>
			<?php }else{?>
                <h1>請先登入才能進行留言以及看到留言版</h1>
				<a href="login.php">登入</a>
				<a href="register.php">註冊</a>
			<?php }?>
		    </span>
        </div>

        <?php if(isset($_SESSION["id"])){ ?>
        <?php while($row = mysqli_fetch_array($result)){ ?>
		<?php $haveHeadShot = getHeadShot($row["uid"]); ?>
    	<?php    if ($haveHeadShot) { ?>
			<a href="show_mes.php?id=<?php echo $row["id"];?>" >在獨立頁面顯示此留言↓</a>
			<div class="card">
				<h4 class="card-header">標題：<?php echo $row['title'];?>
				<?php if(@$_SESSION["id"]===$row["uid"]){?>
					<a href="mes.php?method=del&id=<?php echo $row["id"]?>" class="btn btn-danger mybtn">刪除</a>
					<a href="update_mes.php?id=<?php echo $row["id"]?>" class="btn btn-primary mybtn">編輯</a>
				<?php } ?>
				<?php
						if($row["file"]!==""){
							echo "<a href='"."data:".$row[type].";base64,".$row[file]."' download=$row[file_name]>".$row[file_name]."</a>";
						}
					?>
				</h4>
				<div class="card-body">
				    <?php echo '<img class="comment__avatar" src=' . $haveHeadShot . '" width="100" height="100" />'; ?>
					<h5>作者 : <?php echo $row["name"];?></h5>
					<p class="card-text">
						<?php 
							#echo $row["content"];
							echo "內容: ";
							require_once ('BBcode.php');
							$bbtext = $row["content"];
							$htmltext = BBcode($bbtext);
							echo $htmltext;
						?>
					</p>
					</div></div>
				</div>	
			</div>		 
		<?php }   else { ?>
			<a href="show_mes.php?id=<?php echo $row["id"];?>" >在獨立頁面顯示此留言↓</a>
			<div class="card">
				<h4 class="card-header">標題：<?php echo $row['title'];?>
				<?php if(@$_SESSION["id"]===$row["uid"]){?>
					<a href="mes.php?method=del&id=<?php echo $row["id"]?>" class="btn btn-danger mybtn">刪除</a>
					<a href="update_mes.php?id=<?php echo $row["id"]?>" class="btn btn-primary mybtn">編輯</a>
				<?php } ?>
				<?php
						if($row["file"]!==""){
							echo "<a href='"."data:".$row[type].";base64,".$row[file]."' download=$row[file_name]>".$row[file_name]."</a>";
						}
					?>
				</h4>
				<div class="card-body">
					<h5 class="card-title">作者：<?php echo $row["name"];?></h5>
					<p class="card-text">
						<?php 
							echo "內容: ";
							#echo $row["content"];
							require_once ('BBcode.php');
							$bbtext = $row["content"];
							$htmltext = BBcode($bbtext);
							echo $htmltext;
						?>
					</p>
				</div>
			</div> 
        <?php } ?>
		<?php } ?>
		<?php } ?>


    </body>
</html>