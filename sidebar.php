<nav class="mt-2">
<ul class="nav nav-pink nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

<li class="nav-item has-treeview menu-open">

<?php
$rolemaster_id=$_SESSION['role_master_id'];
$sql = $con->query("SELECT masters_menu.id as id,masters_menu.menu_name FROM `masters_menu` INNER JOIN role_mapping ON masters_menu.id = role_mapping.menu_id
WHERE role_mapping.role_id='$rolemaster_id' group by menu_name"); 

while($row = $sql->fetch(PDO::FETCH_ASSOC))
{
$menuid=$row['id'];
?>

<a href="#collapseMulti_<?php echo $row['id']; ?>" class="nav-link active">
<i class="fa fa-users" aria-hidden="true"></i>

<p><label><?php echo $row['menu_name']; ?></label></p>

</a>
<ul class="nav nav-treeview">
 <?php 
    $sql2 = $con->query("SELECT * FROM `masters_sub_menu` INNER JOIN role_mapping ON masters_sub_menu.id=role_mapping.submenu_id
 WHERE role_mapping.role_id='$rolemaster_id' and role_mapping.menu_id='$menuid' and status='1'"); 
    while($res = $sql2->fetch(PDO::FETCH_ASSOC))
    { ?>     
<li class="nav-item">

<a onclick="<?php echo $res['call_method']; ?>" class="nav-link ">
<i class="far fa-circle nav-icon"></i>
 <p><label><?php echo $res['name']; ?> </label></p>
</a>
</li>
 <?php
    }
    ?>
</ul>
<?php
}
?>
</li>

</ul>
</nav>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>

<script>
function calendaradd()
{
	alert('jijiij');
	$.ajax({
    type:"POST",
    url:"/Neha/Neha/calendar/calendar_form.php",
    success:function(data){
		
      $("#main_content").html(data);
    }
  })
	
}
function eventlist()
{//debugger;
	
	$.ajax({
    type:"POST",
    url:"/Neha/eventlistshow.php",
    success:function(data){
		
      $("#main_content").html(data);
    }
  })
	
}
</script>