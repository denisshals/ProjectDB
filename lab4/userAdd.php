<?php
	$name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
	$pass = md5(filter_var($_POST['pass'], FILTER_SANITIZE_STRING));
	$role = filter_var($_POST['role'], FILTER_SANITIZE_STRING);
	$phone = filter_var($_POST['phone'], FILTER_SANITIZE_STRING);
	$mysql = new mysqli('localhost', 'root', '', 'autosparestore');
	$mysql->query("INSERT INTO `user` (`name`, `pass`, `role`, `phone`) VALUES('$name', '$pass', '$role', '$phone')");
	$mysql->close();
	header('Location: usersPage.php');
?>