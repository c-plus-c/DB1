<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>業者用アカウント作成画面</title>
</head>
<body>
<h1>業者用アカウント作成画面</h1>
<?php
$dsn = "mysql:dbname=DBs1313096;host=koala.cc.tsukuba.ac.jp";
$user = "s1313096";
$password = "kousen08";

try
{
	$newUserId = htmlspecialchars($_POST["exhibitor_id"], ENT_QUOTES);

	$dbh = new PDO($dsn, $user, $password);
	
	$dbh->query('SET NAMES utf8');
	
	$sql = "select exhibitor_id, password from exhibitor";
	$stmt = $dbh->query($sql);

	$deny = false;

	if($_POST['password'] != $_POST['confirm'] || strpos($_POST['email'],"@") == false)
	{
		$deny = true;
	}

	while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
		if($result['exhibitor_id'] == $_POST['exhibitor_id'])
		{
			$deny = true;
			break;
		}
	}

	if(!$deny)
	{
		$sql = 'insert into exhibitor (exhibitor_id, password, name, address, email) values (?, ?, ?, ?, ?)';
		$stmt = $dbh->prepare($sql);
		$flag = $stmt->execute(array($_POST['exhibitor_id'], $_POST['password'], $_POST['name'], $_POST['address'], $_POST['email']));

		header("Location: account_create_notice.php");
	}
	else if(strcmp($_POST["create_ex_flag"],"yes")==0)
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
ID:<input type="text" name="exhibitor_id" /><br />
パスワード:<input type="password" name="password" /><br />
パスワード確認:<input type="password" name="confirm" /><br />
名前:<input type="text" name="name" /><br />
住所:<input type="text" name="address" /><br />
メールアドレス:<input type="text" name="email" /><br />
<input type="hidden" name="create_ex_flag" value="yes" />
<input type="submit" value="アカウント作成" />
</form>
<br />
<a href="login.php">ログイン画面へ</a><br />
<a href="create_user_account.php">利用社用アカウント作成画面へ</a><br />
</body>
</html>
