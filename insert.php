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
        }
        .html,.body {
    border:black;
    height: 40%;
    
}.button2 {background-color: black;}

html {
    display: table;
    margin: auto;
}

body {
    display: table-cell;
    vertical-align: middle;
}
    .cont{
    border:1px solid black;
    box-shadow: 0px 1px 2px 1px;
    margin-top:20px;
    width:80vw;
    margin:auto;
    margin-top:20px;
        background:white;
        text-align:center;
    }
    body{
        background:#80ccff;
    }
    </style>
</head>
<body>
<?php
include_once 'config/config.php';
if(isset($_POST['submit']))
{    
     $pid = $_POST['pid'];
     $type = $_POST['type'];
     $amount = $_POST['amount'];
     $description = $_POST['description'];
     $entrytype = $_POST['entrytype'];
     $user = $_POST['user'];
     $insert= mysqli_query($mysql_db,"INSERT INTO `entry` (`pid`,`user`,`type`,`amount`,`description`,`entrytype`)
     VALUES ('$pid','$user','$type','$amount','$description','$entrytype')");
     if(!$insert)
    {
        echo mysqli_error();
    }
    else
    {   echo "<br>";
        echo "<br>";
        echo "<h3><strong><center>Records added successfully.</center></strong></h3>";
    }
     mysqli_close($mysql_db);
}
?>
<body> <div class="cont"><br><br>
<h5>Have another record? <br><br><a href="submit.php"><br><button class="btn btn-primary"  id="button1">ADD NEXT ENTRY</button></a></h5>
<br><br>
<h5>Filled all entries?<a href="welcome.php"><br><br>
<button class="btn btn-success" id="button2">GO TO DASHBOARD</button></a></h5><br><br>
<h5>Filled all entries?<a href="logout.php"><br><br><br>
<button class="btn btn-danger" id="button3">LOG OUT</button></a></h5><br><br></div>

</html>
