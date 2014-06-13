<?php
$dsn = "mysql:dbname=uriage;host=localhost"
$user = "s1313096"
$password = "!s1313096!"

try
{
	$dbh = new PDO($dsn, $user, $password);
	
	$dbh->query('SET NAMES utf8');
	
	$sql = "select * from hoge";
	foreach()
}
catch(PDOException $e)
{

}
	session_start();
	
	$errorMessage = "";
	
	$newUserId = htmlspecialchars($_POST["userid"], ENT_QUOTES);
	
	if(isset($_POST["login"]))
	{
	
	}
?>
<!doctype html>
<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>利用者用アカウント作成画面</title>
</head>
<body>
<h1>利用者用アカウント作成画面</h1>
<form action="<?php print($_SERVER['PHP_SELF']) ?>" method="post">
ID:<input type="text" name="id" /><br />
パスワード:<input type="password" name="password" /><br />
パスワード確認:<input type="password" name="confirm" /><br />
名前:<input type="text" name="name" /><br />
住所:<input type="text" name="address" /><br />
メールアドレス:<input type="text" name="email" /><br />
<input type="submit" value="アカウント作成" />
</form>
<br />
<a href="login.php">ログイン画面へ</a><br />
<a href="create_exhibitor_account.php">業者用アカウント作成画面へ</a><br />
</body>
</html>

