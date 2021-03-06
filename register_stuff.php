<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>新規商品登録画面</title>
</head>
<body>
<h1>新規商品登録画面</h1>
<?php

$dsn = "mysql:dbname=DBs1313096;host=koala.cc.tsukuba.ac.jp";
$user = "s1313096";
$password = "kousen08";

try
{
	$dbh = new PDO($dsn, $user, $password);

	$dbh->query('SET NAMES utf8');

	if(isset($_POST["name"]) && isset($_POST["price"]) && is_numeric($_POST["price"]))
	{
		$num_query = mysql_query('SELECT FOUND_ROWS()');
		list($num) = mysql_fetch_row($num_query);

		session_start();

		$id = date("YmdHis");

		$sql = 'insert into stuff (stuff_id, stuff_name, price, rating) values (?, ?, ?, ?)';
		$stmt = $dbh->prepare($sql);
		$flag = $stmt->execute(array($id, $_POST['name'], $_POST['price'], 0));

		$sql = 'insert into exhibit_history (exhibitor_id, stuff_id) values (?, ?)';
		$stmt = $dbh->prepare($sql);
		$flag = $stmt->execute(array($_SESSION["EXHIBITOR_ID"],$id));

		if(is_uploaded_file($_FILES["picture"]["tmp_name"]))
		{
			if(move_uploaded_file($_FILES["picture"]["tmp_name"],"pictures/".$_FILES["picture"]["name"]))
			{
				exec("convert pictures/".$_FILES["picture"]["name"]." "."pictures/".$id.".png");
				exec("rm pictures/".$_FILES["picture"]["name"]);
				chmod("pictures/".$id.".png", 0744);
			}
			else
			{
				print "ファイルのアップロードに失敗しました。";
			}
		}
	}

	$dbh = null;
}catch(PDOException $e){}

$dbh = null;

?>
<form action="<?php print($_SERVER['PHP_SELF']) ?>" method="post" enctype="multipart/form-data">
商品名:<input type="text" name="name" /><br />
価格:<input type="text" name="price" /><br />
写真画像(JPG, GIF, PNGのみ):<input type="file" name="picture" accept="image/jpeg, image/gif, image/png"/><br />
<input type="submit" value="商品登録" />
</form>
<br />
<a href="exhibitor_mypage.php">業者用マイページへ</a><br />
</body>
</html>
