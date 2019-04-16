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
					<h1>Product Management</h1>
					<form action="create-product.php" method="post">
					<table>
						<thead>
							<th>Name</th>
							<th>Price</th>
							<th>Weight</th>
							<th>Quantity</th>
							<th colspan="2">Tasks</th>
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
								<td><a href="edit.php?id=<?php echo $row['id']; ?>">Edit</a></td>
								<td><a href="delete-product.php?id=<?php echo $row['id']; ?>">Delete</a></td>
							</tr>
							<?php
								}
							?>
							<tr>
								<th colspan="6">
									Add new Product
								</th>
							</tr>
							<tr>
								<td><input type="text" name="name" placeholder="Product Name"></td>
								<td><input type="text" name="price" placeholder="Product Price"></td>
								<td><input type="text" name="weight" placeholder="Product Weight"></td>
								<td><input type="text" name="quantity" placeholder="Product Quantity"></td>
								<td colspan="2"><input type="submit" name="submit" value="Add"></td>
							</tr>
						</tbody>
					</table>
					</form>
				</div>
			</div>
			<!-- <div class="slider"></div> -->
		</div>
	</div>
</body>
</html>