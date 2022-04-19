
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>註冊會員</title>
</head>
<script>
        
    function validateForm() {
        var x = document.forms["registerForm"]["password"].value;
        if(x.length<3){
            alert("密碼長度小於6");
            return false;
        }
    }
</script>
<body>
	<div class="container">
		<h1>註冊會員</h1>
		<form name="registerForm" role="form" action="handle_register.php" method="post" onsubmit="return validateForm()">
            <div class="form-group">
                <label for="username">帳號</label>
                <input type="text" class="form-control" id="username" placeholder="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">密碼</label>
                <input type="password" class="form-control" id="password" placeholder="Password" name="password" required>
            </div>
            <div class="form-group">
                <label for="name">名稱</label>
                <input type="text" class="form-control" id="name" placeholder="name" name="name" required>
            </div>
            <button type="submit" class="btn btn-primary">註冊</button>
			<a href="login.php">已有帳號想登入</a>
        </form>
	</div>
	     
</body>
</html>