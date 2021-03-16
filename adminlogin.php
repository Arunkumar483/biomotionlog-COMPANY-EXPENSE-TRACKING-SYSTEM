<?php
  // Initialize sessions
    session_start();
  // Check if the user is already logged in, if yes then redirect him to welcome page
  if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: test.php");
    exit;
  }

  // Include config file
  require_once "config/config.php";

  // Define variables and initialize with empty values
  $adminname = $password = '';
  $adminname_err = $password_err = '';

  // Process submitted form data
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Check if adminname is empty
    if(empty(trim($_POST['adminname']))){
      $adminname_err = 'Please enter adminname.';
    } else{
      $adminname = trim($_POST['adminname']);
    }

    // Check if password is empty
    if(empty(trim($_POST['password']))){
      $password_err = 'Please enter your password.';
    } else{
      $password = trim($_POST['password']);
    }

    // Validate credentials
    if (empty($adminname_err) && empty($password_err)) {
      // Prepare a select statement
      $sql = 'SELECT adminid, adminname, password FROM admins WHERE adminname = ?';

      if ($stmt = $mysql_db->prepare($sql)) {

        // Set parmater
        $param_adminname = $adminname;

        // Bind param to statement
        $stmt->bind_param('s', $param_adminname);

        // Attempt to execute
        if ($stmt->execute()) {

          // Store result
          $stmt->store_result();

          // Check if adminname exists. Verify user exists then verify
          if ($stmt->num_rows == 1) {
            // Bind result into variables
            $stmt->bind_result($adminid, $adminname, $hashed_password);

            if ($stmt->fetch()) {
              if (password_verify($password, $hashed_password)) {

                // Start a new session
               if(!isset($_SESSION)){
  session_start();
}

                // Store data in sessions
                $_SESSION['loggedin'] = true;
                $_SESSION['adminid'] = $adminid;
                $_SESSION['adminname'] = $adminname;
               

                // Redirect to user to page
                header('location: test.php');
              } else {
                // Display an error for passord mismatch
                $password_err = 'Invalid password';
                 
              }
            }
          } else {
            $adminname_err = "adminname does not exists.";
            
          }
        } else {
          echo "Oops! Something went wrong please try again";
          
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
      width: 500px; 
      padding: 20px; 
    }
    .wrapper h2 {text-align: center}
    .wrapper form .form-group span {color: red;}
    .cont{
	border:1px solid black;
	box-shadow: 0px 1px 2px 1px;
	margin-top:20px;
	width:80vw;
	margin:auto;
	margin-top:7vh;
	background:white;
}
.butt{
    width:25vw;
}
body{
	background:#b2d4d9;
}
  </style>
</head>
<body>
  <main>
    <section class="container wrapper cont">
      <h2 class="display-4 pt-3"><strong>Admin Login</strong></h2><br>
          <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
            <div class="form-group <?php (!empty($adminname_err))?'has_error':'';?>">
              <label for="adminname"><b>adminname</b></label>
              <input type="text" name="adminname" id="adminname" class="form-control" value="<?php echo $adminname ?>">
              <span class="help-block"><?php echo $adminname_err;?></span>
            </div>

            <div class="form-group <?php (!empty($password_err))?'has_error':'';?>">
              <label for="password"><b>Password</b></label>
              <input type="password" name="password" id="password" class="form-control" value="<?php echo $password ?>">
              <span class="help-block"><?php echo $password_err;?></span>
            </div>

            <div class="form-group">
              <center><input type="submit" class="btn btn-outline-primary butt" value="login"></center>
            </div>
            <p>Go to <a href="index.php">Home</a>.</p>
          </form>
    </section>
  </main>
</body>
</html>
