<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>商品ページ</title>
</head>
<body>
<h1>商品ページ</h1>
<br /><br />
<a href="user_mypage.php">利用者用マイページへ</a><br />
<form action="<?php print($_SERVER['PHP_SELF']) ?>" method="get">
検索ワード:<input type="text" name="query" value="<?php print($_GET['query']) ?>"/><br />
<input type="submit" value="検索" />
</form>
<?php

$dsn = "mysql:dbname=DBs1313096;host=koala.cc.tsukuba.ac.jp";
$user = "s1313096";
$password = "kousen08";

try
{
	$dbh = new PDO($dsn, $user, $password);

	$dbh->query('SET NAMES utf8');
	if(isset($_GET['query']) && strcmp($_GET['query'],""))
	{
		print "検索ワード：".$_GET['query']."での検索結果</br>\n";
		print "<table border='1'>\n";
		$sql = "select * from stuff"; //ここをいじれ
		$stmt = $dbh->query($sql);
		try
		{
			print "<tr><th>商品ページ</th><th>商品名</th><th>価格</th><th>評価</th></tr>";
			while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
				print "<tr><td>";
				print "<a href=stuff_page.php?stuff_id=".$result['stuff_id'].">ページへ飛ぶ</a>";
				print "</td><td>";
				print $result['stuff_name'];
				print "</td><td>";
				print $result['price'];
				print "</td><td>";
				print $result['rating'];
				print "</td></tr>\n";
			}
		}
		catch(PDOException $e){}
		print "</table>\n";
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

