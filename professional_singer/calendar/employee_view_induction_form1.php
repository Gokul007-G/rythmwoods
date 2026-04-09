<?php
require '../config.php';
require '../user.php';
$id = $_SESSION["candidateid"];
$fullname=$_SESSION['fullname'];
//$cid = $_REQUEST["idd"];
// $sql=$con->query("select * from staff_master where candid_id='$id'");
	// $staff=$sql->fetch();
	// $staff1=$staff['id'];
	// $sql1=$con->query("SELECT GROUP_CONCAT(description SEPARATOR '') as description FROM events");
// $infet=$sql1->fetch();
// $induction=$infet['description'];

//echo$induction;


//$exp=rtrim($induction, ",");
//echo $exp;
//print_r (explode(" ",$exp));
//$ex_value=(explode (",", $exp)); 

//print_r ($ex_value);


//exit;
?>
   <div class="card card-info">
              <div class="card-header">
                
				              <center><h3 class="card-title"><b>Meeting</b></h3></center>
	<!--	<a onclick="return back()" style="float: right;" data-toggle="modal" class="btn btn-danger"></i>Back</a>-->
              </div>
			
<table class="dataTables-example table table-striped table-bordered table-hover"  id="example1">
   <thead>
	 <tr>
	   <th>Meeting List</th>
	 </tr>
  </thead>
<?php
$sql2=$con->query("SELECT candid_id,emp_name from staff_master where candid_id='$id'");
$infetz=$sql2->fetch();
$inductionz=$infetz['candid_id'];
$inductionzs = str_replace(' ', '', $inductionz);
$fullnames = str_replace(' ', '', $id);

if($inductionzs==$fullnames)
{
$stmt = $con->query("SELECT * FROM events where find_in_set('$id',description) > 0;"); 
//echo "SELECT * FROM events where find_in_set('$id',description) > 0;";
while ($row = $stmt->fetch()) { ?>
	<tr>
	 <td style="word-break: break-all;">Meeting Name : <?php echo $row['title']; ?>&nbsp;&nbsp; Date : <?php echo $row['start_date']; ?>&nbsp;&nbsp; Time : <?php echo $row['time']; ?></td>
	</tr>
<?php } ?>

        <!-- /.post -->
    </div>
	<?php
}else{
?>
    <tr> 
	<td><?php echo "No Meeting"; ?></td>
	</tr>

<?php	
}
?>

</table> 