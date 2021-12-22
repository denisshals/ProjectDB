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
		if(!isset($_COOKIE['user'])) header('Location: mainPage.php');
	?>
	<header>
		<div id="left">
			<a href="mainPage.php">Каталог</a>
			<a href="orderPage.php">Замовлення</a>
			<a href="">Коментарі</a>
			<?php
				if($_COOKIE['role'] == 'admin'):
			?>
			<a href="usersPage.php">Користувачі</a>
			<?php endif;?>
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
			if($_COOKIE['role'] != 'admin'){
				$title="Ваші коментарі";
				echo "<center><b>".$title."</b></center><br>";
				$name = $_COOKIE['user'];
				$result = $mysql->query("SELECT review.id, review.date, spare.name, review.rating, review.text FROM review JOIN spare ON review.spare_id = spare.id WHERE review.user_id = (SELECT id FROM user WHERE name = '$name')");
				if (!$result){
				 	echo "<center>Ви не написали жодного коментаря</center>";
				 	$mysql->close();
				 	exit();
				}
				$x = 0;
				print "<center>";
				print "<table border=\"1\" >\n";
				print "<tr>\n<th>
				Id</th><th>Дата</th><th>
				Товар</th><th>Оцінка</th><th>Коментар</th>\n</tr>\n";
				while ($row = $result->fetch_assoc()) :
				print "<tr>\n";
				print "<td>" .$row["id"]. "</td>\n<td>".$row["date"]."</td>\n<td><center>".$row["name"]."</center></td>\n<td>" .$row["rating"]. "</td>\n<td>" .$row["text"]. "</td>\n";
				print "</tr>\n";
				endwhile;
				print "</table>";
				print "</center>";
			}else{
				$title="Коментарі";
					echo "<center><b>".$title."</b></center><br>";
					$result = $mysql->query("SELECT review.id, review.date, spare.id AS spare_id, spare.name AS spare_name, user.id AS user_id, user.name AS user_name, review.rating, review.text FROM review JOIN spare ON review.spare_id = spare.id JOIN user ON user.id = review.user_id ORDER BY review.id");
					$x = 0;
					print "<center>";
					print "<table border=\"1\" >\n";
					print "<tr>\n<th>
					Id</th><th>Дата</th><th>id товару</th><th>Назва товару</th><th>id Користувача</th><th>
					Ім'я користувача</th><th>Оцінка</th><th>Коментар</th>\n</tr>\n";
					while ($row = $result->fetch_assoc()) :
					print "<tr>\n";
					print "<td>" .$row["id"]. "</td><td>" .$row["date"]. "</td><td>" .$row["spare_id"]. "</td><td>" .$row["spare_name"]. "</td>\n<td>".$row["user_id"]."</td>\n<td><center>".$row["user_name"]."</center></td>\n<td>" .$row["rating"]. "</td>\n<td>" .$row["text"]. "</td>\n";
					print "</tr>\n";
					endwhile;
					print "</table>";
					print "</center>";
			}
			$mysql->close();
		?>
		</div>
		<?php
			if($_COOKIE['role'] != 'admin') :
		?>
		<br>
		<center><b>Залишити коментар</b><br><br>
		<form action="reviewAdd.php" method="post">
			<input type="number" class="form-control" name="id" id="id" placeholder="id товару">
			<input type="number" class="form-control" name="rating" id="rating" placeholder="оцінка"><br><br>
			<textarea type="text" class="form-control" name="text" id="text" placeholder="Коментар"></textarea><br><br>
			<button type="submit">Опублікувати</button>
		</form>
		</center>
		<center><br><b>Видалити коментар</b><br><br>
		<form action="reviewDel.php" method="post">
			<input type="number" class="form-control" name="id" id="id" placeholder="id коментаря">
			<button type="submit">Видалити</button>
		</form>
		</center>
		<center><br><b>Редагувати коментар</b><br><br>
		<form action="reviewEdit.php" method="post">
			<input type="number" class="form-control" name="id" id="id" placeholder="id коментаря для редаг.">
			<input type="number" class="form-control" name="rating" id="rating" placeholder="оцінка"><br><br>
			<textarea type="text" class="form-control" name="text" id="text" placeholder="Коментар"></textarea><br><br>
			<button type="submit">Зберегти зміни</button>
		</form>
		</center>
		<?php
			else :
		?>
		<br>
		<center><b>Створити коментар</b><br><br>
		<form action="reviewAdminAdd.php" method="post">
			<input type="number" class="form-control" name="spare_id" id="spare_id" placeholder="id товару">
			<input type="number" class="form-control" name="user_id" id="user_id" placeholder="id користувача">
			<input type="number" class="form-control" name="rating" id="rating" placeholder="оцінка"><br><br>
			<textarea type="text" class="form-control" name="text" id="text" placeholder="Коментар"></textarea><br><br>
			<button type="submit">Опублікувати</button>
		</form>
		</center>
		<center><br><b>Видалити коментар</b><br><br>
		<form action="reviewAdminDel.php" method="post">
			<input type="number" class="form-control" name="id" id="id" placeholder="id коментаря">
			<button type="submit">Видалити</button>
		</form>
		</center>
		<center><br><b>Редагувати коментар</b><br><br>
		<form action="reviewAdminEdit.php" method="post">
			<input type="number" class="form-control" name="id" id="id" placeholder="id коментаря для редаг.">
			<input type="number" class="form-control" name="spare_id" id="spare_id" placeholder="id товару"><br><br>
			<input type="number" class="form-control" name="user_id" id="user_id" placeholder="id користувача">
			<input type="number" class="form-control" name="rating" id="rating" placeholder="оцінка"><br><br>
			<textarea type="text" class="form-control" name="text" id="text" placeholder="Коментар"></textarea><br><br>
			<button type="submit">Зберегти зміни</button>
		</form>
		</center>
		<?php endif;?>
	</div>
</body>
</html>