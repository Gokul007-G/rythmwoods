<?php
require '../connect.php';
include("../user.php");

$id = $_REQUEST['id'];

$sql_query = "SELECT song_master.id AS song_id,
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
                WHERE song_master.id = $id";

$stmt = $con->prepare($sql_query); 
$stmt->execute(); 
$row = $stmt->fetch();

?>

<div class="card card-primary">

  <div class="card-header">
    <h3 class="card-title">
      <font size="5">SONGS View</font>
    </h3>
		<a onclick="back()" style="float: right;" data-toggle="modal" class="btn btn-danger">Back</a>
  </div>

  <form role="form" name="" action="update.php" method="post" enctype="multipart/type">
    <div class="card-body">
				 
				 
				    
				 
                
				 <!--<div class="form-group row">
                    <label for="singer_name" class="col-sm-2 col-form-label">SINGERS NAME</label>
                    <div class="col-sm-4">
				
					:<label for="singer_name" class="col-sm-6 col-form-label"> <?php echo  $row['singer_name'];?></label>
                     
                  </div>
				  </div>-->
				  	  <div class="form-group row">
                    <label for="title" class="col-sm-2 col-form-label">TITLE</label>
                    <div class="col-sm-4">
				
					:<label for="title" class="col-sm-6 col-form-label"> <?php echo  $row['title'];?></label>
                     
                  </div>
				  </div>
				  
				  	  <div class="form-group row">
                    <label for="movie_id" class="col-sm-2 col-form-label">MOVIE NAME</label>
                    <div class="col-sm-4">
				
					:<label for="movie_id" class="col-sm-6 col-form-label"> <?php echo  $row['movie_name'];?></label>
                     
                  </div>
				  </div>
				  	  <div class="form-group row">
                    <label for="language_id" class="col-sm-2 col-form-label">LANGUAGE</label>
                    <div class="col-sm-4">
				
					:<label for="language_id" class="col-sm-6 col-form-label"> <?php echo  $row['language_name'];?></label>
                     
                  </div>
				  </div>
				  	  
				  	  <div class="form-group row">
                    <label for="duration" class="col-sm-2 col-form-label">DURATION</label>
                    <div class="col-sm-4">
				
					:<label for="duration" class="col-sm-6 col-form-label"> <?php echo  $row['duration'];?></label>
                     
                  </div>
				  </div>
				  	  <div class="form-group row">
                    <label for="file_location" class="col-sm-2 col-form-label">FILE LOCATION</label>
                    <div class="col-sm-4">
				
					:<label for="file_location" class="col-sm-6 col-form-label"> <?php echo  $row['file_location'];?></label>
                     
                  </div>
				  </div>
                
    <div class="form-group row">
                    <label for="lyrics_location" class="col-sm-2 col-form-label">LYRICS LOCATION</label>
                    <div class="col-sm-4">
				
					:<label for="lyrics_location" class="col-sm-6 col-form-label"> <?php echo  $row['lyrics_location'];?></label>
                     
                  </div>
				  </div>

          <div class="form-group row">
                    <label for="english_lyrics_location" class="col-sm-2 col-form-label">ENGLISH LYRICS LOCATION</label>
                    <div class="col-sm-4">
				
					:<label for="english_lyrics_location" class="col-sm-6 col-form-label"> <?php echo  $row['english_lyrics_location'];?></label>
                     
                  </div>
				  </div>
				
				   
                  
                </div>
               
              </form>
            </div>
			
			

			
			<script>
	function back()
	{
		$.ajax({
		type:"POST",
		  url:"songs/songs_view.php",
         success:function(data){
		$("#main_content").html(data);
		}
		})
	}
 function role_update()
    {
    var id=$('#get_id').val();
	//alert(id);
   
    var data = $('form').serialize();
    $.ajax({
    type:'GET',
    data:"id="+id, data,
	
    url:'Tickets/Role/role_update.php',
    success:function(data)
    {
      if(data==1)
      { 
        alert('Not');
      
      }
      else
      {
        alert("Update Successfully");
		Role()
      }
      
    }       
    });
    }
	</script>