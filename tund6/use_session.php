<?php
session_start();

//kas on sisse logitud

if(!isset($_SESSION["userid"])){
	//j�uga suunatakse sisselogimise lehele
	header("Location: page.php");
	exit();
}

if(isset($_GET["logout"])){
	session_destroy();
	header("Location: page.php");
	exit();
}
?>

