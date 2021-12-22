<?php
	$id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
	$name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
	$pass = md5(filter_var($_POST['pass'], FILTER_SANITIZE_STRING));
	$role = filter_var($_POST['role'], FILTER_SANITIZE_STRING);
	$phone = filter_var($_POST['phone'], FILTER_SANITIZE_STRING);
	$mysql = new mysqli('localhost', 'root', '', 'autosparestore');
	$result = $mysql->query("SELECT * FROM `user` WHERE `id` = '$id'");
	if($result->num_rows == 0){
		print'Невірний id користувача';
		$mysql->close();
		exit();
	}
	$mysql->query("UPDATE user SET name = '$name', pass = '$pass', role = '$role', phone = '$phone' WHERE id = '$id'");
	$mysql->close();
	header('Location: usersPage.php');
?>