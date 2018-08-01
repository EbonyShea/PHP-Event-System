<?php
	include_once "includes/header.php";
?>

<div id = "login_page">
	<img class = "logo" src = "img/title.png"/>
	<div id = "login_main">
		<h1>Login</h1>
		<hr>
		<form method="post" id = "login_form">
			<label>Username</label>
			<input type = "text" id = "logUsername" class="form-control" name = "logUsername" maxlength = "50" pattern = ".{3,50}" autofocus></input>
			</br>
			<label>Password</label>
			<input type = "password" id = "logPassword" class="form-control" name = "logPassword" maxlength = "256" pattern = ".{8,}"></input>
			</br>
			<input type = "submit" value="Login" class="btn btn-warning"></input>
			<hr>
			<a href = "register.php">Don't have an account?</a>
		</form>
	</div>
</div>

<?php
	include_once "includes/footer.php";
?>