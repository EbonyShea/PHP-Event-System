<?php
	include_once "includes/header.php";
	session_start();
	if($_SESSION['type'] != 1){
		header("Location: event.php");
		exit();
	}
?>

<div id = "event_container">
	<img class = "logo" src = "img/title.png"/>
	<hr>
	<a class = "navlink" href = "includes/logout.inc.php">Logout</a>
	<a class = "navlink" href = "event.php">Events</a>
	<div class = "container">
		<h1>Manage Events</h1>
		<button class = "btn btn-danger add_data" data-toggle="modal" data-target="#add_dataModal" class="btn">+</button>
		<input type = "search" id = "search" class = "form-control" placeholder = "Search..." autofocus></input>
		
		<div id = "table_container">
			<table>
				<thead>
				<tr>
					<th>Title</th>
					<th>Description</th>
					<th>Date Added</th>
					<th>Action</th>
				</tr>
				</thead>
				<tbody id = "mainTbl"></tbody>
			</table>
		</div>
		</br>
	</div>
</div>
</body>
</html>

<div id = "add_dataModal" class = "modal fade">
	<div class = "modal-dialog">
		<div class = "modal-content">
			<div class = "modal-header">
				<button type="button" class = "close" data-dismiss="modal">&times;</button>
				<h4 id = "modalTitle" class = "modal-title"></h4>
			</div>
			<div class = "modal-body">
				<form method="post" id="insert_form">
					<div id = "editOnly" style = "display: none">
						<label>Event ID</label>
						<input type = "text" class = "form-control" id = "event_ID" name = "event_ID" readonly="readonly"></input>
						</br>
					</div>
					<label>Event Name<i class = "fa fa-asterisk"></i></label>
					<input type = "text" maxlength = "50" class="form-control" id = "name" name = "name" required></input>
					</br>
					<label>Description<i class = "fa fa-asterisk"></i></label>
					<input type = "text" maxlength = "1000" class="form-control" id = "desc" name = "desc" required></input>
					</br>
					<label>Starting Time<i class = "fa fa-asterisk"></i></label>
					<input type = "datetime-local" class="form-control" id = "sdate" name = "sdate" required></input>
					</br>
					<label>Ending Time<i class = "fa fa-asterisk"></i></label>
					<input type = "datetime-local" class="form-control" id = "edate" name = "edate" required></input>						
					</br>
					<label>Organizer<i class = "fa fa-asterisk"></i></label>
					<input type = "text" class="form-control" maxlength = "50" id = "organizer" name = "organizer" required></input>						
					</br>
					<label>Venue<i class = "fa fa-asterisk"></i></label>
					<input type = "text" class="form-control" maxlength = "50" id = "venue" name = "venue" required></input>						
					</br>
					<label>Image<i class = "fa fa-asterisk"></i></label>
					<input type = "file" class="form-control" id = "img" name = "img" required></input>						
					</br>
					<label>Category<i class = "fa fa-asterisk"></i></label>
						<select id = "category" name = "category" class = "form-control" required>
							<option value = "Miscellaneous">Miscellaneous</option>
							<option value = "Sport">Sport</option>
							<option value = "Music">Music</option>
							<option value = "Art">Art</option>
							<option value = "Social">Social</option>
						</select>
					</br>
					<input type = "submit" name="submit" id="insert" class="btn btn-success"></input>
					<input type = "reset" id = "clear" class="btn clearinput btn-default"></input>
				</form>
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

<script>
$(document).ready(function(){	
	function fetch_data(keyword){
		var query = keyword;
		$.ajax({
			method: "POST",
			url: "includes/fetch.inc.php",
			data: {query:query},
			success: function(data){
				$('#mainTbl').html(data);
			}
		});
	}
	fetch_data('%');
	
	$('#search').keyup(function(){
		var query = $('#search').val();
		if(query != ''){
			fetch_data(query);
		} else {
			fetch_data('%');
		}
	});
	
	$(document).on('click', '.view_data', function(){
		var event_ID = $(this).attr("id");
		$.ajax({
			method: "POST",
			url: "includes/attendance.inc.php",
			data:{event_ID:event_ID},
			dataType:"text",
			success: function(data){
				$('#attendanceTbl').html(data);
				$('#view_dataModal').modal('show');
			}
		});
	});
	
	$(document).on('click', '.add_data', function(){
		$('#modalTitle').html("Add Event");
		$('#clear').show();
		$('#editOnly').hide();
		$('#insert').val("Insert");
		$('#insert_form')[0].reset();
	});
	
	$('#insert_form').on('submit', function(event){
		event.preventDefault();
		var uploadData = new FormData($(this)[0]);
		$.ajax({
			type: "POST",
			url: "includes/insert.inc.php",
			data: uploadData,
			success: function(data){
				if (data == 1){
					$('#add_dataModal').modal('hide');
					$('#insert_form')[0].reset();
					alert("Successful!");
				} else {
					alert(data);
				}
				fetch_data('%');
			},
			cache: false,
			contentType: false,
			processData:false
		});
	});
	
	$(document).on('click','.edit_data', function(){
		var event_ID = $(this).attr("id");
		$.ajax({
			url: "includes/select.inc.php",
			method: "POST",
			data:{event_ID:event_ID},
			dataType:"json",
			success: function(data){
				$('#modalTitle').html("Edit Event");
				$('#editOnly').show();
				$('#clear').hide();
				$('#insert_form')[0].reset();
				$('#event_ID').val(data.event_ID);
				$('#name').val(data.event_Name);
				$('#desc').val(data.event_Desc);
				$('#sdate').val(data.event_Start);
				$('#edate').val(data.event_End);
				$('#category').val(data.event_Category);
				$('#organizer').val(data.event_Organizer);
				$('#venue').val(data.event_Venue);
				$('#insert').val("Edit");
				$('#add_dataModal').modal('show');
			}
		});
	});
	
	$(document).on('click', '.delete_data', function(){  
		var event_ID = $(this).data("id"); 
		$.ajax({
			type: "POST",
			url: "includes/delete.inc.php",
			data: {event_ID:event_ID},
			dataType: "text", 
			success: function(data){
				alert(data);
				fetch_data('%');
			}
		});
	});
});
</script>