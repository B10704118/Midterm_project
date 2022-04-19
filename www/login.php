
<!DOCTYPE html>
<head>
	<meta charset="UTF-8">
	<title>留言板 - 登入會員</title>
</head>
<body>
	<div class="container">
		<h1>登入會員</h1>
		<form role="form" action="handle_login.php" method="post">
            <div class="form-group">
                <label for="username">帳號</label>
                <input type="text" class="form-control" id="username" placeholder="username" name="username" required />
            </div>
            <div class="form-group">
                <label for="password">密碼</label>
                <input class="form-control" type="password" class="form-control" id="password" placeholder="Password" name="password" required />
            </div>
            <button type="submit" class="btn btn-primary">登入</button>
			<a href="register.php">註冊</a>
        </form>
	</div>
	    
</body>
</html>