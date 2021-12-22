<?php 
	$login = filter_var($_POST['login'], FILTER_SANITIZE_STRING);
	$pass = filter_var($_POST['pass'], FILTER_SANITIZE_STRING);
	if(mb_strlen($login) < 5){
		print "Короткий логін";
		exit();
	}
	if(mb_strlen($pass) < 5){
		print "Короткий пароль";
		exit();
	}
	$mysql = new mysqli('localhost', 'root', '', 'autosparestore');
	$pass = md5($pass);
	$result = $mysql->query("SELECT `name`, `role` FROM `user` WHERE `name` = '$login' AND `pass` = '$pass'");
	if($result->num_rows == 0){
		print'Невірний логін або пароль';
		$mysql->close();
		exit();
	}
	$user = $result->fetch_assoc();
	setcookie('user', $user['name'], time() + 3600, "/");
	setcookie('role', $user['role'], time() + 3600, "/");
	$mysql->close();
	header('Location: mainPage.php');
?>