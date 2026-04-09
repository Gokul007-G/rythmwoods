<?php 
require '../../connect.php';
require '../../user.php';
//$userid = $_SESSION["userid"];
include('header.php');
?>
<style>
.pull-left
{
float: left!important;
}
#cal-slide-tick{
background-image: url(../img/tick.png?2);
}
#cal-slide-tick{
position: absolute;
    width: 16px;
    margin-left: -7px;
    height: 9px;
    top: -1px;
    z-index: 1;
}

#cal-slide-tick.tick-day6{
left: 78.57142857142859%;
}

#cal-slide-content{
padding: 20px;
    color: #ffffff;
    background-image: url(../img/dark_wood.png);
}
.form-inline{
	float: right;
}
.nav-list{
display: contents;
flex-wrap: wrap;
}
.task{
	list-style-type: none;
	margin: 0px;
    padding: 0px;
	color: blue;
}
</style>
<link rel="stylesheet" href="neha/calendar/css/calendar.css">
<?php include('container.php');?>
<div class="container">	
	
	<div class="page-header">
		<div class="pull-right form-inline">
			<div class="btn-group">
				<button class="btn btn-primary" data-calendar-nav="prev"><< Prev</button>
				<button class="btn btn-default" data-calendar-nav="today">Today</button>
				<button class="btn btn-primary" data-calendar-nav="next">Next >></button>
			</div>
			<div class="btn-group">
				<button class="btn btn-warning" data-calendar-view="year">Year</button>
				<button class="btn btn-warning active" data-calendar-view="month">Month</button>
				<button class="btn btn-warning" data-calendar-view="week">Week</button>
				<button class="btn btn-warning" data-calendar-view="day">Day</button>
			</div>
		</div>
		<h3></h3>
		
	</div>
	<div class="row" style="margin-top: 50px; margin-left: 50px; width: 950px;">
		<div class="col-md-9">
			<div id="showEventCalendar"></div>
		</div>
		<div class="col-md-3">
			<h4><u>All Events List</u></h4>
			<ul id="eventlist" class="nav nav-list"></ul>
		</div>
       
		<div style="position: absolute;left: 780px;top: 420px;">
			<h4><u>Daily Task List</u></h4>
	<?php
    $task= $con->query("SELECT * FROM `daily_task`");
	while($dailytask =$task->fetch(PDO::FETCH_ASSOC))
	{
	?>
	    <ul class="task">
            <li> <?php echo $dailytask['title']; ?> </li>
		</ul>
	<?php 
	} 
	?>
		</div>
		
	</div>	
	
	
</div>
 <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.3/underscore-min.js"></script> 
<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/0.10.0/lodash.min.js"></script> -->
<script type="text/javascript" src="neha/calendar/js/calendar.js"></script>
<script type="text/javascript" src="neha/calendar/js/events.js"></script>
<?php include('footer.php');?>
