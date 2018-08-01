<?php
	session_start();
	// To disallow illegal access
	if ($_SERVER['REQUEST_METHOD'] != 'POST'){
		header("Location: ../event.php");
		exit();
	} else {
		include_once 'dbh.inc.php';
		$name = mysqli_real_escape_string($conn, $_POST['name']);
		$desc = mysqli_real_escape_string($conn, $_POST['desc']);
		$start = mysqli_real_escape_string($conn, $_POST['sdate']);
		$end = mysqli_real_escape_string($conn, $_POST['edate']);
		$category = mysqli_real_escape_string($conn, $_POST['category']);
		$organizer = mysqli_real_escape_string($conn, $_POST['organizer']);
		$venue = mysqli_real_escape_string($conn, $_POST['venue']);
		
		$imgName = $_FILES['img']['name'];
		$imgTmp = $_FILES['img']['tmp_name'];
		$imgSize = $_FILES['img']['size'];
		$imgError = $_FILES['img']['error'];
		$imgType = $_FILES['img']['type'];
		$imgExt = explode ('.', $imgName);
		$imgActualExt = strtolower(end($imgExt));
		$allowed_img = array('jpg','jpeg','png');
		
		
		if ($imgError != 0 || !in_array($imgActualExt, $allowed_img)){
			echo "Invalid image file";
		} else {
			if (isset($_POST['event_ID']) && $_POST['event_ID'] != ''){
				/* Update */
				$e_ID = mysqli_real_escape_string($conn, $_POST['event_ID']);
				$sql = "UPDATE Event 
				SET event_Name = ?, event_Desc = ?, event_Img = ?, event_Start = ?, event_End = ?, event_Category = ?, event_Organizer = ?, event_Venue = ?
				WHERE event_ID = ?;";
				$stmt = mysqli_stmt_init($conn);
				if (!mysqli_stmt_prepare($stmt, $sql)){
					echo "ERROR";
				} else {
					$newImgName = $e_ID.".".$imgActualExt;
					move_uploaded_file($imgTmp, "../img/event/".$newImgName);
					mysqli_stmt_bind_param($stmt, "sssssssss", $name, $desc, $newImgName, $start, $end, $category, $organizer, $venue, $e_ID);
					mysqli_stmt_execute($stmt);
					mysqli_stmt_close($stmt);
				}
				echo 1;
			} else {
				/* Add */
				$sql = "SELECT Counter FROM content_ctr WHERE Content_Type = 'event' LIMIT 1;";
				$result = mysqli_query($conn, $sql);
				$row = $result->fetch_assoc();
				$num = $row['Counter'];
				$iterate = $num + 1;
				$increment = sprintf("%04d",$iterate);							
				$e_ID = 'E'.$increment;
				
				mysqli_query($conn, "UPDATE content_ctr SET Counter = '$iterate' WHERE Content_Type = 'event';");				
				$sql = "INSERT INTO Event (event_ID, event_Name, event_Desc, event_Img, event_Start, event_End, event_Category, event_Organizer, event_Venue)
				VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?);";
				$stmt = mysqli_stmt_init($conn);
				if(!mysqli_stmt_prepare($stmt, $sql)) {
					echo "ERROR";
				} else {
					$newImgName = $e_ID.".".$imgActualExt;
					move_uploaded_file($imgTmp, "../img/event/".$newImgName);
					mysqli_stmt_bind_param($stmt, "sssssssss", $e_ID, $name, $desc, $newImgName, $start, $end, $category, $organizer, $venue);
					mysqli_stmt_execute($stmt);
					mysqli_stmt_close($stmt);
				}
				echo 1;
			}
		}
		
	}