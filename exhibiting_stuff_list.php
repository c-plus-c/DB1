<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>出品中商品一覧</title>
</head>
<body>
<h1>出品中商品一覧画面</h1><br />
<a href="exhibitor_mypage.php">出品者用マイページへ</a><br />
<?php
$dsn = "mysql:dbname=DBs1313096;host=koala.cc.tsukuba.ac.jp";
$user = "s1313096";
$password = "kousen08";

try
{
	$dbh = new PDO($dsn, $user, $password);
	
	$dbh->query('SET NAMES utf8');
	
	session_start();

	$sql = "select stuff_id from exhibit_history where exhibitor_id = '".$_SESSION['EXHIBITOR_ID']."'";
	$stmt1 = $dbh->query($sql);

	print "<table border='1'>\n";
	print "<tr><th>画像</th><th>商品名</th><th>価格</th></tr>";
	while($result1 = $stmt1->fetch(PDO::FETCH_ASSOC)){

		$sql = "select * from stuff where stuff_id = '".$result1['stuff_id']."'";
		$stmt2 = $dbh->query($sql);
		try
		{
			while($result2 = $stmt2->fetch(PDO::FETCH_ASSOC)){
				print "<tr><td>";
				print "<img src='pictures/".$result2['stuff_id'].".png' />";
				print "</td><td>";
				print $result2['stuff_name'];
				print "</td><td>";
				print $result2['price'];
				print "</td></tr>\n";
			}
		}
		catch(PDOException $e){}
	}
	print "</table>\n";

	$dbh = null;
}
catch(PDOException $e)
{

}

?>
<br />
</body>
</html>
