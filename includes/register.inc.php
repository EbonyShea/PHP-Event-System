<?php

if (isset($_POST['submit']) || $_SERVER['REQUEST_METHOD'] = 'POST') {
	include_once 'dbh.inc.php';
	$username = mysqli_real_escape_string($conn, $_POST['username']);
	$password = mysqli_real_escape_string($conn, $_POST['password']);
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
		echo "Please enter valid email";
	} else {
		$sql = "SELECT * FROM user WHERE username = ?";
		$stmt = mysqli_stmt_init($conn);
		if(!mysqli_stmt_prepare($stmt, $sql)) {
			echo "ERROR";
		} else {
			mysqli_stmt_bind_param($stmt, "s", $username);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_store_result($stmt);
			$resultCheck = mysqli_stmt_num_rows($stmt);
			if ($resultCheck > 0) {
				echo "Username taken";
				mysqli_stmt_close($stmt);
			} else {
				if (strlen($username) < 3 || strlen($username) > 50 || !preg_match('/^[\w.-]*$/', $username)){
					echo "Invalid Username";
				} else {
					if (strlen($password) > 265 || !preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])[A-Za-z\d$@$!%*?&]{8,}/', $password)){
						echo "Password does not meet requirement(s)";
					} else {
						$sql = "SELECT * FROM user WHERE email = ?";
						$stmt2 = mysqli_stmt_init($conn);
						if(!mysqli_stmt_prepare($stmt2, $sql)) {
							echo "ERROR";
						} else {
							mysqli_stmt_bind_param($stmt2, "s", $email);
							mysqli_stmt_execute($stmt2);
							mysqli_stmt_store_result($stmt2);
							$resultCheck = mysqli_stmt_num_rows($stmt2);
							if ($resultCheck > 0) {
								echo "Email taken";
								mysqli_stmt_close($stmt2);
							} else {
								$sql = "SELECT Counter FROM content_ctr WHERE Content_Type = 'User' LIMIT 1;";
								$result = mysqli_query($conn, $sql);
								$row = $result->fetch_assoc();
								$num = $row['Counter'];
								$iterate = $num + 1;
								$increment = sprintf("%04d",$iterate);							
								$user_ID = 'U'.$increment;
								$hashed_Pwd = password_hash($password, PASSWORD_DEFAULT);
								mysqli_query($conn, "UPDATE content_ctr SET Counter = '$iterate' WHERE Content_Type = 'User';");
								
								$sql = "INSERT INTO user (User_ID, Username, Password, Email) VALUES (?,?,?,?);";
								$stmt3 = mysqli_stmt_init($conn);
								if(!mysqli_stmt_prepare($stmt3, $sql)) {
									echo "ERROR:2";
								} else {
									mysqli_stmt_bind_param($stmt3, "ssss", $user_ID, $username, $hashed_Pwd, $email);
									mysqli_stmt_execute($stmt3);
									mysqli_stmt_close($stmt3);
									echo 1;
								}
							}
						}
					}
				}
			}
		}
	}
}

?>
