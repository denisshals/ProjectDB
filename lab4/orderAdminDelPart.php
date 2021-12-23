<?php
	$id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
	$spareId = filter_var($_POST['spare_id'], FILTER_SANITIZE_STRING);
	$mysql = new mysqli('localhost', 'root', '', 'autosparestore');
	$result = $mysql->query("SELECT * FROM `order` WHERE `id` = '$id'");
	if($result->num_rows == 0){
		print'Невірний id замовлення';
		$mysql->close();
		exit();
	}
	$idArr = explode(" ", $spareId);
	for($i = 0; $i < count($idArr); $i++){
		$result = $mysql->query("SELECT * FROM `spare` WHERE `id` = '$idArr[$i]'");
		if($result->num_rows == 0){
			print'Невірний id товару';
			$mysql->close();
			exit();
		}
		$result = $mysql->query("SELECT * FROM `spare_order` WHERE order_id = '$id' AND `spare_id` = '$idArr[$i]'");
		if($result->num_rows == 0){
			print'Невірний id товару';
			$mysql->close();
			exit();
		}
	}
	for($i = 0; $i < count($idArr); $i++){
		$mysql->query("DELETE FROM spare_order WHERE order_id = '$id' AND spare_id = '$idArr[$i]'");
	}
	$result = $mysql->query("SELECT * FROM `spare_order` WHERE order_id = '$id'");
	if($result->num_rows == 0){
		$mysql->query("DELETE FROM `order` WHERE id = '$id'");
	}
	$mysql->close();
	header('Location: orderPage.php');
?>