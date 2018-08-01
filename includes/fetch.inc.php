<?php
	session_start();
	if ($_SERVER['REQUEST_METHOD'] != 'POST') {
		header("Location: ../dashboard.php");
		exit();
	} else {
		include_once 'dbh.inc.php';
		$output = '';
		$keyword = "";
		$sql = "SELECT * FROM event WHERE event_Name like ? OR event_Desc like ? ORDER BY event_Date DESC;";
		$keyword =  mysqli_real_escape_string($conn, $_POST['query']);
		$keyword = "%".$keyword."%";
		$stmt = mysqli_stmt_init($conn);
		if(!mysqli_stmt_prepare($stmt, $sql)) {
			echo "ERROR";
		} else {
			mysqli_stmt_bind_param($stmt, "ss", $keyword, $keyword);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_bind_result($stmt, $e_ID, $name, $desc, $img, $start, $end, $category, $date, $organizer, $venue);
			mysqli_stmt_store_result($stmt);
			if (mysqli_stmt_num_rows($stmt) > 0){
				while(mysqli_stmt_fetch($stmt)){
					$date = date("j-m-Y", strtotime($date));
					$name = stripslashes($name);
					$desc = stripslashes($desc);
					$output .= '<tr>
							<td>'.$name.'</td>
							<td>'.$desc.'</td>
							<td>'.$date.'</td>
							<td><div class = "btn-group dropdown">
									<button type = "button" class="btn btn-info dropdown-toggle" data-toggle = "dropdown">
										<span class="glyphicon glyphicon-cog"/> <span class="caret"/>
									</button>
									<ul class="dropdown-menu dropdown-menu-right">
										<li><a class = "btn view_data" id="'.$e_ID.'">Attendance</a></li>
										<li><a class = "btn edit_data" id = "'.$e_ID.'">Edit</a></li>
										<li><a class = "btn delete_data" data-id="'.$e_ID.'">Delete</a></li>
									</ul>
								</div></td>
						</tr>';
				}
			} else {
				$output .= '<td colspan = "4" style = "text-align: center; background-color: #fff;">No data found</td>';
			}
		}
		mysqli_stmt_close($stmt);
		echo $output;
	}
?>