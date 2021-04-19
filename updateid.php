<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.php');
	exit;
}	$a=$_SESSION['adminname'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootswatch/4.5.2/lux/bootstrap.min.css" integrity="sha384-9+PGKSqjRdkeAU7Eu4nkJU8RFaH8ace8HGXnkiKMP9I9Te0GJ4/km3L1Z8tXigpG" crossorigin="anonymous">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
            text-align:center;
        }
        body{
  background:#80ccff;
}
        .cont{
    border:1px solid black;
    box-shadow: 0px 1px 2px 1px;
    margin-top:20px;
    width:80vw;
    background:white;
     }
       
    </style>
</head>
<body>
    <div class="wrapper cont">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>TRANSACTION ID ENTRY FORM</h2>
                    </div>
                    <form action="insertid.php" method="post">
                        <div class="form-group">
                            <label>ENTRY ID</label>
                            <input type="number" name="entry_id" class="form-control">
                        </div>
                        
                        <div class="form-group">
                            <label>TRANSACTION ID</label>
                            <input type="text" name="trans_id" class="form-control">
                        </div>
                        
                        <input type="submit" class="btn btn-primary" name="submit" value="Submit">
                        <hr>
                        <button><a href="test.php">Go to ADMIN Dashboard<br><br>
                       </button><br><br>
                    </form>
                    <br/>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>


