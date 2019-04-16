<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" href="style.css">
</head>
<?php
	
	session_start();
	if(!(isset($_SESSION['user']))) {
		header("Location: index.html");
	}
	$user = $_SESSION['user'];
	if($user != 'admin'){
		header("Location: main.php");
	}
?>
<body>
	<div class="container">
		<div class="tutorial">
			<div class="menu">
				<ul>
					<a href="admin.php"><li>Home</li></a>
					<a href="history.php"><li>History</li></a>
					<a href="logout.php"><li class="right">Logout</li></a>
				</ul>
			</div>
			<div class="information">
			</div>
			<div class="table">
				<div class="information">
					<h1>Buying History</h1>
					<table>
						<thead>
							<th>User</th>
							<th>Name</th>
							<th>Price</th>
							<th>Weight</th>
							<th>Quantity</th>
						</thead>
						<tbody>
							<?php
								require_once __DIR__ . '/db_connect.php';

								$result = mysqli_query($db,"SELECT user, name, price, weight, h.quantity as quantity FROM history h, product p, login l WHERE h.product_id = p.id AND h.user_id = l.id");
								while ($row = mysqli_fetch_array($result)) {
							?>
							<tr>
								<td><?php echo $row['user']; ?></td>
								<td><?php echo $row['name']; ?></td>
								<td><?php echo $row['price']; ?></td>
								<td><?php echo $row['weight']; ?></td>
								<td><?php echo $row['quantity']; ?></td>
							</tr>
							<?php
								}
							?>
						</tbody>
					</table>
				</div>
			</div>
			<!-- <div class="slider"></div> -->
		</div>
	</div>
</body>
</html>