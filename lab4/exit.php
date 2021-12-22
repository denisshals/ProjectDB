<?php
	setcookie('user', $user['name'], time() - 3600, "/");
	setcookie('role', $user['role'], time() - 3600, "/");
	header('Location: mainPage.php');
?>s