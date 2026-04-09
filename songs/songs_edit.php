<?php
require '../connect.php';
include("../user.php");

$id = $_REQUEST['id'];

$sql_query = "SELECT song_master.id AS song_id,
                song_master.music_director,
				song_master.title,
                song_master.language_id,
                song_master.file_location,
                song_master.lyrics_location,

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

 <div class="card card-pink">
              <div class="card-header">
                <h3 class="card-title"><b>SONGS EDIT</b></h3>
				
				<a onclick="back()" style="float: right;" data-toggle="modal" class="btn btn-dark"></i><b>Back</B></a>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal" action="../../rythm/songs/songs_edit.php" method="POST" enctype="multipart/form-data">

<div class="card-body">
    <div class="form-group row">
        <label for="title" class="col-sm-2 col-form-label">Song Name</label>
        <div class="col-sm-4">
            <input type="hidden" class="form-control" id="get_id" name="get_id" value="<?php echo $row['song_id']; ?>">
            <input type="text" class="form-control" name="title" id="title" value="<?php echo $row['title']; ?>">
        </div>
    </div>

    <div class="form-group row">
        <label for="Languages" class="col-sm-2 col-form-label">Languages</label>
        <div class="col-sm-4">
            <select class="form-control" name="language_id" id="language_name" required>
                <?php
                $languages = $row['language_id'];
                $sql = $con->query("SELECT * FROM languages WHERE id='$languages'");
                $row1 = $sql->fetch(PDO::FETCH_ASSOC);

                if ($row1) {
                    echo '<option value="' . $row1['id'] . '">' . $row1['language_name'] . '</option>';
                }

                $sql1 = $con->query("SELECT * FROM languages");
                while ($cmp = $sql1->fetch(PDO::FETCH_ASSOC)) {
                    echo '<option value="' . $cmp['id'] . '">' . $cmp['language_name'] . '</option>';
                }
                ?>
            </select>
        </div>
    </div>

    <div class="card-body">
        <label for="file_location" class="col-sm-2 col-form-label">SONG</label>
        <label><?php echo $row['file_location']; ?></label>

        <div class="form-group row">
            <label for="songs" class="col-sm-2 col-form-label">UPLOAD SONG</label>
            <div class="col-sm-4">
                <input type="file" name="song_file" id="song_file">
            </div>
        </div>
    </div>

    <div class="card-body">
        <label for="lyrics_location" class="col-sm-2 col-form-label">TAMIL LYRICS</label>
        <label><?php echo $row['lyrics_location']; ?></label>

        <div class="form-group row">
            <label for="lyrics" class="col-sm-2 col-form-label">UPLOAD TAMIL LYRICS</label>
            <div class="col-sm-4">
                <input type="file" name="lyrics_file" id="lyrics_file">
            </div>
        </div>
    </div>

    <div class="card-footer">
        <button type="submit" name="Update" class="btn btn-success btn-md">Update</button>
        <button type="reset" class="btn btn-default float"><b>Cancel</b></button>
    </div>
</div>
</form>

            </div>
	
            

<script>
  function back(){
    $.ajax({
    type:"POST",
      url:"songs/songs_view.php",
    success:function(data){
    $("#main_content").html(data);
	
    }
    })
  }
  function songs_update()
      {
      var id=$('#get_id').val();
    //alert(id);
    
      var data = $('form').serialize();
      $.ajax({
      type:'POST',
      data:"id="+id, data,
    
      url:'rythm/songs/songs_update.php',
      success:function(data)
      {
        if(data==1)
        { 
          alert('Not');
        
        }
        else
        {
          alert("Update Successfully");
      songs()
        }
        
      }       
      });
      } 
	</script>