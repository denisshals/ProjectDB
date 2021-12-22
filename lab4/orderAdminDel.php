<?php
	$id = filter_var($_POST['id'], 
		FILTER_SANITIZE_NUMBER_INT);
	$mysql = new mysqli('localhost', 'root', 
		'', 'autosparestore');
	$result = $mysql->query(
		"SELECT * FROM `order` WHERE `id` = '$id'");
	if($result->num_rows == 0){
		print'Невірний id замовлення';
		$mysql->close();
		exit();
	}
	$mysql->query("DELETE FROM spare_order WHERE 
		order_id = '$id'");
	$mysql->query("DELETE FROM `order` WHERE id='$id'");
	$mysql->close();
	header('Location: orderPage.php');
?>