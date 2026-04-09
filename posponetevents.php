<!DOCTYPE html>
<html lang="en">
 <style>

       
		
  .form-group input[type="checkbox"] {
    margin-left:25px;
}
.btn .btn-danger:hover
{
	background:lightgoldenrodyellow;
}
#label11
{
font-size:25px;
font-weight:500;
	
}
#songname
{
	font-size:22px;
	font-weight:500;
}




/* === BASE HEADING === */ 

h1 {
  position: relative;
  padding: 0;
  margin: 0;
  font-family: "Raleway", sans-serif;
  font-weight: 300;
  font-size: 40px;
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




/* Style 7
   ----------------------------- */
.seven h1 {
text-align: center;
    font-size:30px; 
	font-weight:600; 
	color:deeppink; 
	letter-spacing:1px;
    text-transform: uppercase;
    display: grid;
    grid-template-columns: 1fr max-content 1fr;
    grid-template-rows: 27px 0;
    grid-gap: 20px;
    align-items: center;
}

.seven h1:after,.seven h1:before {
    content: " ";
    display: block;
    border-bottom: 1px solid #c50000;
    border-top: 1px solid #c50000;
    height: 5px;
  background-color:#f8f8f8;
}

.buttonadd
{
	  width:80px;
    border: none;
    border-radius: 8px;
    background: #33cc33;
    color: white;
	margin: 0 43px;


}

.buttonadd:hover
{
	width:80px;
    border: none;
    border-radius: 8px;
    background:green;
    color: white;
	margin: 0 43px;


}

    </style>
<body>
<form action="addsonginsert.php" method="post" autocomplete="off">
        <?php
             require("./connect.php");
			$id=$_REQUEST['id'];
            $query = $con->query("select * from `daily_event` where id='$id'");
			//$time=$eventdata['time'];
			
        ?>
		    <input type="hidden" id="conceptid" name="conceptid" value="<?php echo $id;?>">

        <div class="container">
            <div  class="card card-pink">
              <div class="card-header">
                <h3 class="card-title"><font size="5"><b>EVENT POSPONET  </b></font></h3>
				<a onclick="return_back()" style="float:right;margin-top:-5px;background:lightyellow;color:black" data-toggle="modal" class="btn btn-danger"></i>Back</a>
            </div>
	<div style="margin:0 21px;">
    <p id="detailsname" style="font-size:20px;">Date: <span id="meeting-date">[Meeting Date]</span></p><br>
    <p style="font-size:20px;">Time: <span id="meeting-time">[Meeting Time]</span></p><br>
    <p style="font-size:20px;">Title: <span id="meeting-title">[Meeting Title]</span></p><br>
	<p style="font-size:20px;">Organizer: <span id="meeting-organizer">[Meeting organizer]</span></p><br>
	<p style="font-size:20px;">Amount: <span id="meeting-amount">[Meeting amount]</span></p><br>
	<p style="font-size:20px;">Songs: <span id="meeting-songs">[Meeting songs]</span></p><br>
	<p style="font-size:20px;">Description: <span id="meeting-description">[Meeting description]</span></p><br>
	 <label for="time" id="labelllll" style="display:none;color:red;font-size:red;font-weight:600;">You Can't Modify This</label>
    <h4 id="changeDateHeader" style="color:goldenrod;font-weight:600;">Change Date Here <img src="/neha/assets/downnn.png" style="height:30px;width:30px;"></h4><br>
       <div style="display:flex;">
	   <div class="form-group">
                <label for="date" id="datelavel">Date:</label>
                <input type="date" id="date" name="date">
            </div>

            <div class="form-group" style="margin-left:7vh;">
                <label for="time" id="timelavel">Time:</label>
                <input type="time" id="time" name="time">
            </div>
   </div>
     <button id="posponedButton" type="submit"  onclick="posponeddfun();">Posponed</button>
       <br>
        </div>
		</div>
 </div>
    </form>

    <script>
     <?php $index = $query->fetch(PDO::FETCH_ASSOC);
if($index!='')
{
	echo "var meetingDate = '" . $index['date'] . "';";
    echo "var meetingTime = '" . date('H:i', strtotime($index['time'])) . "';";
    echo "var meetingTitle = '" . $index['title'] . "';";
    echo "var meetingOrganizer = '" . $index['organizer'] . "';";
    echo "var meetingAmount = '" . $index['amount'] . "';";
    echo "var meetingSongs = '" . $index['songs'] . "';";
    echo "var meetingDescription = '" . $index['description'] . "';";

 ?>
 
    // Example: Update meeting details dynamically (replace this with your actual logic)
    document.getElementById('meeting-date').textContent = '<?php echo $index['date']?>';
    document.getElementById('meeting-time').textContent = '<?php echo date('H:i', strtotime($index['time']))?>';
    document.getElementById('meeting-title').textContent = '<?php echo $index['title']?>';
    document.getElementById('meeting-organizer').textContent = '<?php echo $index['organizer']?>';
    document.getElementById('meeting-amount').textContent = '<?php echo $index['amount']?>';
    document.getElementById('meeting-songs').textContent = '<?php echo $index['songs']?>';
    document.getElementById('meeting-description').textContent = '<?php echo $index['description']?>';
         // Check if date and time are in the past
        var currentDate = new Date().toISOString().split('T')[0];
        var currentTime = new Date().toTimeString().split(' ')[0];
        var originalDateTime = meetingDate + ' ' + meetingTime;

        if (meetingDate < currentDate) {
            document.getElementById('changeDateHeader').style.display = 'none';
            document.getElementById('date').style.display = 'none';
            document.getElementById('time').style.display = 'none';
			 document.getElementById('datelavel').style.display = 'none';
			  document.getElementById('timelavel').style.display = 'none';
            document.getElementById('posponedButton').style.display = 'none';
			 document.getElementById('labelllll').style.display = 'block';
        }
		
<?php
}
?>
</script>
<script src="path/to/jquery.min.js"></script>
<script>
       function return_back()
	   {
        var rightcontent=$("#rightcontent").hide();

		   $.ajax({
            type:"GET",
            url:"/rythm/professional_singer/calendar/calendar_form.php",
             success:function(data){
		        // $("#main_content").html(data);
                $("#centerconteid").css("marginLeft", "450px");
                $("#centerconteid").html(data);
              }
             })
	   }
function posponeddfun() {
	debugger;
    var conceptid = $('#conceptid').val();
    var date = $('#date').val();
    var time = $('#time').val();

    
   $.ajax({
        type:"POST",
        url:'/rythm/datetimechange.php',
        data: {
            conceptid: conceptid,
            date: date,
            time: time,
            originalDate: meetingDate, // Pass the original values to the server
            originalTime: meetingTime,
            originalTitle: meetingTitle,
            originalOrganizer: meetingOrganizer,
            originalAmount: meetingAmount,
            originalSongs: meetingSongs,
            originalDescription: meetingDescription
        },
        success: function (data) {
			//console.warn("huhuhuhuhuhu:"+data);
           if(data==0)
			{
				alert('Postponed Events successful');
				 window.location.assign("/rythm/homee.php");
			}
			else if(data==1)
			{
				alert('Something went wrong');
				 window.location.assign("/rythm/homee.php");
			}
			else if(data==2)
			{
				alert('Cannot update to a past date and time');
				 window.location.assign("/rythm/homee.php");
			}
			else if(data==3)
			{
				alert('Please choose date and time!');
				 window.location.assign("/rythm/homee.php");
			}
           
        },
        
    });
}
	   
	
    </script>
</body>
</html>
