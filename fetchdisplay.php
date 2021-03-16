<?php
include_once 'config/config.php';


?>
<?php
	// Initialize session
	session_start();

	if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] !== false) {
		header('location: index.php');
		exit;
	}
	$a=$_SESSION['username'];
	$result = mysqli_query($mysql_db,"SELECT * FROM entry WHERE user='$a'");
?>

<?php
if (mysqli_num_rows($result) > 0) {
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Biomotion entries</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round|Open+Sans">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<style type="text/css">
.cont{
	border:2px solid black;
	box-shadow: 0px 1px 2px 1px;
	background:white;
}
body{
	background:#b2d4d9;
}
#button2{
    height:55px;
    width:250px;
}
</style>
<script type="text/javascript">
$(document).ready(function(){
$('[data-toggle="tooltip"]').tooltip();   
});
</script>
</head>
<body>
<div class="bs-example">
<div class="container">
<div class="row">
<div >
<div class="page-header clearfix">
<h2 class="pull-left"><center><?php echo $a; ?>'s Entry List </center></h2>
</div>

<table class='table table-bordered cont'>
<tr>
<th>entry_id</th>
<th>pid</th>
<th>type</th>
<th>entrytype</th>
<th>amount</th>
<th>description</th>
<th>date</th>
</tr>
<?php
$i=0;
while($row = mysqli_fetch_array($result)) {
?>
<tr>
<td><?php echo $row["entry_id"]; ?></td>
<td><?php echo $row["pid"]; ?></td>
<td><?php echo $row["type"]; ?></td>
<td><?php echo $row["entrytype"]; ?></td>
<td><?php echo $row["amount"]; ?></td>
<td><?php echo $row["description"]; ?></td>
<td><?php echo $row["date"]; ?></td>
</tr>
<?php
$i++;
}
?>
</table>
<?php
}
else{
echo "No result found";
}
?>
<h5><a href="welcome.php"><br>
<center><button  id="button2" class="btn btn-danger"><center>GO TO DASHBOARD</center></button></center></a></h5>
</div>
</div>        
</div>
</div>
</body>
</html>
