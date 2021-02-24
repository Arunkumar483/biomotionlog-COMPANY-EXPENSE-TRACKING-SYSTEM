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
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Biomotion entries</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round|Open+Sans">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<style type="text/css">
.bs-example{
margin: 20px;
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
<div class="col-md-12">
<div class="page-header clearfix">
<h2 class="pull-left"><?php echo $a; ?>'s Entry List </h2>
</div>


<table class='table table-bordered table-striped'>
<tr>
<td>entry_id</td>
<td>pid</td>
<td>type</td>
<td>entrytype</td>
<td>amount</td>
<td>description</td>
<td>date</td>
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
<h5><a href="welcome.php"><br><br><br>
<button  id="button2">GO TO DASHBOARD</button></a></h5>
</div>
</div>        
</div>
</div>
</body>
</html>
