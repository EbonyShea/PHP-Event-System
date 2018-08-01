<?php
	session_start();
	if ($_SERVER['REQUEST_METHOD'] != 'POST') {
		echo "ERROR:1";
	} else {
		include_once 'dbh.inc.php';
		$username = mysqli_real_escape_string($conn, $_POST['logUsername']);
		$password = mysqli_real_escape_string($conn, $_POST['logPassword']);
		if (empty($username) || empty($password) || ctype_space($username) || ctype_space($password)) {
			echo "Invalid Username/Password";
		} else {
			$sql = "SELECT * FROM user WHERE username = ?;";
			$stmt = mysqli_stmt_init($conn);
			if(!mysqli_stmt_prepare($stmt, $sql)) {
				echo "ERROR:2";
			} else {
				mysqli_stmt_bind_param($stmt, "s", $username);
				mysqli_stmt_execute($stmt);
				$result = mysqli_stmt_get_result($stmt);
				if ($row = mysqli_fetch_assoc($result)) {
					$hashedPwdCheck = password_verify($password, $row['password']);
					mysqli_stmt_close($stmt);
					if ($hashedPwdCheck == false) {
						echo "Invalid Username/Password";
					} else {
						$_SESSION['user_ID'] = $row['user_ID'];
						$_SESSION['username'] = $row['username'];
						$_SESSION['password'] = $row['password'];
						$_SESSION['email'] = $row['email'];
						$_SESSION['type'] = $row['type'];
						echo 1;
					}
				} else {
					echo "Invalid Username/Password";
				}
			}
		}
	}

?>