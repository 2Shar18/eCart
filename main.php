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
				<h1>Welcome, <?php echo $user; ?></h1>
				<h2>This is your personalized products list Page!</h2>
			</div>
			<div class="table">
				<div class="information">
					<h1>All Products</h1>
					<table>
						<thead>
							<th>Name</th>
							<th>Price</th>
							<th>Weight</th>
							<th>Quantity</th>
							<th>Tasks</th>
						</thead>
						<tbody>
							<?php
								require_once __DIR__ . '/db_connect.php';

								$result = mysqli_query($db,"SELECT * FROM product");
								while ($row = mysqli_fetch_array($result)) {
							?>
							<tr>
								<td><?php echo $row['name']; ?></td>
								<td><?php echo $row['price']; ?></td>
								<td><?php echo $row['weight']; ?></td>
								<td><?php echo $row['quantity']; ?></td>
								<td><a href="detail.php?id=<?php echo $row['id'] ?>">View</a></td>
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