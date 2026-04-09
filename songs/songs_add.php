<?php
require '../connect.php';
include("../user.php");
?>

<div class="card card-pink">
     <div class="card-header">
                <h3 class="card-title"><font size="5"><b>Add New Karoke & Lyrics</b></font></h3>
       
		<a onclick="back()" style="float: right;" data-toggle="modal" class="btn btn-dark"></i> <b>Back</b></a>
    </div>
	
    <form action='#' class="form-horizontal" method="POST">
        
		<table id="dataTable" width="400px" border="5" style="border-collapse:collapse;margin-bottom: 0px !important;" class="table table-bordered">
			<tr>
				   <th style="width:183px">Song Name</th>
				   <th style="width:175px">Music Director</th>
				   <th style="width:149px;">Language</th>
				   <th style="width:175px">Select Song</th>
				   <th style="width:175px">Upload Lyrics</th>
			</tr>
			
			<tr>
				<td> 
                  <input type="text" class="form-control" name="title1" id="title1" style="width:98% !important;" autocomplete="off" placeholder="Enter Song Name">
                </td>
				 
				<td>
					 <select type="text" class="form-control" name="music_director_id1" id="music_director_id1" style="width:96% !important;" >
                     <option value="">---Select---</option>
                    <?php
                    $sql=$con->query("SELECT * FROM music_directors");
                    $i=1;
                    while($cmp = $sql->fetch(PDO::FETCH_ASSOC))
                    {
                    ?>
                    <option value="<?php echo $cmp['id'];?>"><?php echo $cmp['music_director_name'];?></option>
                    <?php
                    }
                    ?>
                    </select>
				</td>
				
								<td>
					 <select class="form-control" name="language_id1" id="language_id1" style="width:100% !important;" >
                    <option value="">---Select---</option>
                    <?php
                        $sql=$con->query("SELECT * FROM languages");
                        $i=1;
                        while($cmp = $sql->fetch(PDO::FETCH_ASSOC))
                        {
                        ?>
                        <option value="<?php echo $cmp['id'];?>"><?php echo $cmp['language_name'];?></option>
                        <?php
                        }
                        ?>
                        </select>
                </td>
				<td>
					 <input type="file"  name="song_file1"  id="song_file1" style="width:100% !important;" placeholder="Enter the songs" >
				</td>
				
				<td>
				    <input type="file"  name="lyrics_file1" id="lyrics_file1" style="width:100% !important;" placeholder="Enter the lyrics ">
				</td>
			</tr>
			</table>
			
			
			
			<div class="card-footer">
                   <input type="submit" class="btn btn-success" name="save" value="Submit">
            </div>
</form>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
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
</script>



 
 
<script>
 function insert_songs()
    {
    var id=0;
	//alert(id);
    var data = $('form').serialize();
	//alert(data);
    $.ajax({
    type:'GET',
    data:"id="+id, data,
    url:'neha/songs/songs_submit.php',
	
    success:function(data)
    {
      
      //alert("Karoke Entry Successfully Submitted");
songs()
      
      
    }       
    });
    } 
</script>