<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, 
	initial-scale=1.0">
	<title>Autospareshop</title>
	<link rel="stylesheet" type="text/css" 
	href="css/main.css">
</head>
<body>
	<?php
		if(!isset($_COOKIE['user'])) 
		header('Location: mainPage.php');
	?>
	<header>
		<div id="left">
			<a href="mainPage.php">Каталог</a>
			<a href="">Замовлення</a>
			<a href="reviewPage.php">Коментарі</a>
			<?php
				if($_COOKIE['role'] == 'admin'):
			?>
			<a href="usersPage.php">Користувачі</a>
			<?php endif;?>
		</div>
		<div id="right">
			Ласкаво просимо, <?=$_COOKIE['user']?>. 
			<a href="exit.php">Вихід</a>
		</div>
	</header>
	<div class="container">
		<div id="table">
		<?php
			header("Content-Type: text/html; charset=UTF-8");
			$mysql = new mysqli('localhost', 'root', '', 
			'autosparestore');
			if($_COOKIE['role'] != 'admin'){
				$title="Ваші замовлення";
				echo "<center><b>".$title."</b></center>
				<br>";
				$name = $_COOKIE['user'];
				$result = $mysql->query("SELECT spare.id, spare.name,spare.price, `order`.date FROM spare JOIN spare_order ON spare_order.spare_id = spare.id JOIN`order` ON `order`.id=spare_order.order_id WHERE `order`.user_id = (SELECT id FROM user WHERE name = '$name') ORDER BY date DESC");
				if (!$result){
				 	echo "<center>Ви не зробили жодного 
				 	замовлення</center>";
				 	$mysql->close();
				 	exit();
				}
				$x = 0;
				print "<center>";
				print "<table border=\"1\" >\n";
				print "<tr>\n<th>
				Id товару</th><th>Дата</th><th>
				Назва</th><th>Ціна</th>\n</tr>\n";
				while ($row = $result->fetch_assoc()) :
				print "<tr>\n";
				print "<td>" .$row["id"]. "</td>\n <td>
				".$row["date"]."</td>\n<td> <center>
				".$row["name"]."</center> </td>\n<td>
				" .$row["price"]. " </td>\n";
				print "</tr>\n";
				endwhile;
				print "</table>";
				print "</center>";
			}else{
				$title="Замовлення";
				echo "<center><b>".$title."</b></center>
				<br>";
				$result= $mysql->query("SELECT `order`.id,
				 `order`.date, `order`.user_id, user.name 
				 AS user_name, spare.id AS spare_id, 
				 spare.name AS spare_name FROM spare JOIN 
				 spare_order ON spare_order.spare_id = 
				 spare.id JOIN `order` ON `order`.id = 
				 spare_order.order_id JOIN user ON 
				 `order`.user_id = user.id ORDER BY 
				 `order`.id ");
				$x = 0;
				print "<center>";
				print "<table border=\"1\" >\n";
				print "<tr>\n<th>
				id</th><th>Дата</th><th>
				id користувача</th><th>Ім'я користувача 
				</th><th>id товару</th><th> Назва товару
				</th>\n</tr>\n";
				while ($row = $result->fetch_assoc()) :
				print "<tr>\n";
				print "<td>" .$row["id"]. "</td>\n<td>
				".$row["date"]."</td>\n<td> <center>
				".$row["user_id"]."</center> </td>\n<td>
				" .$row["user_name"]. "</td>\n<td>
				" .$row["spare_id"]. " </td>\n<td>
				" .$row["spare_name"]. " </td>\n";
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
		<center><b>Зробити замовлення</b><br><br>		
		<form action="orderAdd.php" method="post">
			<input type="id" class="form-control" name=
			"id" id="id" placeholder="id id id">
			<button type="submit">Замовити</button>
		</form>
		</center>
		<?php
			else :
		?>
		<br>
		<center><b>Додати замовлення</b><br><br>
		<form action="orderAdminAdd.php" method="post">
			<input type="number" class="form-control" 
			name="user_id" id="user_id" placeholder=
			"id користувача">
			<input type="text" class="form-control" name=
			"id" id="id" placeholder="id id id товару">
			<button type="submit">Додати</button>
		</form>
		</center>
		<center><br><b>Додати частину до замовлення</b>
			<br><br>
		<form action="orderAdminAddPart.php" method=
		"post">
			<input type="number" class="form-control" 
			name="id" id="id" placeholder="id замовлення">
			<input type="text" class="form-control" 
			name="spare_id" id="spare_id" placeholder=
			"id id id товару">
			<button type="submit">Додати</button>
		</form>
		</center>
		<center><br><b>Видалити замовлення</b><br><br>
		<form action="orderAdminDel.php" method="post">
			<input type="number" class="form-control" 
			name="id" id="id" placeholder="id замовлення">
			<button type="submit">Видалити</button>
		</form>
		</center>
		<center><br><b>Видалити частину замовлення</b>
			<br><br>
		<form action="orderAdminDelPart.php" method=
		"post">
			<input type="number" class="form-control" 
			name="id" id="id" placeholder="id замовлення">
			<input type="text" class="form-control" 
			name="spare_id" id="spare_id" placeholder=
			"id id id товару">
			<button type="submit">Видалити</button>
		</form>
		</center>
		<center><br><b>Редагувати замовлення</b><br><br>
		<form action="orderAdminEdit.php" method="post">
			<input type="number" class="form-control"
			name="id" id="id" placeholder="id замовлення">
			<input type="number" class="form-control" 
			name="user_id" id="user_id" placeholder=
			"id користувача">
			<button type="submit">Зберегти зміни</button>
		</form>
		</center>
		<?php endif;?>
	</div>
</body>
</html>