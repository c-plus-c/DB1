<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>商品購入通知</title>
</head>
<body>
<h1>商品購入通知ページ</h1>
<br /><br />
<?php

$dsn = "mysql:dbname=DBs1313096;host=koala.cc.tsukuba.ac.jp";
$user = "s1313096";
$password = "kousen08";

try
{
	$dbh = new PDO($dsn, $user, $password);

	$dbh->query('SET NAMES utf8');
	if(isset($_POST["stuff_id"]) && isset($_POST["number"]) && isset($_POST["purchaseFlag"]) && isset($_POST["stuff_name"]))
	{
		$num_query = mysql_query('SELECT FOUND_ROWS()');
		list($num) = mysql_fetch_row($num_query);

		session_start();

		$sql = 'insert into stuff (user_id, stuff_id, number) values (?, ?, ?)';
		$stmt = $dbh->prepare($sql);
		$flag = $stmt->execute(array($_SESSION['USER_ID'], $_POST['stuff_id'], $_POST["number"]));	

		print "以下の商品を購入しました！<br />\n";
		print "商品名:".$_POST["stuff_name"]."<br />\n";
		print "購入数量:".$_POST["number"]."<br />\n";
	}
	else
	{
		print "商品の購入に失敗しました。(情報不足)<br />\n";
	}
}
catch(PDOException $e)
{
	print "商品の購入に失敗しました。(データベース接続エラー)<br />\n";
}

$dbh = null;

?>
<a href="user_mypage.php">マイページへ</a><br />
</body>
</html>

