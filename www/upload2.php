<?php
    $url = $_POST[file];
    $check = get_headers($url,1);
    $type=$check['Content-Type'];
    switch($check['Content-Type']) {
        case 'image/jpeg':
            $safeType = true;
            break;
        case 'image/jpg':
            $safeType = true;
            break;
        case 'image/gif':
            $safeType = true;
            break;
        case 'image/png':
            $safeType = true;
            break;
        default:
            $safeType = false;
            break;
    }
    if($safeType){
        $link = include_once "config.php";
        session_start();
        ob_start();
        readfile($url);
        $fileContent = ob_get_contents();
        ob_end_clean();
        $fileContent = base64_encode($fileContent);// 將圖片編碼成 Base64 文字
        $uid = $_SESSION['id'];

        $sql = "SELECT * FROM `photo` WHERE uid='$uid';";
	    $result = mysqli_query($link, $sql);
        if (mysqli_num_rows($result)===0) { 
            $sql2 = "INSERT INTO `photo` (uid, image, type)
            VALUES ('$uid','$fileContent','$type')";
            mysqli_query($link, $sql2);
            echo "上傳大頭貼成功!";
        } else {
            $sql2 = "UPDATE `photo` SET image='$fileContent', type='$type' WHERE uid='$uid'";
            mysqli_query($link, $sql2);
            echo "更新大頭貼成功!";
        }
    }
    else{
        echo "上傳失敗,只允許上傳jpeg,jpg,png,gif";       
    }
?>

<!DOCTYPE html>
<body>
    <a href="index.php"><br>返回主頁</a>
</body>