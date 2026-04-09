<?php
require '../../connect.php';
// include("../../user.php");

$id = $_REQUEST['id'];

$sql_query = $con->query("SELECT song_master.id AS song_id,
                song_master.title,
                song_master.description,
                song_master.movie_id,
                song_master.language_id,
                song_master.duration,
                song_master.file_location,
                song_master.english_lyrics_location,
                song_master.lyrics_location,

                (SELECT mov.movie_name
                  FROM movies AS mov
                  WHERE mov.id = song_master.movie_id) 
                  AS movie_name,

                (SELECT lng.language_name
                  FROM languages AS lng
                  WHERE lng.id = song_master.language_id)
                  AS language_name

                FROM song_master
                WHERE song_master.id = $id");
				
				
				


// $stmt->execute(); 
$row = $sql_query->fetch(PDO::FETCH_ASSOC);

//echo $row['title'];
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* Style for the card */
    .card {
        border: 1px solid #dee2e6; /* Add border */
        border-radius: .25rem; /* Add border radius */
        margin: 20px auto; /* Center the card horizontally */
        max-width: 800px; /* Limit maximum width */
    }

    /* Style for the card header */
    .card-header {
        background-color: deepPink; /* Pink background color */
        color: white; /* White text color */
        padding: 10px; /* Add some padding */
        display: flex; /* Use flexbox for layout */
        justify-content: space-between; /* Space items evenly */
        align-items: center; /* Center items vertically */
		
    }

    /* Style for the back button */
    .btn-back {
        color: white; /* White text color */
        background-color: black; /* Black background color */
        padding: 5px 10px; /* Add padding */
        border: none; /* Remove border */
        cursor: pointer; /* Show pointer cursor */
        text-decoration: none; /* Remove default underline */
    }

    /* Style for the h3 inside card header */
    .card-header h3 {
        font-size: 24px; /* Set font size */
        margin: 0; /* Remove default margin */
    }

    /* Style for the form */
    .form-horizontal {
        margin-top: 20px; /* Add some top margin */
        padding: 20px; /* Add padding */
    }
	.btn.btn-success
	{
		border: none;
    background: pink;
    border-radius: 6px;
    height: 30px;
    width: 100px;
    font-size: 18px;
	}
	.btn.btn-success:hover
	{
		 background:deepPink;
		 color:white;
	}
	
	.backbtn
	{
		 color: white; /* White text color */
        background-color: gray; /* Gray background color */
        padding: 5px 10px; /* Add padding */
        border: none; /* Remove border */
        cursor: pointer; /* Show pointer cursor */
        text-decoration: none; /* Remove default underline */
	}
	.backbtn:hover {
        background-color: black; /* Black hover background color */
    }
	.form-control
	{
		width:100% !important;
	}
	
	.form-group.row {
    display: flex;
    margin-left:30px;
}

.form-group.row .col-sm-2.col-form-label {
    text-align: right; /* Align labels to the right */
}

.form-group.row .col-sm-6.col-form-label {
    margin-left: 10px; /* Add some space between label and data */
}

    </style>
</head>
<body>
   
<div class="card card-pink" style="width:140vh;">

  <div class="card-header">
    <h3 class="card-title">
      <font size="5">SONGS View</font>
    </h3>
	<div class="backbtn">
            <a onclick="return back()" style="float: right;color:white" data-toggle="modal" class="btn btn-dark"><b>Back</b></a>
			</div>
  </div>

  <form role="form" name="" action="update.php" method="post" enctype="multipart/type">
    <div class="card-body">
				 
				 
				    
				 
                <br><br>	
				  	  <div class="form-group row">
                    <label for="title" class="col-sm-2 col-form-label">TITLE</label>
                    <div class="col-sm-4">
				
					:<label for="title" class="col-sm-6 col-form-label"> <?php echo  $row['title'];?></label>
                     
                  </div>
				  </div><br><br>
				  
				  	  <div class="form-group row">
                    <label for="movie_id" class="col-sm-2 col-form-label">MOVIE NAME</label>
                    <div class="col-sm-4">
				
					:<label for="movie_id" class="col-sm-6 col-form-label"> <?php echo  $row['movie_name'];?></label>
                     
                  </div>
				  </div><br><br>
				  	  <div class="form-group row">
                    <label for="language_id" class="col-sm-2 col-form-label">LANGUAGE</label>
                    <div class="col-sm-4">
				
					:<label for="language_id" class="col-sm-6 col-form-label"> <?php echo  $row['language_name'];?></label>
                     
                  </div>
				  </div><br><br>
				  	  
				  	  <div class="form-group row">
                    <label for="duration" class="col-sm-2 col-form-label">DURATION</label>
                    <div class="col-sm-4">
				
					:<label for="duration" class="col-sm-6 col-form-label"> <?php echo  $row['duration'];?></label>
                     
                  </div>
				  </div><br><br>
				  	  <div class="form-group row">
                    <label for="file_location" class="col-sm-2 col-form-label">FILE LOCATION</label>
                    <div class="col-sm-4">
				
					:<label for="file_location" class="col-sm-6 col-form-label"> <?php echo  $row['file_location'];?></label>
                     
                  </div>
				  </div><br><br>
                
    <div class="form-group row">
                    <label for="lyrics_location" class="col-sm-2 col-form-label">LYRICS LOCATION</label>
                    <div class="col-sm-4">
				
					:<label for="lyrics_location" class="col-sm-6 col-form-label"> <?php echo  $row['lyrics_location'];?></label>
                     
                  </div>
				  </div><br><br>

          <div class="form-group row">
                    <label for="english_lyrics_location" class="col-sm-2 col-form-label">ENGLISH LYRICS LOCATION</label>
                    <div class="col-sm-4">
				
					:<label for="english_lyrics_location" class="col-sm-6 col-form-label"> <?php echo  $row['english_lyrics_location'];?></label>
                     
                  </div>
				  </div><br><br>
				
				   
                  
                </div>
               
              </form>
            </div>
    <!-- Your footer content and scripts -->
</body>
</html>
	
<script>
	function back(){
    var rightcontent=$("#rightcontent").hide();

    $.ajax({
    type:"POST",
      url:"/rythm/professional_singer/music/music_view.php",
    success:function(data){
      $("#centerconteid").css("marginLeft", "450px");
               
               $("#centerconteid").html(data);
	
    }
    })
  }
//  function role_update()
//     {
//     var id=$('#get_id').val();
// 	//alert(id);
   
//     var data = $('form').serialize();
//     $.ajax({
//     type:'GET',
//     data:"id="+id, data,
	
//     url:'Tickets/Role/role_update.php',
//     success:function(data)
//     {
//       if(data==1)
//       { 
//         alert('Not');
      
//       }
//       else
//       {
//         alert("Update Successfully");
// 		Role()
//       }
      
//     }       
//     });
//     }
	</script>