<?php
	$name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
	$price = filter_var($_POST['price'], FILTER_SANITIZE_STRING);
	$storeId = filter_var($_POST['store_id'], FILTER_SANITIZE_NUMBER_INT);
	$mysql = new mysqli('localhost', 'root', '', 'autosparestore');
	$result = $mysql->query("SELECT * FROM `store` WHERE `id` = '$storeId'");
	if($result->num_rows == 0){
		print'Невірний id магазину';
		$mysql->close();
		exit();
	}
	$mysql->query("INSERT INTO `spare` (`name`, `price`, `store_id`) VALUES('$name', '$price', '$storeId')");
	$mysql->close();
	header('Location: mainPage.php');
?>