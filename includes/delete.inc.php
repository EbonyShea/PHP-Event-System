<?php
	session_start();
	if ($_SERVER['REQUEST_METHOD'] != 'POST') {
		header("Location: ../event.php");
		exit();
	} else {
		include_once 'dbh.inc.php';
		if (isset($_POST['event_ID'])){
			$e_ID = mysqli_real_escape_string($conn, $_POST['event_ID']);
			$sql = "DELETE FROM Event WHERE event_ID = ?;";
			$stmt = mysqli_stmt_init($conn);
			
			if (!mysqli_stmt_prepare($stmt, $sql)) {
				echo "ERROR";
			} else {
				mysqli_stmt_bind_param($stmt, "s", $e_ID);
				mysqli_stmt_execute($stmt);
				echo "Delete Success";
			}
			mysqli_stmt_close($stmt);
		}
	}
?>