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
	if(!(isset($_GET['id']))){
		header("Location: admin.php");
	}
	$id = $_GET['id'];

?>
<body>
	<div class="container">
		<div class="tutorial">
			<div class="menu">
				<ul>
					<a href="admin.php"><li>Home</li></a>
				</ul>
			</div>
			<div class="form">
				<div class="information">
					<h1>Product Detail Page</h1>
					<br>
					<hr>
					<br>
					<?php
						require_once __DIR__ . '/db_connect.php';

						$result = mysqli_query($db,"SELECT * FROM product WHERE id = $id");
						$row = mysqli_fetch_array($result);
					?>
					<form action="edit-product.php" method="post">
						<h2>Name</h2>
						<input type="text" value="<?php echo $row['name']; ?>" name="name">
						<h2>Price</h2>
						<input type="text" value="<?php echo $row['price']; ?>" name="price">
						<h2>Weight</h2>
						<input type="text" value="<?php echo $row['weight']; ?>" name="weight">
						<h2>Quantity</h2>
						<input type="number" value="<?php echo $row['quantity']; ?>" name="quantity">
						<input type="hidden" name="id" value="<?php echo $id; ?>">
						<input type="submit" value="submit">
					</form>
				</div>
			</div>
		</div>
	</div>
</body>
</html>