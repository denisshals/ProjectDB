<?php
	$userId = filter_var($_POST['user_id'], FILTER_SANITIZE_NUMBER_INT);
	$id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
	$mysql = new mysqli('localhost', 'root', '', 'autosparestore');
	$result = $mysql->query("SELECT * FROM `user` WHERE `id` = '$userId'");
	if($result->num_rows == 0){
		print'Невірний id користувача';
		$mysql->close();
		exit();
	}
	$mysql->query("UPDATE `order` SET user_id = '$userId' WHERE id = '$id'");
	$mysql->close();
	header('Location: orderPage.php');
?>