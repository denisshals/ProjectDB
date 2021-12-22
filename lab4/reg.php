<?php
	$login = filter_var($_POST['login'], FILTER_SANITIZE_STRING);
	$pass = filter_var($_POST['pass'], FILTER_SANITIZE_STRING);
	$phone = filter_var($_POST['phone'], FILTER_SANITIZE_STRING);
	if(mb_strlen($login) < 5){
		echo "Короткий логін";
		exit();
	}
	if(mb_strlen($pass) < 5){
		echo "Короткий пароль";
		exit();
	}
	if(mb_strlen($phone) != 13){
		echo "Невірний номер телефону";
		exit();
	}
	$converter = array(
		'а' => 'a',    'б' => 'b',    'в' => 'v',    'г' => 'g',    'д' => 'd',
		'е' => 'e',    'ё' => 'e',    'ж' => 'zh',   'з' => 'z',    'и' => 'i',
		'й' => 'y',    'к' => 'k',    'л' => 'l',    'м' => 'm',    'н' => 'n',
		'о' => 'o',    'п' => 'p',    'р' => 'r',    'с' => 's',    'т' => 't',
		'у' => 'u',    'ф' => 'f',    'х' => 'h',    'ц' => 'c',    'ч' => 'ch',
		'ш' => 'sh',   'щ' => 'sch',  'ь' => '',     'ы' => 'y',    'ъ' => '',
		'э' => 'e',    'ю' => 'yu',   'я' => 'ya',
 
		'А' => 'A',    'Б' => 'B',    'В' => 'V',    'Г' => 'G',    'Д' => 'D',
		'Е' => 'E',    'Ё' => 'E',    'Ж' => 'Zh',   'З' => 'Z',    'И' => 'I',
		'Й' => 'Y',    'К' => 'K',    'Л' => 'L',    'М' => 'M',    'Н' => 'N',
		'О' => 'O',    'П' => 'P',    'Р' => 'R',    'С' => 'S',    'Т' => 'T',
		'У' => 'U',    'Ф' => 'F',    'Х' => 'H',    'Ц' => 'C',    'Ч' => 'Ch',
		'Ш' => 'Sh',   'Щ' => 'Sch',  'Ь' => '',     'Ы' => 'Y',    'Ъ' => '',
		'Э' => 'E',    'Ю' => 'Yu',   'Я' => 'Ya',
	);
 	$value = strtr($login, $converter);
 	print("$value");
 	exit;
	$mysql = new mysqli('localhost', 'root', '', 'autosparestore');
	$result = $mysql->query("SELECT * FROM user WHERE name = '$login'");
	if($result->num_rows != 0){
		print'Користувач з таким логіном вже існує';
		$mysql->close();
		exit();
	}
	$pass = md5($pass);
	$mysql->query("INSERT INTO `user` (`name`, `pass`, `role`, `phone`) VALUES('$login','$pass','customer', '$phone')");
	$mysql->close();
	header('Location: mainPage.php');
 ?>