<?php
session_start();
require("./connect.php");
?>
<!DOCTYPE html>
<html lang="en">
 <style>

       
		
  .form-group  {
    margin-left:35px;
	    font-size: 18px;

}
.btn .btn-danger:hover
{
	background:lightgoldenrodyellow;
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

.updateee
{
	width:85px;
    border: none;
    border-radius: 8px;
    background: #33cc33;
    color: white;
	margin: 0 43px;


}

.updateee:hover
{
	width:85px;
    border: none;
    border-radius: 8px;
    background:green;
    color: white;
	margin: 0 43px;


}

    </style>
<body>


 <?php
           
		$id=$_REQUEST['id'];
$query = $con->query("select * from `daily_event` where id='$id'");
while ($index = $query->fetch(PDO::FETCH_ASSOC)) {

			
        ?>
        <form id="meetingForm"  method="POST" action="meetingupdatee.php?id=<?php echo $index['id']?>">
       
		 <input type="hidden" name="id" id="id" value="<?php echo $index['id']; ?>">

        <div class="container">
            <div  class="card card-pink">
              <div class="card-header">
                <h3 class="card-title"><font size="5"><b>EVENT UPDATE </b></font></h3>
				<a onclick="return_back()" style="float:right;margin-top:-5px;background:lightyellow;color:black" data-toggle="modal" class="btn btn-danger"></i>Back</a>
            </div> <br>
			
	 <div class="form-group">
                <label for="date">Date:</label>
                <input type="date" id="date" name="date" value="<?php echo $index['date']?>" style="width:92%">
            </div>
<br>
            <div class="form-group">
                <label for="time">Time:</label>
                 <input type="time" id="time" name="time" value="<?php echo date('H:i', strtotime($index['time'])); ?>" style="width:92%">
            </div>
<br>
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" id="title" name="title" value="<?php echo $index['title']?>" style="width:92%">
            </div>
			<br>
            <label for="description"><span style="margin:0 36px;">Description:</span></label>

            <div class="form-group">
                <textarea id="description" name="description" rows="4" style="width:98%"><?php echo $index['description']; ?></textarea>
            </div>
<br>
            <div class="form-group">
                <label for="organizer">Organizer:</label>
                <input type="text" id="organizer" name="organizer" value="<?php echo $index['organizer']?>" style="width:91%">
            </div>
<br>
            <div class="form-group">
                <label for="amount">Amount:</label>
                <input type="number" id="amount" name="amount" value="<?php echo $index['amount']?>" style="width:91.5%">
            </div>
<br>
            

            <button type="update" class="updateee">Update</button> <br> <br>
		</div>
 </div>
  <br> <br>
    </form>

  <?php
}
?> 
<script src="path/to/jquery.min.js"></script>
<script>
       function return_back()
	   {
      var rightcontent=$("#rightcontent").hide();

		   $.ajax({
            type:"GET",
            url:"/rythm/professional_singer/calendar/calendar_form.php",
             success:function(data){
              $("#centerconteid").css("marginLeft", "450px");
                $("#centerconteid").html(data);         
                   }
             })
	   }

    </script>
</body>
</html>
