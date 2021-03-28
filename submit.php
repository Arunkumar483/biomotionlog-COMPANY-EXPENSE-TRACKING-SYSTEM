<?php
	// Initialize session
	session_start();

	if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] !== false) {
		header('location: index.php');
		exit;
	}
	$a=$_SESSION['username'];
	
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
                        <h2>Expenses / Advances Entry Form</h2>
                    </div>
                    <p>Please fill this form and submit to add EXP/ADV record to the database.</p>
                    <form action="insert.php" method="post">
                        <div class="form-group">
                            <label>Project id</label>
                            <input type="number" name="pid" class="form-control">
                        </div>
                        <div class="form-group" >
                            <label>TYPE</label>
                            <br>
                            <select name="type" id="type"  style="width:70vw;">
                                <option value="Project Expense">Project Expense</option>
                                <option value="Project Advance">Project Advance</option>
                                <option value="Tour Expense">Tour Expense</option>
                                <option value="Tour Advance">Tour Advance</option></option>
                                                    
                            </select>
                        </div>
                        <div class="form-group" >
                            <label>ENTRY TYPE</label>
                            <br>
                            <select name="entrytype" id="entrytype"  style="width:70vw;">
                                <option value="Travel">Travel</option>
                                <option value="Installation">Installation</option>
                                <option value="Food">Food</option>
                                <option value="Loading/Unloading">Loading/Unloading</option>
                                <option value="Cleaning">Cleaning</option>
                                <option value="Other Expense">Other Expense</option></option>
                                                    
                            </select>
                        </div>
                        <div class="form-group">
                            <label>AMOUNT</label>
                            <input type="number" name="amount" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>DESCRIPTION</label>
                            <input type="text" name="description" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>USER</label>
                            <input type="text" name="user" class="form-control" value="<?php echo htmlspecialchars($a);?>" />
                               
                            
                        </div>
                        <input type="submit" class="btn btn-primary" name="submit" value="Submit">
                        <hr><a href="welcome.php">
                        <button class="btn btn-success" id="button2">GO TO DASHBOARD</button></a>
                    </form>
                    <br/>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>


