<?php
    $link = include_once "config.php";
	session_start(); 
    $id = $_GET["id"];
    $sql = "SELECT * FROM `mes` WHERE `id`=$id";
	$result = mysqli_query($link , $sql) or die('MySQL query error2');
    function getHeadShot($uid) {
		$link = include_once "config.php";
		$sql2 = "SELECT * FROM `photo` WHERE `uid`='$uid';";
		$result2 = mysqli_query($GLOBALS['link'],$sql2) or die('MySQL query error1');
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
        <title>顯示留言</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
        <link rel="stylesheet" href="main.css">
    </head>
    <body>
        <a href="index.php">返回主頁</a>
    <?php if(isset($_SESSION["id"])){ ?>
        <?php while($row = mysqli_fetch_array($result)){ ?>
		<?php $haveHeadShot = getHeadShot($row["uid"]); ?>
    	<?php    if ($haveHeadShot) { ?>
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