<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>商品検索ページ</title>
</head>
<body>
<h1>商品検索ページ</h1>
<br /><br />
<a href="user_mypage.php">利用者用マイページへ</a><br />
<br /><br />
<?php

$dsn = "mysql:dbname=DBs1313096;host=koala.cc.tsukuba.ac.jp";
$user = "s1313096";
$password = "kousen08";

try
{
	$dbh = new PDO($dsn, $user, $password);

	$dbh->query('SET NAMES utf8');
	if(isset($_GET['stuff_id']))
	{
		print "<form action='purchase_notice.php' method='post'>\n";
		$sql = "select * from stuff where stuff_id = ".$_GET['stuff_id'];
		$stmt = $dbh->query($sql);
		try
		{
			while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
				print "<img src='pictures/".$result['stuff_id'].".png' /><br />\n";
				print "商品名：".$result['stuff_name']."<br />\n";
				print "価格：".$result['price']."<br />\n";
				print "評価：".$result['rating']."/5<br />\n";
				print "購入数量：<input type='number' name='number' value='1' min='1'><br />\n";
				print "<input type='hidden' name='stuff_id' value='".$result['stuff_id']."'>\n";
				print "<input type='hidden' name='purchaseFlag' value='1'>\n";
				print "<input type='hidden' name='stuff_name' value='".$result['stuff_name']."'>\n";
				print "<input type='submit' value='この商品を購入する'><br /><br />\n";
			}
		}
		catch(PDOException $e){}
		print "</form>\n";
	}

	$dbh = null;
}
catch(PDOException $e)
{
	$dbh = null;
}


?>
</body>
</html>

