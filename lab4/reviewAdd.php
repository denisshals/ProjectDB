<?php
	$id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
	$rating = filter_var($_POST['rating'], FILTER_SANITIZE_NUMBER_INT);
	$text = filter_var($_POST['text'], FILTER_SANITIZE_STRING);
	$mysql = new mysqli('localhost', 'root', '', 'autosparestore');
	$name = $_COOKIE['user'];
	$result = $mysql->query("SELECT id FROM user WHERE name = '$name'");
	$userId = $result->fetch_assoc()["id"];
	$result = $mysql->query("SELECT spare.id FROM spare JOIN spare_order ON spare_order.spare_id = spare.id JOIN `order` ON `order`.id = spare_order.order_id WHERE `order`.user_id = 
		'$userId' AND spare.id = '$id'");
	if($result->num_rows == 0){
		print'Ви не купували данный товар';
		$mysql->close();
		exit();
	}
	$mysql->query("INSERT INTO `review` (`date`, `text`, `rating`, `spare_id`, `user_id`) VALUES(NOW(), '$text', '$rating', '$id', '$userId')");
	$mysql->close();
	header('Location: reviewPage.php');
?>