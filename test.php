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
        	padding: 40px; 
        }
        .wrapper h2 {text-align: center}
        .wrapper form .form-group span {color: blue;}
        .cont{
	border:1px solid black;
	box-shadow: 0px 1px 2px 1px;
	margin-top:20px;
	width:80vw;
	margin:auto;
	margin-top:7vh;
	background:white;
}
body{
	background:#b2d4d9;
}
        
	</style>
</head>
<body>
    
	<main>
		<section class="container wrapper cont">
			<div class="page-header">
				<h4 class="display-5">Welcome home admin <h3><?php echo $_SESSION['adminname']; ?></h3></h4>
			</div>

			<a href="adminpassreset.php" class="btn btn-block btn-outline-danger">Reset Password</a>

			<a href="register.php" class="btn btn-block btn-outline-danger">ADD USER</a>
			<a href="adminsignup.php" class="btn btn-block btn-outline-danger">ADD ADMIN</a>
			<a href="filter.php" class="btn btn-block btn-outline-danger">Manage Entry</a>
			<a href="newadmin.php" class="btn btn-block btn-outline-danger">Manage Project</a>
			<a href="index2.php" class="btn btn-block btn-outline-danger">Query/Chatbox</a>
			<a href="adminpassreset.php" class="btn btn-block btn-outline-danger">Reset Password</a>
			<a href="adminlogout.php" class="btn btn-block btn-outline-danger">Sign Out</a>


		</section>
	</main>

</body>
</html>
