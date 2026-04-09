<?php
require '../connect.php';
include("../user.php");
?>
<style>
td {
  font-size: 20px;
}
</style>
<script>
		function add(){
		
		 $.ajax({
		type:"POST",
		 url:"songs/songs_add.php",
		success:function(data){
		$("#main_content").html(data);
		}
		}) 
	}
		</script>
<div  class="card card-pink">
              <div class="card-header">
                <h3 class="card-title"><font size="5"><b>SONGS LIST</b></font></h3>
			<a onclick="add()" style="float: right;" data-toggle="modal" class="btn btn-dark"><b> Add New Song</b></a>
			
				
              </div>
			  
              <!-- /.card-header -->
              <div class="card-body">
			  
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>S.No</th>
					<th>Song Name</th>
					<th>Language</th>
					<th>Action</th>
                  </tr>
                  </thead>
                   <tbody font size="5">
<?php

$sql_query = "SELECT song_master.id AS song_id,
				song_master.title,
				song_master.language_id,
				
				(SELECT lng.language_name
					FROM languages AS lng
					WHERE lng.id = song_master.language_id)
					AS language_name

				FROM song_master
				ORDER BY song_master.title";

$sql = $con->query($sql_query);
$cnt=1;
 while($empdetails = $sql->fetch(PDO::FETCH_ASSOC))
{
	
?>

<tr>
<td><?php echo $cnt;?></td>

<td><?php echo $empdetails['title'];?></td>
<td><?php echo $empdetails['language_name']?></td>

<td>
	<button class="btn btn-light btn-sm" 
			data-id="<?php echo $empdetails['song_id']; ?>" 
			onclick="songs_view(<?php echo $empdetails['song_id']; ?>)">
			
			<i class="fa fa-eye"></i>

	</button>

	<button class="btn btn-success btn-sm edit btn-flat" 
			data-id="<?php echo $empdetails['song_id']; ?>" 
			onclick="songs_edit(<?php echo $empdetails['song_id']; ?>)">

			<i class="fa fa-edit"></i> Edit
			
	</button>	
	<button class="btn btn-danger btn-sm" data-id="<?php echo $empdetails['song_id']; ?>" onclick="songs_delete(<?php echo $empdetails['song_id']; ?>)"style="background-color:red;">&nbsp;<i class="fa fa-trash btn-icon"></i>&nbsp;Delete</button>
</td>

</tr>
<?php 
$cnt=$cnt+1;
 }?></tbody>          

 
                </table>
				
              </div>
              <!-- /.card-body -->
            </div>
		
			<script>
  $(document).ready(function(){
	
    $('#example1').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true,
      "responsive": true,
	  "lengthMenu": [
        [25, 50, 100, 200, 500, 1000, -1],
        [25, 50, 100, 200, 500, 1000, "All"]
    ],
    });
  });
function songs_edit(v){
	//alert(v);
	$.ajax({
	type:"POST",
	url:"songs_edit.php?id="+v,
	
	success:function(data)
	{
		$("#main_content").html(data);
	}
	})
}

  function songs_view(v){
	//alert(v);
	$.ajax({
	type:"POST",
	url:"songs_view_show.php?id="+v,
	success:function(data)
	{
		$("#main_content").html(data);
	}
	})
}



function songs_delete(v) {
    var rightcontent=$("#rightcontent").hide();
    $.ajax({
      type:"POST",
      url:"/rythm/songs/songs_delete.php?id"=+v,
      success:function(data) {
        if(data==1) { 
          alert('Not');
        } else {
          alert("songs Deleted Successfully");
          window.location.href = "/rythm/songs_view.php";
        }
      }
    });
  }
	
		
</script>
