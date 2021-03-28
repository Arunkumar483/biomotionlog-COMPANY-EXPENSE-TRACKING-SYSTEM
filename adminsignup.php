<?php
session_start();
 
// Check if the user is logged in, if not then redirect to login page
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true){
    header('location: test.php');
    exit;
}?>


<?php
	// Include config file
	require_once 'config/config.php';


	// Define variables and initialize with empty values
	$adminname = $password = $confirm_password = "";

	$adminname_err = $password_err = $confirm_password_err = "";

	// Process submitted form data
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {

		// Check if adminname is empty
		if (empty(trim($_POST['adminname']))) {
			$adminname_err = "Please enter a adminname.";

			// Check if adminname already exist
		} else {

			// Prepare a select statement
			$sql = 'SELECT adminid FROM admins WHERE adminname = ?';

			if ($stmt = $mysql_db->prepare($sql)) {
				// Set parmater
				$param_adminname = trim($_POST['adminname']);

				// Bind param variable to prepares statement
				$stmt->bind_param('s', $param_adminname);

				// Attempt to execute statement
				if ($stmt->execute()) {
					
					// Store executed result
					$stmt->store_result();

					if ($stmt->num_rows == 1) {
						$adminname_err = 'This adminname is already taken.';
					} else {
						$adminname = trim($_POST['adminname']);
					}
				} else {
					echo "Oops! ${$adminname}, something went wrong. Please try again later.";
				}

				// Close statement
				$stmt->close();
			} else {

				// Close db connction
				$mysql_db->close();
			}
		}

		// Validate password
	    if(empty(trim($_POST["password"]))){
	        $password_err = "Please enter a password.";     
	    } elseif(strlen(trim($_POST["password"])) < 6){
	        $password_err = "Password must have atleast 6 characters.";
	    } else{
	        $password = trim($_POST["password"]);
	    }
    
	    // Validate confirm password
	    if(empty(trim($_POST["confirm_password"]))){
	        $confirm_password_err = "Please confirm password.";     
	    } else{
	        $confirm_password = trim($_POST["confirm_password"]);
	        if(empty($password_err) && ($password != $confirm_password)){
	            $confirm_password_err = "Password did not match.";
	        }
	    }

	    // Check input error before inserting into database

	    if (empty($adminname_err) && empty($password_err) && empty($confirm_err)) {

	    	// Prepare insert statement
			$sql = 'INSERT INTO admins (adminname, password) VALUES (?,?)';

			if ($stmt = $mysql_db->prepare($sql)) {

				// Set parmater
				$param_adminname = $adminname;
				$param_password = password_hash($password, PASSWORD_DEFAULT); // Created a password

				// Bind param variable to prepares statement
				$stmt->bind_param('ss', $param_adminname, $param_password);

				// Attempt to execute
				if ($stmt->execute()) {
					// Redirect to login page
					header('location: ./test.php');
					// echo "Will  redirect to login page";
				} else {
					echo "Something went wrong. Try signing in again.";
				}

				// Close statement
				$stmt->close();	
			}

			// Close connection
			$mysql_db->close();
	    }
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	 <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=0.8">
	<title>Sign in</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootswatch/4.5.2/lux/bootstrap.min.css" integrity="sha384-9+PGKSqjRdkeAU7Eu4nkJU8RFaH8ace8HGXnkiKMP9I9Te0GJ4/km3L1Z8tXigpG" crossorigin="anonymous"><style>
       .cont{
	border:1px solid black;
	box-shadow: 0px 1px 2px 1px;
	margin-top:20px;
	width:75vw;
	background:white;
}
body{
	background:#b2d4d9;
}
        .wrapper{ 
        	width: 500px; 
        	padding: 20px; 
        }
        .wrapper h2 {text-align: center}
        .wrapper form .form-group span {color: red;}

	</style>
</head>
<body>
	<main>
		<section class="container wrapper cont ">
			<h2 class="display-4 pt-3">ADD ADMIN</h2>
        	<p class="text-center">Please fill in new Admin's  credentials.</p>
        	<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
        		<div class="form-group <?php (!empty($adminname_err))?'has_error':'';?>">
        			<label for="adminname">Admin Name</label>
        			<input type="text" name="adminname" id="adminname" class="form-control" value="<?php echo $adminname ?>">
        			<span class="help-block"><?php echo $adminname_err;?></span>
        		</div>

        		<div class="form-group <?php (!empty($password_err))?'has_error':'';?>">
        			<label for="password">Password</label>
        			<input type="password" name="password" id="password" class="form-control" value="<?php echo $password ?>">
        			<span class="help-block"><?php echo $password_err; ?></span>
        		</div>

        		<div class="form-group <?php (!empty($confirm_password_err))?'has_error':'';?>">
        			<label for="confirm_password">Confirm Password</label>
        			<input type="password" name="confirm_password" id="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
        			<span class="help-block"><?php echo $confirm_password_err;?></span>
        		</div>

        		<div class="form-group">
        			<input type="submit" class="btn btn-block btn-outline-success" value="Submit">
        			<input type="reset" class="btn btn-block btn-outline-primary" value="Reset">
        			<hr>
        			<a href="test.php" class="btn btn-block btn-outline-primary">GO TO ADMIN DASHBOARD</a>
        		</div>
        		
        	</form>
		</section>
	</main>
</body>
</html>
