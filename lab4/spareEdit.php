<?php
	$id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
	$name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
	$price = filter_var($_POST['price'], FILTER_SANITIZE_STRING);
	$storeId = filter_var($_POST['store_id'], FILTER_SANITIZE_STRING);
	$mysql = new mysqli('localhost', 'root', '', 'autosparestore');
	$result = $mysql->query("SELECT * FROM `spare` WHERE `id` = '$id'");
	if($result->num_rows == 0){
		print'Невірний id товару';
		$mysql->close();
		exit();
	}
	$result = $mysql->query("SELECT * FROM `store` WHERE `id` = '$storeId'");
	if($result->num_rows == 0){
		print'Невірний id магазину';
		$mysql->close();
		exit();
	}
	$mysql->query("UPDATE spare SET name = '$name', price = '$price', store_id = '$storeId' WHERE id = '$id'");
	$mysql->close();
	header('Location: mainPage.php');
?>