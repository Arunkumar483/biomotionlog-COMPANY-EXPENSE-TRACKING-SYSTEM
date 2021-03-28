<?php
	// Initialize session
	session_start();

	if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] !== false) {
		header('location: index.php');
		exit;
	}
	$a=$_SESSION['username'];

?>

<!DOCTYPE HTML>
<html> 
<head>
    <title>User Search</title>  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootswatch/4.5.2/lux/bootstrap.min.css" integrity="sha384-9+PGKSqjRdkeAU7Eu4nkJU8RFaH8ace8HGXnkiKMP9I9Te0GJ4/km3L1Z8tXigpG" crossorigin="anonymous">
	<style>
        .wrapper{ 
        	width: 500px; 
        	padding: 40px; 
        }
        .wrapper h2 {text-align: center}
        .wrapper form .form-group span {color: blue;}
        .di{
	text-align:center;
	font-size:25px;
}
.cont{
	border:1px solid black;
	box-shadow: 0px 1px 2px 1px;
	margin-top:20px;
	width:80vw;
	background:white;
}
body{
  background:#b2d4d9;
}
        
	</style>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="/resources/demos/style.css">
</head> 
<body><section class="container wrapper">
<div id="b1">
<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <table width=100% height="60" cellspacing="5" cellpadding="5" bgcolor="#000000">
            <tr>
            	<td align="center"><font face="Verdana" color="white"><h3>User Search Page</h3></font></td>
        </table>
    </div>
</nav> 
<div class="container">
        <div class="row">
            <form class="form-horizontal" action="search.php" method="POST">
            <div class="float-left">&nbsp;</div>
            <div class="float-left">&nbsp;</div>
                <div class="form-group">
                    <label class="col-lg-auto control-label">Enter Member Name : </label>
                    <div class="col-lg-auto">
                        <input type="text" class="form-control" name="member" value="<?php echo $_SESSION['username']; ?>">
                    </div>
                </div>  
                <div class="form-group">
                    <label class="col-lg-auto control-label"></label>
                    <div class="col-lg-auto" align="center">
                       <input type="submit" name="submit" value="Search" class="btn btn-primary">
                    </div>
                </div>
            </form>
        </div>
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
                include("config/config.php");
                if(!isset($_POST['submit'])){
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
                }
                else{
                    $member= $_POST['member'];

                    if($member != ""){
                        $query = "SELECT * FROM test1 WHERE member = '$member'";
                        $data = mysqli_query($mysql_db, $query) or die(' 2 Error!');
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
                    }
                }
                ?>
            </tbody>
            </table>
        </div>    
    </div>
</div><hr>
<a href="welcome.php" class="btn btn-block btn-outline-danger">GO TO USER DASHBOARD</a></section>
</body>
</html>
