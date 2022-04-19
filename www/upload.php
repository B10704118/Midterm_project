<?php
    session_start();
    $link=require_once "config.php";
    $url = $_POST[file];
    #echo $url;
    $tmpname = $_FILES['file']['tmp_name']; // 圖片暫存位置
    $uid = $_SESSION['id'];
    $type = $_FILES['file']['type']; // 圖片類型  
    switch($type) {
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
    if($_FILES['file']['size']>10000000){
        echo "上傳的檔案超過10MB";
    }
    else{
    if ($safeType) {
        $file = fopen($tmpname, 'rb'); // 以二進位制開啟圖片
        $fileContent = fread($file, filesize($tmpname)); // 讀取文件
        fclose($file); // 關閉圖片
        $fileContent = base64_encode($fileContent);// 將圖片編碼成 Base64 文字
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
}
?>

<!DOCTYPE html>
<body>
    <a href="index.php"><br>返回主頁</a>
</body>