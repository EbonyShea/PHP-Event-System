<?php
	session_start();
	if ($_SERVER['REQUEST_METHOD'] != 'POST') {
		header("Location: ../event.php");
		exit();
	} else {
		include_once 'dbh.inc.php';
		$output = '';
		$sql = "SELECT attendance.*, user.username FROM attendance, user WHERE event_ID = ? AND attendance.user_ID = user.user_ID ORDER BY a_date DESC;";
		$event_ID =  mysqli_real_escape_string($conn, $_POST['event_ID']);
		$stmt = mysqli_stmt_init($conn);
		if(!mysqli_stmt_prepare($stmt, $sql)) {
			echo "ERROR";
		} else {
			mysqli_stmt_bind_param($stmt, "s", $event_ID);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_bind_result($stmt, $a_ID, $a_Date, $e_ID, $u_ID, $u_Username);
			mysqli_stmt_store_result($stmt);
			if (mysqli_stmt_num_rows($stmt) > 0){
				while(mysqli_stmt_fetch($stmt)){
					$a_Date = date("j-m-Y", strtotime($a_Date));
					$output .= '<tr>
									<td>'.$u_Username.'</td>
									<td>'.$a_Date.'</td>
								</tr>';
				}
			} else {
				$output .= '<td colspan = "2" style = "text-align: center; background-color: #fff;">No data found</td>';
			}
			mysqli_stmt_close($stmt);
			echo $output;
		}
		echo "NOTHING";
	}
?>