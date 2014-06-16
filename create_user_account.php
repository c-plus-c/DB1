<!doctype html>
<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>利用者用アカウント作成画面</title>
</head>
<body>
<h1>利用者用アカウント作成画面</h1>
<?php
$dsn = "mysql:dbname=DBs1313096;host=koala.cc.tsukuba.ac.jp";
$user = "s1313096";
$password = "kousen08";

try
{
	$newUserId = htmlspecialchars($_POST["user_id"], ENT_QUOTES);

	$dbh = new PDO($dsn, $user, $password);
	
	$dbh->query('SET NAMES utf8');
	
	$sql = "select user_id, password from user";
	$stmt = $dbh->query($sql);

	$deny = false;

	if($_POST['password'] != $_POST['confirm'] || strpos($_POST['email'],"@") == false)
	{
		$deny = true;
	}

	while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
		if($result['id'] == $_POST['user_id'] && $result['password'] == $_POST['password'])
		{
			$deny = true;
			break;
		}
	}

	if(!$deny)
	{
		$sql = 'insert into user (user_id, password, name, address, email) values (?, ?, ?, ?, ?)';
		$stmt = $dbh->prepare($sql);
		$flag = $stmt->execute(array($_POST['user_id'], $_POST['password'], $_POST['name'], $_POST['address'], $_POST['email']));

		header("Location: account_create_notice.php");
	}
	else
	{
		print "登録に失敗しました。再度やり直してください。";
	}
}
catch(PDOException $e)
{

}

$dbh = null;
?>
<form action="<?php print($_SERVER['PHP_SELF']) ?>" method="post">
ID:<input type="text" name="user_id" /><br />
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

