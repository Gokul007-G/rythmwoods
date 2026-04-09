<?php

require("./connect.php");

$conceptid = $_GET['id'];

//echo $conceptid.'kokokoko';


?>
<!DOCTYPE html>
<html lang="en">
 <style>


   .card .card-pink {
      height: 100vh;
      overflow-x: auto;
      overflow-y: scroll; /* Add this line for vertical scrollbar */
    }
	#paymethod
	{
		width:24vh;
		margin-left	:30px;
		font-size:15px;
	}
	
	
	
h1 {
  position: relative;
  padding: 0;
  margin: 0;
  font-family: "Raleway", sans-serif;
  font-weight: 300;
  font-size: 20px;
  color: #080808;
  -webkit-transition: all 0.4s ease 0s;
  -o-transition: all 0.4s ease 0s;
  transition: all 0.4s ease 0s;
}

h1 span {
  display: block;
  font-size: 0.5em;
  line-height: 1.3;
}
h1 em {
  font-style: normal;
  font-weight: 600;
}

/* === HEADING STYLE #1 === */
.one h1 {
  text-align: center;
 
  padding-bottom: 5px;
}
.one h1:before {
  width:10vh;
  height:10px;
  display: block;
  content: "";
  position: absolute;
  bottom: 3px;
  left:48%;
  top:30px;
  margin-left: -14px;
  background-color: #b80000;
}
.one h1:after {
  width: 40vh;
  height: 1px;
  display: block;
  content: "";
  position: relative;
  margin-top:11px;
  left:42%;
  margin-left: -50px;
  background-color: #b80000;
}
	
	
	  button {
            background-color: #4caf50;
            color: #fff;
            border: none;
			padding:5px 15px;
            border-radius: 4px;
            cursor: pointer;
			width:10vh;
			height:6vh;
			font-size:20px;
			
        }

        button:hover {
            background-color: #45a049;
        }
		.btn .btn-danger:hover
		{
			background: white;
		}
	#labeliddd
	{
		font-size:20px;
		color:blue;
		
	}
	#dateee
	{
		width:20vh;
	}
    </style>
