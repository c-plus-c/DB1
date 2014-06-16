<?php
try
{
	session_start();
	unset($_SESSION["NAME"]);
	unset($_SESSION["USER_ID"]);
	unset($_SESSION["EXHIBITOR_ID"]);

	header("Location: login.php");
}
catch(PDOException $e)
{

}

$dbh = null;
?>
