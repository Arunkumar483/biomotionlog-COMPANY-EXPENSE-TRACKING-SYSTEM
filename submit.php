<!DOCTYPE html>
<html>
<head>
  <title>Add Records in Database</title>
</head>
<body>

<?php
 require_once "config/config.php"; // Using database connection file here

if(isset($_POST['submit']))
{		
    $pname = $_POST['pname'];
    $amount = $_POST['amount'];

    $insert = mysqli_query($mysql_db,"INSERT INTO `prexp`(`pname`, `amount`) VALUES ('$pname','$amount')");

    if(!$insert)
    {
        echo mysqli_error();
    }
    else
    {
        echo "Records added successfully.";
    }
}

mysqli_close($mysql_db); // Close connection
?>

<h3>Fill the Form</h3>

<form method="POST">
  pname : <input type="text" name="pname" placeholder="Enter pname" Required>
  <br/>
  amount : <input type="text" name="amount" placeholder="Enter amount" Required>
  <br/>
  <input type="submit" name="submit" value="Submit">
  <a href="logout.php" class="btn btn-block btn-outline-danger">Sign Out</a>
</form>

</body>
</html>

