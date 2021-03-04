<?php
	// Initialize session
	session_start();

	if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] !== false) {
		header('location: adminlogin.php');
		exit;
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Welcome</title><link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootswatch/4.5.2/lux/bootstrap.min.css" integrity="sha384-9+PGKSqjRdkeAU7Eu4nkJU8RFaH8ace8HGXnkiKMP9I9Te0GJ4/km3L1Z8tXigpG" crossorigin="anonymous">
	<style>
        .wrapper{ 
        	width: 500px; 
        	padding: 100px; 
        }
        .wrapper h2 {text-align: center}
        .wrapper form .form-group span {color: blue;}
        
	</style>
</head>
<body>
    
	<main>
		<section class="container wrapper">
			<div class="page-header">
				<h4 class="display-5">Welcome home admin <h3><?php echo $_SESSION['adminname']; ?></h3></h4>
			</div>

			<a href="adminpassreset.php" class="btn btn-block btn-outline-warning">Reset Password</a>
			<a href="register.php" class="btn btn-block btn-outline-danger">ADD USER</a>
			<a href="adminlogout.php" class="btn btn-block btn-outline-danger">Sign Out</a>
			
		</section>
	</main>
	
</body>
</html>