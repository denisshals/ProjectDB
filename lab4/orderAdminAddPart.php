<?php
	$orderId = filter_var($_POST['id'], 
		FILTER_SANITIZE_NUMBER_INT);
	$spareId = filter_var($_POST['spare_id'], 
		FILTER_SANITIZE_STRING);
	$mysql = new mysqli('localhost', 'root', 
		'', 'autosparestore');
	$idArr = explode(" ", $spareId);
	for($i = 0; $i < count($idArr); $i++){
		$result = $mysql->query(
			"SELECT * FROM `spare` WHERE `id` = 
			'$idArr[$i]'");
		if($result->num_rows == 0){
			print'Невірний id товару';
			$mysql->close();
			exit();
		}
	}
	$result = $mysql->query(
		"SELECT * FROM `order` WHERE `id`='$orderId'");
	if($result->num_rows == 0){
		print'Невірний id замовлення';
		$mysql->close();
		exit();
	}
	for($i = 0; $i < count($idArr); $i++){
		$mysql->query("INSERT INTO `spare_order` 
			(`order_id`, `spare_id`) VALUES
			('$orderId', '$idArr[$i]')");
	}
	$mysql->close();
	header('Location: orderPage.php');
?>