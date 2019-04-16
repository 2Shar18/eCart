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
	if(!(isset($_GET['id']))){
		header("Location: main.php");
	}
	$id = $_GET['id'];

?>
<body>
	<div class="container">
		<div class="tutorial">
			<div class="menu">
				<ul>
					<a href="main.php"><li>Home</li></a>
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
					<form action="add-cart.php" method="post">
					<h2>Name</h2>
					<input type="text" value="<?php echo $row['name']; ?>" disabled="true">
					<h2>Price</h2>
					<input type="text" value="<?php echo $row['price']; ?>" disabled="true">
					<h2>Weight</h2>
					<input type="text" value="<?php echo $row['weight']; ?>" disabled="true">
					<h2>Quantity</h2>
					<input type="number" value="<?php echo $row['quantity']; ?>" disabled="true">
					<h2>Selected Quantity</h2>
					<input type="hidden" name="pid" value="<?php echo $id; ?>">
					<input type="hidden" name="user" value="<?php echo $user; ?>">
					<input type="number" name="quantity">
					<input type="submit" value="submit">
					</form>
				</div>
			</div>
		</div>
	</div>
</body>
</html>