<?php
	$id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
	$mysql = new mysqli('localhost', 'root', '', 'autosparestore');
	$result = $mysql->query("SELECT * FROM `user` WHERE `id` = '$id'");
	if($result->num_rows == 0){
		print'Невірний id користувача';
		$mysql->close();
		exit();
	}
	$mysql->query("DELETE FROM user WHERE id = '$id'");
	$mysql->close();
	header('Location: usersPage.php');
?>