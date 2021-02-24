<?php
	// Initialize session
	session_start();

	if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] !== false) {
		header('location: index.php');
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
				<h4 class="display-5">Welcome home <h3><?php echo $_SESSION['username']; ?></h3></h4>
			</div>

			<a href="password_reset.php" class="btn btn-block btn-outline-warning">Reset Password</a>
			<a href="submit.php" class="btn btn-block btn-outline-danger">ADD DATA ENTRY</a>
			<a href="logout.php" class="btn btn-block btn-outline-danger">Sign Out</a>
			<a href="query123.php" class="btn btn-block btn-outline-danger">Other queries</a>
			<a href="fetchdisplay.php" class="btn btn-block btn-outline-danger">VIEW MY ENTRIES</a>
		</section>
	</main>
	
</body>
</html>
