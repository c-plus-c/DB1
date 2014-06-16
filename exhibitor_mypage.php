<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>業者マイページ</title>
</head>
<body>
<h1>業者マイページ</h1>
<?php
	print $_SESSION["NAME"];
?>
さんようこそ！<br /><br />
<br />
<a href="#">アカウント情報変更ページへ</a><br />
<a href="order_list.php">注文履歴参照ページへ</a><br />
<a href="#">新規商品登録ページへ</a><br />

<form action="#" method="post">
<input type="submit" value="ログアウト" />
</form>
</body>
</html>

