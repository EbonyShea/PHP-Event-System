<?php
	include_once "includes/header.php";
?>

<div id = "login_page">
	<img class = "logo" src = "img/title.png"/>
	<div id = "login_main">
		<h1>Register</h1>
		<hr>
		<form method="post" id = "register_form">
			<label>Username</label>
			<div class="input-group">
				<input type = "text" id = "username" class="form-control" name = "username" maxlength = "50" pattern = ".{3,50}" autofocus></input>
				<span data-toggle="tooltip" data-placement="top" title="Minimum 3 and Maximum 50 characters" class="input-group-addon">
				<span class="glyphicon glyphicon-info-sign"></span>
			</div>
			</br>
			<label>Email</label>
			<div class="input-group">
				<input type = "email" id = "email" class="form-control" name = "email" maxlength = "50"></input>
				<span data-toggle="tooltip" data-placement="top" title="E.g. name@domain.com" class="input-group-addon">
				<span class="glyphicon glyphicon-info-sign"></span>
			</div>
			</br>
			<label>Password</label>
			<div class="input-group">
				<input type = "password" id = "password" class="form-control" name = "password" maxlength = "256" pattern = ".{8,}"></input>
				<span data-toggle="tooltip" data-placement="top" title="Password must contain at least 8 characters, including UPPER/lowercase, special character(s) and number(s)" class="input-group-addon">
				<span class="glyphicon glyphicon-info-sign"></span>
			</div>
			</br>
			<label>Confirm Password</label>			
			<div class="input-group">
				<input type = "password" id = "cpassword" class="form-control" name = "cpassword" maxlength = "256" pattern = ".{8,}"></input>
				<span data-toggle="tooltip" data-placement="top" title="Match the Password entered above" class="input-group-addon">
				<span class="glyphicon glyphicon-info-sign"></span>
			</div>
			</br>
			<input type = "submit" value="Register" class="btn btn-info"></input>
			<input type = "reset" value="Clear" class="btn btn-default"></input>
			<hr>
			<a href = "index.php">Already registered?</a>
		</form>
	</div>
</div>

<?php
	include_once "includes/footer.php";
?>