<?php
	$id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
	$mysql = new mysqli('localhost', 'root', '', 'autosparestore');
	$result = $mysql->query("SELECT * FROM `review` WHERE `id` = '$id'");
	if($result->num_rows == 0){
		print'Невірний id коментаря';
		$mysql->close();
		exit();
	}
	$mysql->query("DELETE FROM review WHERE id = '$id'");
	$mysql->close();
	header('Location: reviewPage.php');
?>