<body>
    <form action="" method="post" autocomplete="off">
        <?php
            //require("./connect.php");
            $query11 = $con->query("select * from `daily_event` where id='$conceptid'");
			//echo "select * from `daily_event` where id='$conceptid'";
			$row = $query11->fetch();
        ?>

        <div class="container">
            <div  class="card card-pink">
              <div class="card-header">
                <h3 class="card-title"><font size="5"><b>PAYMENT DETAILS </b></font></h3>
			   <a onclick="return_back()" style="float:right;background:lightyellow;color:black;" data-toggle="modal" class="btn btn-danger"></i>Back</a>

			 </div>
			 <br>
			  <div style="display:flex;justify-content:space-evenly;">
			  <input type="hidden" name="eventidd" id="eventidd" value="<?php echo $row['id'];?>">
				<label id="labeliddd">EVENT NAME: <span style="font-weight:500;color:black;"><?php echo ucfirst($row['title']);?></span></label>
				<label id="labeliddd">DATE: <span style="font-weight:500;color:black;"><?php echo $row['date'];?></span></label>
				<label id="labeliddd">TIME: <span style="font-weight:500;color:black;"><?php echo $row['time'];?></span></label>
				<label id="labeliddd">TOTAL AMOUNT: <span style="font-weight:500;color:black;"><img src="/rythm/assets/rupee-indian.png" alt="Postpone Icon" style="height:16px;width:16px;"><?php echo $row['amount'];?></span></label>
            </div>
			 <br>
		
		     <?php
			 $eventid=$row['id'];
			 $totalamount=$row['amount'];
			// $paidamount="";
			 $amtsql = $con->query("SELECT *,sum(amount) as totalopaidamt FROM `eventpayment` WHERE eventid IN ($eventid)");
			 if($amtsql)
			 {
			 if ($amtsql->rowCount() > 0) 
			 {
				while($data = $amtsql->fetch(PDO::FETCH_ASSOC))
				{
					if (!empty($data)) 
					{
						$paidamount=$data['amount'];
						$totalpaidamt=$data['totalopaidamt'];
						//$remainingamt=$totalamount+$totalpaidamt;
						
					}
				}
						
						//$totalpaidamt=
						//echo $totalpaidamt;
						if($totalpaidamt<$totalamount)
						{
							//echo "SELECT * FROM `eventpayment` WHERE eventid IN ($eventid)";	
							$pendingamt=$totalamount-$totalpaidamt;
						}
			 }
			 }
						 ?>
						 	 
			<div class="one">
           <h1>Payment Details</h1>
           </div>
		   <br>
		   <div style="display:flex;justify-content:space-evenly;">
		    <?php
			if($totalpaidamt!='')
			{ ?>
		   <label style="font-size:20px;font-weight:500;"><span style="color:green;font-weight:600">Recevied Amount</span>: <img src="/rythm/assets/rupee-indian.png" alt="Postpone Icon" style="height:16px;width:16px;"><?php echo $totalpaidamt; ?></label>
		   <br>
		  <?php 
		  } 
		  else
		  {
		  ?>
		   <label style="font-size:20px;font-weight:500;"><span style="color:green;font-weight:600">Recevied Amount</span>: <img src="/rythm/assets/rupee-indian.png" alt="Postpone Icon" style="height:16px;width:16px;"><?php echo 0; ?></label>
		   <br>
		  <?php 
		  }
		   ?>
		   <label style="font-size:20px;font-weight:500;"><span style="color:red;font-weight:600">Pending Amount</span>: <img src="/rythm/assets/rupee-indian.png" alt="Postpone Icon" style="height:16px;width:16px;"><?php echo $pendingamt; ?></label>
		   <br>
		   </div>
		     <br>
			  <?php 
        $i = 0;
        $amtsql1 = $con->query("SELECT *FROM `eventpayment` WHERE  eventid IN ($eventid)");
	 if($amtsql1)
	{
		
	  if ($amtsql1->rowCount() > 0) 
	   {
		 ?>
			 <table class="table table-striped">
    <thead>
        <tr>
            <th>Sno</th>
            <th>Event Name</th>
            <th>Date</th>
            <th>Received Amount</th>
            <th>Received Type</th>
        </tr>
    </thead>
    <tbody>
         <?php 
	//echo "SELECT *FROM `eventpayment` WHERE eventid IN ($eventid)";
	
		   
        while ($data2 = $amtsql1->fetch(PDO::FETCH_ASSOC)) {
            $i++;
			
			
        ?>
        <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $row['title']; ?></td> <!-- Use the correct variable for the event name -->
            <td><?php echo $data2['date']; ?></td>
            <td><?php echo $data2['amount']; ?></td>
            <td><?php 
                if ($data2['paymentmethod'] == 1) {
                    echo 'Cash'; 
                } else {
                    echo "Bank Transfer";
                }
            ?></td>
        </tr>
        <?php 
		 }
		
	
	
		?>
    </tbody>
</table>
			 
 <?php 
		 }
		 else
		 {
		 ?>
						   <label style="font-size:20px;font-weight:600;color:red;margin:0 auto;">Payment Not Found</label><br>
 
		 <?php
		 }
	}
	
		 else
		 {
		?>
				   <label style="font-size:20px;font-weight:600;color:red;margin:0 auto;">Payment Not Found</label><br>

		<?php 
		 }
		 
		?>
		
            </div>
        </div>
    </form>
	<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

	<script>



  function return_back()
	   {
		   $.ajax({
            type:"GET",
            url:"/rythm/professional_singer/calendar/calendar_form.php",
             success:function(data){
		        $("#main_content").html(data);
              }
             })
	   }
	   
</script>
	
	
	
	
	
	</body>
</html>
