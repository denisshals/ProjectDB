<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Autospareshop</title>
	<link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>
	<header>
		<div id="left">
			<a href="">Каталог</a>
			<?php
				if(isset($_COOKIE['user'])) :
			?>
			<a href="orderPage.php">Замовлення</a>
			<a href="reviewPage.php">Коментарі</a>
			<?php endif;?>
			<?php
				if(isset($_COOKIE['user']) && $_COOKIE['role'] == 'admin'):
			?>
			<a href="usersPage.php">Користувачі</a>
			<?php endif;?>
		</div>
		<div id="right">
			<?php
				if(!isset($_COOKIE['user'])):
			?>
			<a href="reg.html">Реєстрація</a> | <a href="login.html">Вхід</a>
			<?php else:?>
			Ласкаво просимо, <?=$_COOKIE['user']?>. <a href="exit.php">Вихід</a>
			<?php endif;?>
		</div>
	</header>
	<div class="container">
		<div id="table">
		<?php
		header("Content-Type: text/html; charset=UTF-8");
		$title="Каталог автотоварів";
		echo "<center><b>".$title."</b></center><br>";
		$mysql = new mysqli('localhost', 'root', '', 'autosparestore');
		$result = mysqli_query($mysql, 'SELECT `id`, `name`, `price`, `store_id` FROM `spare`');
		$x = 0;
		print "<center>";
		print "<table border=\"1\" >\n";
		print "<tr>\n<th>Id</th><th>
		Назва</th><th>Ціна</th><th>id магазину</th>\n</tr>\n";
		while ($row = $result->fetch_assoc()) :
		print "<tr>\n";
		print "<td>".$row["id"].
		"</td>\n<td><center>".$row["name"].
		"</center></td>\n<td>" .$row["price"]. "</td>\n<td>" .$row["store_id"]. "</td>";
		print "</tr>\n";
		endwhile;
		print "</table>";
		print "</center>";
		$mysql->close();
		?>
		</div>
		<?php
			if(isset($_COOKIE['user']) && $_COOKIE['role'] == 'admin') :
		?>
			<br>
		<center><b>Додати товар</b><br><br>
		<form action="spareAdd.php" method="post">
			<input type="text" class="form-control" name="name" id="name" placeholder="Назва">
			<input type="number" class="form-control" name="price" id="price" placeholder="Ціна"><br><br>
			<input type="number" class="form-control" name="store_id" id="store_id" placeholder="id магазину">
			<button type="submit">Додати</button>
		</form>
		</center>
		<center><br><b>Видалити товар</b><br><br>
		<form action="spareDel.php" method="post">
			<input type="number" class="form-control" name="id" id="id" placeholder="id товару">
			<button type="submit">Видалити</button>
		</form>
		</center>
		<center><br><b>Редагувати товар</b><br><br>
		<form action="spareEdit.php" method="post">
			<input type="number" class="form-control" name="id" id="id" placeholder="id товару для редагув.">
			<input type="text" class="form-control" name="name" id="name" placeholder="Назва"><br><br>
			<input type="number" class="form-control" name="price" id="price" placeholder="Ціна">
			<input type="number" class="form-control" name="store_id" id="store_id" placeholder="id магазину"><br><br>
			<button type="submit">Зберегти зміни</button>
		</form>
		</center>
		<?php endif;?>
	</div>
</body>
</html>