<?php
	session_start();
	if ($_SERVER['REQUEST_METHOD'] != 'POST') {
		header("Location: ../event.php");
		exit();
	} else {
		include_once 'dbh.inc.php';
		
		if (isset($_POST['event_ID'])){
			$e_ID =  mysqli_real_escape_string($conn, $_POST['event_ID']);
			$sql = "SELECT * FROM event WHERE event_ID = '".$e_ID."';";
			$result = mysqli_query($conn, $sql);
			$row = mysqli_fetch_array($result);	
			$row['start_format'] = date('Y-m-d (H:i A)', strtotime($row['event_Start']));
			$row['end_format'] = date('Y-m-d (H:i A)', strtotime($row['event_End']));
			echo json_encode($row);
		}
	}
?>