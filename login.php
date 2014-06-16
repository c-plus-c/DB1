<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>ログイン画面</title>
</head>
<body>
<h1>ログイン画面</h1>
<?php
$dsn = "mysql:dbname=DBs1313096;host=koala.cc.tsukuba.ac.jp";
$user = "s1313096";
$password = "kousen08";

try
{
	$dbh = new PDO($dsn, $user, $password);
	
	$dbh->query('SET NAMES utf8');

	if($_POST["account_classification"]=="user")
	{
		$sql = "select user_id, password from user";
		$stmt = $dbh->query($sql);

		$succeed=false;
		while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
			if($result['user_id'] == $_POST['id'] && $result['password'] == $_POST['password'])
			{
				$succeed = true;
				break;
			}
		}

		if($succeed)
		{

		}
		else
		{
			print "ログイン失敗<br />";
		}

	}
	elseif($_POST["account_classification"]=="exhibitor")
	{
		$sql = "select exhibitor_id, password from exhibitor";
		$stmt = $dbh->query($sql);

		$succeed = false;

		while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
			if($result['exhibitor_id'] == $_POST['id'] && $result['password'] == $_POST['password'])
			{
				$succeed = true;
				break;
			}
		}

		if($succeed)
		{

		}
		else
		{
			print "ログイン失敗<br />";
		}
	}
}
catch(PDOException $e)
{

}

$dbh = null;
?>
<form action="#" method="post">
アカウント種別<br />
<input type="radio" name="account_classification" value="user" checked>利用者
<input type="radio" name="account_classification" value="exhibitor">出品者<br />
ID:<input type="text" name="id" /><br />
パスワード:<input type="password" name="password" /><br />
<input type="submit" value="ログイン" />
</form>
<br />
<a href="create_user_account.php">利用社用アカウント作成画面へ</a><br />
<a href="create_exhibitor_account.php">業者用アカウント作成画面へ</a><br />
</body>
</html>
