<?php
	$id = filter_var($_POST['id'], FILTER_SANITIZE_STRING);
	$userId = filter_var($_POST['user_id'], FILTER_SANITIZE_NUMBER_INT);
	$mysql = new mysqli('localhost', 'root', '', 'autosparestore');
	$idArr = explode(" ", $id);
	for($i = 0; $i < count($idArr); $i++){
		$result = $mysql->query("SELECT * FROM `spare` WHERE `id` = '$idArr[$i]'");
		if($result->num_rows == 0){
			print'Невірний id товару';
			$mysql->close();
			exit();
		}
	}
	$result = $mysql->query("SELECT * FROM `user` WHERE `id` = '$userId'");
	if($result->num_rows == 0){
		print'Невірний id користувача';
		$mysql->close();
		exit();
	}
	$mysql->query("INSERT INTO `order` (`user_id`, `date`) VALUES('$userId', CURRENT_DATE())");
	$result = $mysql->query("SELECT MAX(id) AS max FROM `order`");
	$orderId = $result->fetch_assoc()['max'];
	for($i = 0; $i < count($idArr); $i++){
		$mysql->query("INSERT INTO `spare_order` (spare_id, order_id) VALUES('$idArr[$i]', '$orderId')");
	}
	$mysql->close();
	header('Location: orderPage.php');
?>