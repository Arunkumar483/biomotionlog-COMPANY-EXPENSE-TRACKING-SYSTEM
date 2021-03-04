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

		// Valadminidate password
	    if(empty(trim($_POST["password"]))){
	        $password_err = "Please enter a password.";     
	    } elseif(strlen(trim($_POST["password"])) < 6){
	        $password_err = "Password must have atleast 6 characters.";
	    } else{
	        $password = trim($_POST["password"]);
	    }
    
	    // Valadminidate confirm password
	    if(empty(trim($_POST["confirm_password"]))){
	        $confirm_password_err = "Please confirm password.";     
	    } else{
	        $confirm_password = trim($_POST["confirm_password"]);
	        if(empty($password_err) && ($password != $confirm_password)){
	            $confirm_password_err = "Password dadminid not match.";
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
					header('location: ./adminlogin.php');
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
	<meta charset="UTF-8">
	<title>Sign in</title>
	<link href="https://stackpath.bootstrapcdn.com/bootswatch/4.4.1/cosmo/bootstrap.min.css" rel="stylesheet" integrity="sha384-qdQEsAI45WFCO5QwXBelBe1rR9Nwiss4rGEqiszC+9olH1ScrLrMQr1KmDR964uZ" crossorigin="anonymous">
	<style>
        .wrapper{ 
        	wadminidth: 500px; 
        	padding: 20px; 
        }
        .wrapper h2 {text-align: center}
        .wrapper form .form-group span {color: red;}
	</style>
</head>
<body>
	<main>
		<section class="container wrapper">
			<h2 class="display-4 pt-3">ADD USER</h2>
        	<p class="text-center">Please fill in NEW USER'S  credentials.</p>
        	<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
        		<div class="form-group <?php (!empty($adminname_err))?'has_error':'';?>">
        			<label for="adminname">Admin name</label>
        			<input type="text" name="adminname" adminid="adminname" class="form-control" value="<?php echo $adminname ?>">
        			<span class="help-block"><?php echo $adminname_err;?></span>
        		</div>

        		<div class="form-group <?php (!empty($password_err))?'has_error':'';?>">
        			<label for="password">Password</label>
        			<input type="password" name="password" adminid="password" class="form-control" value="<?php echo $password ?>">
        			<span class="help-block"><?php echo $password_err; ?></span>
        		</div>

        		<div class="form-group <?php (!empty($confirm_password_err))?'has_error':'';?>">
        			<label for="confirm_password">Confirm Password</label>
        			<input type="password" name="confirm_password" adminid="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
        			<span class="help-block"><?php echo $confirm_password_err;?></span>
        		</div>

        		<div class="form-group">
        			<input type="submit" class="btn btn-block btn-outline-success" value="Submit">
        			<input type="reset" class="btn btn-block btn-outline-primary" value="Reset">
        		</div>
        		
        	</form>
		</section>
	</main>
</body>
</html>