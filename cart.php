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

?>
<body>
	<div class="container">
		<div class="tutorial">
			<div class="menu">
				<ul>
					<a href="main.php"><li>Home</li></a>
					<a href="cart.php"><li>Cart</li></a>
					<a href="order-history.php"><li>Order History</li></a>
					<a href="logout.php"><li class="right">Logout</li></a>
				</ul>
			</div>
			<div class="information">
			</div>
			<div class="table">
				<div class="information">
					<h1>My Products</h1>
					<table>
						<thead>
							<th>Name</th>
							<th>Price</th>
							<th>Weight</th>
							<th>Quantity Avail</th>
							<th>Quantity Select</th>
							<th colspan="2">Tasks</th>
						</thead>
						<tbody>
							<?php
								require_once __DIR__ . '/db_connect.php';
								$res = mysqli_query($db,"SELECT * FROM login WHERE user = '$user'");
								$r = mysqli_fetch_array($res);

								$result = mysqli_query($db,"SELECT c.id as id, name, price, weight, p.quantity as avail, c.quantity as sel FROM cart c, product p WHERE user_id = $r[id] AND c.product_id = p.id");
								while ($row = mysqli_fetch_array($result)) {
							?>
							<tr>
								<td><?php echo $row['name']; ?></td>
								<td><?php echo $row['price']; ?></td>
								<td><?php echo $row['weight']; ?></td>
								<td><?php echo $row['avail']; ?></td>
								<td><?php echo $row['sel']; ?></td>
								<td><form action="buy-product.php" method="post"><input type="hidden" name="id" value="<?php echo $row['id']; ?>"> <input type="submit" value="Buy"></form></td>
								<td><a href="delete-cart.php?id=<?php echo $row['id']; ?>"><input type="submit" value="Remove"></td>
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