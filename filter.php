<!DOCTYPE HTML>
<html> 
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Filters</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script type="text/javascript">
        $( function() {
            $( "#tdate" ).datepicker();
         } );
         $( function() {
            $( "#fdate" ).datepicker();
         } );
     </script>
</head> 
<body>
<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <table width=100% height="60" cellspacing="5" cellpadding="5" bgcolor="#000000">
            <tr>
                <td align="left">
                <table width="547" border="0" cellspacing="1" cellpadding="1" align="Left">
                    <td width="96"><font face="Verdana, Geneva, sans-serif" color="white"><h3>BioMotion Filter</h3></font></td>
                </table>
                </td>
        </table>
    </div>
</nav> 
<div class="container">
        <h3 style="text-align: center; font-weight: bold;">BioMotion</h3>
        <div class="row">
            <form class="form-horizontal" action="filter.php" method="POST">
                <div class="form-group">
                    <label class="col-lg-auto control-label">Project ID : </label>
                    <div class="col-lg-auto">
                        <input type="text" class="form-control" name="pid" placeholder="Enter Project ID..">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-auto control-label">User : </label>
                    <div class="col-lg-auto">
                        <input type="text" class="form-control" name="user" placeholder="Enter User..">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-auto control-label">Type : </label>
                    <div class="col-lg-auto">
                        <select name="type" class="form-control">
                            <option>Choose Type..</option>
                            <option value="Project Expense">Project Expense</option>
                            <option value="Project Advance">Project Advance</option>
                            <option value="Tour Advance">Tour Advance</option>
                            <option value="Tour Expense">Tour Expense</option>
                        </select>
                    </div>
                </div> 
                <div class="form-group">
                    <label class="col-lg-auto control-label">Entry Type : </label>
                    <div class="col-lg-auto">
                        <select name="entrytype" class="form-control">
                            <option>Choose Entry Type.. </option>
                            <option value="Food">Food</option>
                            <option value="Installation">Installation</option>
                            <option value="Loading/Unloading">Loading/Unloading</option>
                            <option value="Cleaning">Cleaning</option>
                            <option value="Travel">Travel</option>
                            <option value="Other Expenses">Other Expenses</option>
                        </select>
                    </div>
                </div>   
                <div class="form-group">
                    <label class="col-lg-auto control-label">From Date : </label>
                    <div class="col-lg-auto">
                       <input type="text" name="fdate" id="fdate" class="form-control">    
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-auto control-label">To Date : </label>
                    <div class="col-lg-auto">
                       <input type="text" name="tdate" id="tdate" class="form-control">    
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-lg-auto control-label"></label>
                    <div class="col-lg-auto">
                       <input type="submit" name="submit" class="btn btn-primary"> 
                       <button onClick="window.location.reload();" class="btn btn-primary">Display All Records</button>   
                    </div>
                </div>
            </form>
        </div>
        <div class="row">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Entry ID</th>
                        <th>Project ID</th>
                        <th>User</th>
                        <th>Type</th>
                        <th>Entry Type</th>
                        <th>Amount</th>
                        <th>Description</th>
                        <th>Date</th>
                    </tr>
                </thead>
            <tbody>
                <?php
                include("config/config.php");
                if(!isset($_POST['submit'])){
                    $query = "SELECT * FROM entry";
                    $data = mysqli_query($mysql_db, $query) or die('1 Error!');
                    if(mysqli_num_rows($data) > 0){
                        while($row = mysqli_fetch_assoc($data)){
                            $entry_id = $row['entry_id'];
                            $pid = $row['pid'];
                            $user = $row['user'];    
                            $ftype = $row['type'];    
                            $entrytype = $row['entrytype']; 
                            $amount = $row['amount'];
                            $description = $row['description'];        
                            $date = $row['date']; 
                        ?>
                        <tr>
                            <td><?php echo $entry_id;?></td>
                            <td><?php echo $pid;?></td>
                            <td><?php echo $user;?></td>
                            <td><?php echo $ftype;?></td>
                            <td><?php echo $entrytype;?></td>
                            <td><?php echo $amount;?></td>
                            <td><?php echo $description;?></td>
                            <td><?php echo $date;?></td>
                        </tr>
                        <?php                               
                        }
                    }
                    else{
                        ?>
                        <tr>
                            <td>Records Not Found!</td>
                        </tr>
                        <?php
                    }       
                }
                else{
                    $pid = $_POST['pid']; 
                    $user = $_POST['user'];    
                    $ftype = $_POST['type'];    
                    $entrytype = $_POST['entrytype'];        
                    $fdate = $_POST['fdate'];
                    $tdate = $_POST['tdate'];
                    $trdate = strtotime($tdate);
                    $trdate = date("Y-m-d", $trdate);
                    $frdate = strtotime($fdate);
                    $frdate = date("Y-m-d", $frdate);

                    if($pid != "" || $user != "" || $ftype != "" || $entrytype != "" || $frdate != "" || $trdate != ""){
                        $query = "SELECT * FROM entry WHERE pid = '$pid' OR user = '$user' OR entrytype = '$entrytype' OR type = '$ftype' OR (date >= '$frdate' AND date <= '$trdate')";
                        $data = mysqli_query($mysql_db, $query) or die('2 Error!');
                        if(mysqli_num_rows($data) > 0){
                            while($row = mysqli_fetch_assoc($data)){
                                $entry_id = $row['entry_id'];
                                $pid = $row['pid'];
                                $user = $row['user'];    
                                $ftype = $row['type'];    
                                $entrytype = $row['entrytype']; 
                                $amount = $row['amount'];
                                $description = $row['description'];        
                                $date = $row['date'];
                            ?>
                            <tr>
                                <td><?php echo $entry_id;?></td>
                                <td><?php echo $pid;?></td>
                                <td><?php echo $user;?></td>
                                <td><?php echo $ftype;?></td>
                                <td><?php echo $entrytype;?></td>
                                <td><?php echo $amount;?></td>
                                <td><?php echo $description;?></td>
                                <td><?php echo $date;?></td>
                            </tr>
                            <?php                               
                            }
                        }
                        else{
                            ?>
                            <tr>
                                <td>Records Not Found!</td>
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
</body>
</html>
