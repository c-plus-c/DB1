<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>注文履歴参照ページ</title>
</head>
<body>
<h1>注文履歴参照ページ</h1>
<?php

$dsn = "mysql:dbname=DBs1313096;host=koala.cc.tsukuba.ac.jp";
$user = "s1313096";
$password = "kousen08";

try
{
	$dbh = new PDO($dsn, $user, $password);
	
	$dbh->query('SET NAMES utf8');

	print "<form action='#' method='post'>\n";
	print "<table border='1'>\n<tr><th>選択</th><th>商品名</th><th>注文数量</th><th>連絡先</th></tr>";

	session_start();

	$sql = "select * from exhibit_history where exhibitor_id = '".$_SESSION["EXHIBITOR_ID"]."'";

	$stmt = $dbh->query($sql);

	while($result = $stmt->fetch(PDO::FETCH_ASSOC))
	{
		$sql = "select * from purchase_history where stuff_id = ".$result["stuff_id"];
		$stmt2 = $dbh->query($sql);

		while($result2 = $stmt2->fetch(PDO::FETCH_ASSOC))
		{
			print "<tr><td><input type='checkbox' name='purchase_id' value='".$result2['purchase_id']."'></td>\n";

			$sql = "select stuff_name from stuff where stuff_id = ".$result["stuff_id"];
			$stmt3 = $dbh->query($sql);

			while($result3 = $stmt3->fetch(PDO::FETCH_ASSOC))
			{
				print "<td>".$result3['stuff_name']."</td>";
			}

			print "<td>".$result2['number']."</td>\n";

			$sql = "select email from user where user_id = '".$result2['user_id']."'";
			$stmt3 = $dbh->query($sql);
			while($result3 = $stmt3->fetch(PDO::FETCH_ASSOC))
			{
				print "<td>".$result3['email']."</td>";
			}

			print "</tr>\n";
		}
	}
}
catch(PDOException $e){}
print "</table>\n";
print "<input type='submit' value='選択した履歴を削除する'><br /><br />\n";
print "</form>\n";
?>
<br />
<a href="exhibitor_mypage.php">マイページへ</a><br />
</body>
</html>
