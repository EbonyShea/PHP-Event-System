<?php
	session_start();
	// To disallow illegal access
	if ($_SERVER['REQUEST_METHOD'] != 'POST'){
		header("Location: ../event.php");
		exit();
	} else {
		include_once 'dbh.inc.php';
		$e_ID = mysqli_real_escape_string($conn, $_POST['event_ID']);
		$sql = "SELECT Counter FROM content_ctr WHERE Content_Type = 'attendance' LIMIT 1;";
		$result = mysqli_query($conn, $sql);
		$row = $result->fetch_assoc();
		$num = $row['Counter'];
		$iterate = $num + 1;
		$increment = sprintf("%04d",$iterate);							
		$a_ID = 'A'.$increment;
		
		$sql = "INSERT INTO attendance (a_ID, event_ID, user_ID) VALUES (?, ?, ?);";
		$stmt = mysqli_stmt_init($conn);
		if(!mysqli_stmt_prepare($stmt, $sql)) {
			echo "ERROR";
		} else {
			mysqli_stmt_bind_param($stmt, "sss", $a_ID, $e_ID, $_SESSION['user_ID']);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
			echo "You are added to the attendance";
		}
	}
?>