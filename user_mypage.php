<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>利用者マイページ</title>
</head>
<body>
<h1>利用者マイページ</h1>
<?php
	session_start();
	print $_SESSION["NAME"];
?>
さんようこそ！<br /><br />

<a href="">アカウント情報変更ページへ</a><br />
<a href="purchase_list.php">購入履歴参照ページへ</a><br />
<a href="search_stuff.php">商品検索と結果表示ページへ</a><br />
<br />

<form action="logout.php" method="post">

<input type="submit" value="ログアウト" />
</form>
</body>
</html>

