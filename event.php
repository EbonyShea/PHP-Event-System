<?php
	include_once "includes/header.php";
	session_start();
	if(!isset($_SESSION['username'])){
		header("Location: index.php");
		exit();
	}
?>

<div id = "event_container">
	<img class = "logo" src = "img/title.png"/>
	<hr>
	<a class = "navlink" href = "includes/logout.inc.php">Logout</a>
	<?php
		if($_SESSION['type'] != 0){
	?>
		<a class = "navlink" href = "manage.php">Manage Events</a>
	<?php } ?>
	<div id = "search-container">
		<input type = "search" id = "search" class = "form-control" placeholder = "Search Here"></input>
		<div id = "category_sort">
			<input class = "btn btn-link" id = "all" name = "all" value = "All" readonly="readonly"></input>
			<input class = "btn btn-link" id = "Miscellaneous" name = "Miscellaneous" value = "Miscellaneous" readonly="readonly"></input>
			<input class = "btn btn-link" id = "Sport" name = "Sport" value = "Sport" readonly="readonly"></input>
			<input class = "btn btn-link" id = "Music" name = "Music" value = "Music" readonly="readonly"></input>
			<input class = "btn btn-link" id = "Art" name = "Art" value = "Art" readonly="readonly"></input>
			<input class = "btn btn-link" id = "Social" name = "Social" value = "Social" readonly="readonly"></input>
		</div>
	</div>
	<div id = "events"></div>
</div>
</body>
</html>

<div id = "view_attendanceModal" class = "modal fade">
	<div class = "modal-dialog">
		<div class = "modal-content">
			<div class = "modal-header">
				<button type="button" class = "close" data-dismiss="modal">&times;</button>
				<h4 class = "modal-title"> Attendance </h4>
			</div>
			<div class = "modal-body">
				<div id = "attendance_container">
					<table>
						<thead>
						<tr>
							<th style = "width: 70%;">Name</th>
							<th style = "width: 30%; display: table-cell;">Date</th>
						</tr>
						</thead>
						<tbody id = "attendanceTbl"></tbody>
					</table>
				</div>
			</div>
			<div class = "modal-footer">
				<button type = "button" class = "btn btn-default" data-dismiss = "modal">Close</button>
			</div>
		</div>
	</div>
</div>

<div id = "view_dataModal" class = "modal fade">
	<div class = "modal-dialog">
		<div class = "modal-content">
			<div class = "modal-header">
				<button type="button" class = "close" data-dismiss="modal">&times;</button>
				<h4 class = "modal-title"> View Event </h4>
			</div>
			<div class = "modal-body">
				<div id = "attendance_container">
					<img id = "eventImg" src = ""/>
					</br>
					<label>Event Name: </label>
					<p id = "eventName"></p>
					</br>
					<label>Event Description: </label>
					<p id = "eventDesc"></p>
					</br>
					<label>Event Category: </label>
					<p id = "eventCategory"></p>
					</br>
					<label>Event Start Date: </label>
					<p id = "eventStart"></p>
					</br>
					<label>Event End Date: </label>
					<p id = "eventEnd"></p>
					</br>
					<label>Event Organizer: </label>
					<p id = "eventOrganizer"></p>
					</br>
					<label>Event Venue: </label>
					<p id = "eventVenue"></p>
					</br>
				</div>
			</div>
			<div class = "modal-footer">
				<button type = "button" class = "btn btn-default" data-dismiss = "modal">Close</button>
			</div>
		</div>
	</div>
</div>

<script>
$(document).ready(function(){
	function display(query,category){
		$.ajax({
			method: "POST",
			url: "includes/display.inc.php",
			data: {query:query, category:category},
			success: function(data){
				$('#events').html(data);
			}
		});
	}
	display('%','%');
	
	$('#search').keyup(function(){
		var query = $('#search').val();
		if(query != ''){
			display(query,'%');
		} else {
			display('%','%');
		}
	});
	
	$(document).on('click', '.view_attendance', function(){
		var event_ID = $(this).attr("id");
		$.ajax({
			method: "POST",
			url: "includes/attendance.inc.php",
			data:{event_ID:event_ID},
			dataType:"text",
			success: function(data){
				$('#attendanceTbl').html(data);
				$('#view_attendanceModal').modal('show');
			}
		});
	});
	
	$(document).on('click', '.view_event', function(){
		var event_ID = $(this).attr("id");
		$.ajax({
			method: "POST",
			url: "includes/select.inc.php",
			data:{event_ID:event_ID},
			dataType:"json",
			success: function(data){
				document.getElementById("eventImg").src="img/event/"+data.event_Img;
				$('#eventName').html(data.event_Name);
				$('#eventDesc').html(data.event_Desc);
				$('#eventStart').html(data.start_format);
				$('#eventEnd').html(data.end_format);
				$('#eventCategory').html(data.event_Category);
				$('#eventOrganizer').html(data.event_Organizer);
				$('#eventVenue').html(data.event_Venue);
				$('#view_dataModal').modal('show');
			}
		});
	});
	
	$(document).on('click', '.attend_data', function(){
		var event_ID = $(this).attr("id");
		$.ajax({
			method: "POST",
			url: "includes/attend.inc.php",
			data:{event_ID:event_ID},
			success: function(data){
				alert(data);
				display('%','%');
			}
		});
	});
	
	$(document).on('click', '#all', function(){
		display('%','%');
		
	});
	
	$(document).on('click', '#Miscellaneous', function(){
		display('%','Miscellaneous');
		$('#search').val("");
	});
	
	$(document).on('click', '#Sport', function(){
		display('%','Sport');
		$('#search').val("");
	});
	
	$(document).on('click', '#Music', function(){
		display('%','Music');
		$('#search').val("");
	});
	
	$(document).on('click', '#Art', function(){
		display('%','Art');
		$('#search').val("");
	});
	
	$(document).on('click', '#Social', function(){
		display('%','Social');
		$('#search').val("");
	});
});
</script>