<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Autospareshop</title>
	<link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>
	<?php
		if(!isset($_COOKIE['user']) && $_COOKIE['role'] != 'admin') header('Location: mainPage.php');
	?>
	<header>
		<div id="left">
			<a href="mainPage.php">Каталог</a>
			<a href="orderPage.php">Замовлення</a>
			<a href="reviewPage.php">Коментарі</a>
			<a href="">Користувачі</a>
		</div>
		<div id="right">
			Ласкаво просимо, <?=$_COOKIE['user']?>. <a href="exit.php">Вихід</a>
		</div>
	</header>
	<div class="container">
		<div id="table">
		<?php
			header("Content-Type: text/html; charset=UTF-8");
			$mysql = new mysqli('localhost', 'root', '', 'autosparestore');
			$title="Користувачі";
			echo "<center><b>".$title."</b></center><br>";
			$result = $mysql->query("SELECT * FROM user");
			$x = 0;
			print "<center>";
			print "<table border=\"1\" >\n";
			print "<tr>\n<th>
			Id</th><th>Ім'я</th><th>
			Пароль</th><th>Роль</th><th>Телефон</th>\n</tr>\n";
			while ($row = $result->fetch_assoc()) :
			print "<tr>\n";
			print "<td>" .$row["id"]. "</td>\n<td>".$row["name"]."</td>\n<td><center>".$row["pass"]."</center></td>\n<td>" .$row["role"]. "</td>\n<td>" .$row["phone"]. "</td>\n";
			print "</tr>\n";
			endwhile;
			print "</table>";
			print "</center>";
			$mysql->close();
		?>
		</div>
		<br>
		<center><b>Створити користувача</b><br><br>
		<form action="userAdd.php" method="post">
			<input type="text" class="form-control" name="name" id="name" placeholder="Ім'я">
			<input type="text" class="form-control" name="pass" id="pass" placeholder="Пароль"><br><br>
			<input type="text" class="form-control" name="role" id="role" placeholder="Роль">
			<input type="text" class="form-control" name="phone" id="phone" placeholder="Телефон"><br><br>
			<button type="submit">Створити</button>
		</form>
		</center>
		<center><br><b>Видалити користувача</b><br><br>
		<form action="userDel.php" method="post">
			<input type="number" class="form-control" name="id" id="id" placeholder="id користувача">
			<button type="submit">Видалити</button>
		</form>
		</center>
		<center><br><b>Редагувати користувача</b><br><br>
		<form action="userEdit.php" method="post">
			<input type="number" class="form-control" name="id" id="id" placeholder="id користувача для редаг.">
			<input type="text" class="form-control" name="name" id="name" placeholder="Ім'я"><br><br>
			<input type="text" class="form-control" name="pass" id="pass" placeholder="Пароль">
			<input type="text" class="form-control" name="role" id="role" placeholder="Роль"><br><br>
			<input type="text" class="form-control" name="phone" id="phone" placeholder="Телефон">
			<button type="submit">Зберегти зміни</button>
		</form>
		</center>
	</div>
</body>
</html>