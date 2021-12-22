<?php
	$id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
	$mysql = new mysqli('localhost', 'root', '', 'autosparestore');
	$result = $mysql->query("SELECT * FROM `spare` WHERE `id` = '$id'");
	if($result->num_rows == 0){
		print'Невірний id товару';
		$mysql->close();
		exit();
	}
	$mysql->query("DELETE FROM spare WHERE id = '$id'");
	$mysql->close();
	header('Location: mainPage.php');
?>