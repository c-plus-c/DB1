<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>業者マイページ</title>
</head>
<body>
<h1>業者マイページ</h1>
<?php
	session_start();
	print $_SESSION["NAME"];
?>
さんようこそ！<br /><br />
<br />
<a href="exhibitor_change.php">アカウント情報変更ページへ</a><br />
<a href="order_list.php">注文履歴参照ページへ</a><br />
<a href="register_stuff.php">新規商品登録ページへ</a><br />
<a href="exhibiting_stuff_list.php">出品商品一覧ページへ</a><br />

<form action="logout.php" method="post">
<input type="submit" value="ログアウト" />
</form>
</body>
</html>

