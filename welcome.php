<?php
	// Initialize session
	session_start();

	if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] !== false) {
		header('location: index.php');
		echo "<h2>Hello we cannot recognize u kindly go to login page and login again<br></h2>";
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
        	width: 400px; 
        	padding: 50px; 
        }
        .wrapper h2 {text-align: center}
        .wrapper form .form-group span {color: blue;}
        .di{
	text-align:center;
	font-size:25px;
}
.cont{
	border:1px solid black;
	box-shadow: 0px 1px 2px 1px;
	margin-top:20px;
	width:80vw;
	background:white;
}body{
  background:#b2d4d9;
}
        
	</style>
</head>
<body>
    
	<main>
		<section class="container wrapper cont">
			<div class="di"><strong>User Dash Board</strong></div><hr>
			<div class="page-header">
				<h4 class="display-5">Welcome <h3><?php echo $_SESSION['username']; ?></h3></h4>
			</div>
			<a href="submit.php" class="btn btn-block btn-outline-danger">ADD DATA ENTRY</a>
			<a href="fetchdisplay.php" class="btn btn-block btn-outline-danger">VIEW MY ENTRIES</a>
			<a href="index2.php" class="btn btn-block btn-outline-danger">QUERY BOX</a>
			<a href="search.php" class="btn btn-block btn-outline-danger">REFER PROJECT DETAILS</a>
			<a href="password_reset.php" class="btn btn-block btn-outline-danger">Reset Password</a>
			<a href="logout.php" class="btn btn-block btn-outline-danger">Sign Out</a>	
			
			<br>
			<br>
			
		</section>
	</main>
	
</body>
</html>
