<?php
	$id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
	$userId = filter_var($_POST['user_id'], FILTER_SANITIZE_NUMBER_INT);
	$spareId = filter_var($_POST['spare_id'], FILTER_SANITIZE_NUMBER_INT);
	$rating = filter_var($_POST['rating'], FILTER_SANITIZE_STRING);
	$text = filter_var($_POST['text'], FILTER_SANITIZE_STRING);
	$mysql = new mysqli('localhost', 'root', '', 'autosparestore');
	$result = $mysql->query("SELECT * FROM `review` WHERE `id` = '$id'");
	if($result->num_rows == 0){
		print'Невірний id коментаря';
		$mysql->close();
		exit();
	}
	$result = $mysql->query("SELECT * FROM `user` WHERE `id` = '$userId'");
	if($result->num_rows == 0){
		print'Невірний id користувача';
		$mysql->close();
		exit();
	}
	$result = $mysql->query("SELECT * FROM `spare` WHERE `id` = '$spareId'");
	if($result->num_rows == 0){
		print'Невірний id товару';
		$mysql->close();
		exit();
	}
	$mysql->query("UPDATE review SET review.text = '$text', review.rating = '$rating', review.spare_id = '$spareId', review.user_id = '$userId' WHERE id = '$id'");
	$mysql->close();
	header('Location: reviewPage.php');
?>