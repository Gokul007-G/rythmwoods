<?php
require '../config.php';
include("../user.php");
$userrole = $_SESSION['userrole'];
?>



<div class="container-fluid">
    <div class="card mb-3">
        <div class="card-header">
            <i class="fa fa-table"></i> Assign Event
            
        </div>
        <form method="POST">
            <input type="hidden" name="userrole" id="userrole" value="<?php echo $userrole; ?>">
            <table class="table table-bordered">
                <tr>
                    
                <td colspan="5"><center><b>Bluebase Software Services Pvt Ltd</b></center></td>
                </tr>
                <tr>
                    <td>Event Name</td>
                    <td colspan="2"><input type="text" class="form-control" id="title" name="title" ></td>
                </tr>
<tr>

 <td>Staff Name</td>
 <td>
<select  class="form-control" id="staff_name" multiple name="staff_name[]" style="height: 100px;">
<option value="">Choose Staff</option>
<?php $stmt = $con->query("SELECT * FROM staff_master");
while ($row = $stmt->fetch()) {?>
<option value="<?php echo $row['candid_id']; ?>"> <?php echo $row['emp_name']; ?> </option>
<?php } ?>
</select>
</td>
</tr>
 <tr>
                    <td>Date Of The Event</td>
                    <td colspan="2"><input type="date" class="form-control" id="start_date" name="start_date" ></td>
                </tr>
				
				<tr>
                    <td>Re Enter The Same Date</td>
                    <td colspan="2"><input type="date" class="form-control" id="end_date" name="end_date" onchange="checkdate()"  required></td>
                </tr>
 <tr>
                    <td>Time Of The Event</td>
                    <td colspan="2"><input type="time" class="form-control" id="time" name="time" ></td>
                </tr>
               <!-- <tr>
                    <td>Status</td>
                    <td colspan="2">
                        <select class="form-control" name="status" id="status">
                            <option value="">Select Status</option>
                            <option value="1">Active</option>
                            <option value="0">InActive</option>
                        </select>
                    </td>
                </tr>-->
            </table>
           
			<input type="button" class="btn btn-success" name="save" onclick="insert_staff()" value="save">
        </form>
 <script>
      
    //   $("#staff_name").select2({
    //       placeholder: "Select Staff",
    //       allowClear: true,
    //       maximumSelectionLength: 5
    //   });
  
	 function insert_staff()
    {
    var id=0;
	//alert(id);
    var data = $('form').serialize();
	//alert(data);
    $.ajax({
    type:'GET',
    data:"id="+id, data,
    url:'calendar/calendar_submit.php',
	
    success:function(data)
    {  
      alert("Meeitng Fixed");
	  calendar_master()      
    }       
    });
    }
	
	function checkdate(){
		let datee = $('#start_date').val()
		let redate = $('#end_date').val()
		
		if(datee!=redate){
			alert('Kindly Re Enter the Same Date')
			$('#end_date').val('')			
		}
	}
	 </script>