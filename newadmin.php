<?php
	// Initialize session
	session_start();

	if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] !== false) {
		header('location: test.php');
		exit;
	}

?>
<?php
	if(!empty($_POST["submit"])) {
		include_once("config/config.php");
		$memcount = count($_POST["member"]);
		$memval=0;
		$query = "INSERT INTO test1 (pid, pname, member) VALUES ";
		$queryval = "";
		for($i=0;$i<$memcount;$i++){
			if(!empty($_POST["member"][$i])){
				$memval++;
				if($queryval!="") {
					$queryval .= ",";
				}
				$queryval .= "('" . $_POST["pid"] . "', '" . $_POST["pname"] . "', '" . $_POST["member"][$i] . "')";
			}
		}
		$sql = $query.$queryval;
		$mysql_db->query($sql);
	}
?>
<?php
	if(!empty($_POST["delete"])){
		include_once("config/config.php");
		$sql = "DELETE FROM test1 WHERE pid='" . $_POST["pid"] . "'";
		mysqli_query($mysql_db, $sql);
	}
?>
</script>
<!DOCTYPE html>
<html>
<head>
<title>Admin Manage Entry</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="/resources/demos/style.css">
	<script>
        function addMore_textBox() {
	        $("<div>").load("searchinput.php", function() {
			    $("#test1").append($(this).html());
	        });
        }
        function deleteRow_box() {
	        $('div.test1-member').each(function(index, member){
		        jQuery(':checkbox', this).each(function () {
                    if ($(this).is(':checked')) {
				        $(member).remove();
                    }
                });
	        });
        }
    </script>
</head>
<body>
<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <table width=100% height="60" cellspacing="5" cellpadding="5" bgcolor="#000000">
            <tr>
            	<td align="center"><font face="Verdana" color="white"><h3>Manage Projects</h3></font></td>
        </table>
    </div>
</nav> 
<div class="container" align="center">
        <div class="row">
		
            <form class="form-horizontal" action="newadmin.php" method="POST">
            <div class="float-left">&nbsp;</div>
            <div class="float-left">&nbsp;</div>
			<div class="form-group">
				<label class="col-lg-auto control-label">Project ID </label>
				&nbsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
				<div class="col-lg-auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input size=75 type="text" name="pid" /></div>
				<div class="float-left">&nbsp;</div>
				<label class="col-lg-auto control-label">Project Name </label>
				&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
				<div class="col-lg-auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input size=75 type="text" name="pname" /></div>
				<div class="float-left">&nbsp;</div>
				<label class="col-lg-auto control-label">Members </label>
				&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
				<input type="button" name="add_item" value="+" onClick="addMore_textBox();" class="btn btn-success btn-xs" />
				<input type="button" name="del_item" value="x" onClick="deleteRow_box();" class="btn btn-danger btn-xs"/>
				<div id="test1"><?php require_once("searchinput.php") ?></div>
			</div>
			<div class="form-group">				
				<input type="submit" name="submit" value="Upload" class="btn btn-primary"/>
				<input type="submit" name="delete" value="Delete" onClick="return confirm('Do you want to delete the Record?')" class="btn btn-danger"/>
			</div>
	</div>
</form>
<div class="row">
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>Project ID</th>
                <th>Project Name</th>
                <th>Members</th>
            </tr>
        </thead>
    <tbody>
	<?php
		include_once("config/config.php");
			$query = "SELECT * FROM test1";
			$data = mysqli_query($mysql_db, $query) or die('Error!');
			if(mysqli_num_rows($data) > 0){
				while($row = mysqli_fetch_assoc($data)){
					$c = $row['count'];
					$pid = $row['pid'];    
					$pname = $row['pname'];    
					$member = $row['member']; 
					?>
				<tr>
					<td><?php echo $pid;?></td>
					<td><?php echo $pname;?></td>
					<td><?php echo $member;?></td>
				</tr>
				<?php                             
			}
		}
		else{
			?>
			<tr>
				<td colspan="3" align="center">No Records!</td>
			</tr>
			<?php
			}       
	?>
</div>
</body>
</html>
