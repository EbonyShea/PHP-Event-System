<?php
	session_start();
	if ($_SERVER['REQUEST_METHOD'] != 'POST') {
		header("Location: ../event.php");
		exit();
	} else {
		include_once 'dbh.inc.php';
		$output = '';
		$keyword = "";
		$sql = "SELECT * FROM event WHERE Event_Name like ? AND event_Category like ? ORDER BY Event_Date DESC;";
		$keyword =  mysqli_real_escape_string($conn, $_POST['query']);
		$keyword = "%".$keyword."%";
		$category = mysqli_real_escape_string($conn, $_POST['category']);
		$stmt = mysqli_stmt_init($conn);
		if(!mysqli_stmt_prepare($stmt, $sql)) {
			echo "ERROR";
		} else {
			mysqli_stmt_bind_param($stmt, "ss", $keyword, $category);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_bind_result($stmt, $ID, $name, $desc, $img, $start, $end, $category, $date, $organizer, $venue);
			mysqli_stmt_store_result($stmt);
			if (mysqli_stmt_num_rows($stmt) > 0){
				while(mysqli_stmt_fetch($stmt)){
					$date = date("j-m-Y", strtotime($date));
					$name = stripslashes($name);
					$desc = stripslashes($desc);
					
					$result = mysqli_query($conn, "SELECT * FROM attendance WHERE user_ID = '".$_SESSION['user_ID']."' AND event_ID = '".$ID."' LIMIT 1;");
					$going = "<span><a class = 'btn attend_data' id = '".$ID."'>I'm Going</a></span>";
					$num = mysqli_num_rows($result);
					if ($num > 0){
						$going = "<span><a class = 'btn' disabled = 'true'>Going</a></span>";
					}
					
					$output .= "<div class = 'item col-2 col-xl-2 col-lg-3 col-md-4 col-sm-6 col-xs-12'>
									<div class = 'item-box'>
										<div class = 'img-box'>
											<img src = 'img/event/".$img."'/>
										</div>
										<div class = 'item-content'>
											<a class = 'view_event' id = '".$ID."'>".$name." <span class='glyphicon glyphicon-search'></span>
											</a>
										</div>
										<div class = 'item-foot'>
											<span><a class = 'btn view_attendance' id = '".$ID."'>Who's Going?</a></span>
											".$going."
										</div>
									</div>
								</div>";
				}
			}
			mysqli_stmt_close($stmt);
			echo $output;
		}
	}
?>