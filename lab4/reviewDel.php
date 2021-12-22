
<?php
	$id=filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
	$mysql = new mysqli('localhost', 'root', '', 
		'autosparestore');
	$name = $_COOKIE['user'];
	$check1 = $mysql->query("SELECT id FROM user WHERE 
		name = '$name'");
	$check2 = $mysql->query("SELECT user_id FROM review 
		WHERE id = '$id'");
	if($check2->num_rows == 0){
		print'Коментаря з таким id не уснує';
		$mysql->close();
		exit();
	}
	$row1 = $check1->fetch_assoc();
	$row2 = $check2->fetch_assoc();
	$user1 = implode($row1);
	$user2 = implode($row2);
	if($user1 != $user2){
		print'Даний коментар не є Вашим';
		$mysql->close();
		exit();
	}
	$mysql->query("DELETE FROM review WHERE id='$id'");
	$mysql->close();
	header('Location: reviewPage.php');
?>