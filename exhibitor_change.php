<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>業者用アカウント変更画面</title>
</head>
<body>
<h1>業者用アカウント変更画面</h1>
<br />
<a href="exhibitor_mypage.php">マイページへ</a><br />
<?php
$dsn = "mysql:dbname=DBs1313096;host=koala.cc.tsukuba.ac.jp";
$user = "s1313096";
$password = "kousen08";

try
{
	session_start();

	$dbh = new PDO($dsn, $user, $password);
	
	$dbh->query('SET NAMES utf8');

	$stmt = $dbh->prepare("select * from exhibitor where exhibitor_id = :id");
	$stmt->bindParam(":id", $_SESSION['EXHIBITOR_ID'], PDO::PARAM_STR);
	$stmt->execute();
	$row = $stmt->fetch(PDO::FETCH_ASSOC);

	if(isset($_POST["name"]) && isset($_POST["address"]) && isset($_POST["email"]) && strcmp($row["password"],$_POST["former_password"])==0)
	{

		if(! $row)
		{
			print "旧パスワードパスワードが正しくありません。";
		}
		else if(strcmp($_POST["change"],"yes")==0)
		{
			if(strcmp($_POST["new_password"],"")!=0 && strcmp($_POST["confirm"],$_POST["new_password"]) == 0)
			{
				$sql = 'update exhibitor set password = ?, name = ?, address = ?, email = ? where exhibitor_id = ?';
				$stmt = $dbh->prepare($sql);
				$flag = $stmt->execute(array($_POST["new_password"], $_POST["name"], $_POST["address"], $_POST["email"], $_SESSION["EXHIBITOR_ID"]));	

				if($flag)
				{
					header("Location: exhibitor_mypage.php");
				}
			}
			else
			{
				$sql = 'update exhibitor set name = ?, address = ?, email = ? where exhibitor_id = ?';
				$stmt = $dbh->prepare($sql);
				$flag = $stmt->execute(array($_POST["name"], $_POST["address"], $_POST["email"], $_SESSION["EXHIBITOR_ID"]));	

				if($flag)
				{
					header("Location: exhibitor_mypage.php");
				}
			}
		}
	}

echo <<< EOM
<form action="{$_SERVER['PHP_SELF']}" method="post">
旧パスワード:<input type="password" name="former_password" /><br />

新規パスワード(変更する場合のみ入力):<input type="password" name="new_password" /><br />
新規パスワード確認(変更する場合のみ入力):<input type="password" name="confirm" /><br />

名前:<input type="text" name="name" value="{$row["name"]}"/><br />
住所:<input type="text" name="address" value="{$row["address"]}"/><br />
メールアドレス:<input type="text" name="email" value="{$row["email"]}"/><br />
<input type="hidden" name="change" value="yes" />
<input type="submit" value="アカウント情報変更" />
</form>
<br />
EOM;
}
catch(PDOException $e)
{

}

$dbh = null;
?>

</body>
</html>
