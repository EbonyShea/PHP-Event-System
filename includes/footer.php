</body>
</html>

<script>
$(document).ready(function(){	
	$('[data-toggle="tooltip"]').tooltip();
	
	$('#register_form').on('submit', function(event){
		event.preventDefault();
		if ($('#username').val() == ""){
			alert("Username is required");
		} else if($('#password').val() == ""){
			alert("Password is required");
		} else if($('#email').val() == ""){
			alert("Email is required");
		} else if ($('#password').val() != $('#cpassword').val()){
			alert("Confirm passwords invalid");
		} else {
			$.ajax({
				type: "POST",
				url: "includes/register.inc.php",
				data: $('#register_form').serialize(),
				success: function(data){
					if (data == 1){
						$('#register_form')[0].reset();
						alert("Register Successful!");
						window.location.href = "index.php";				
					} else {
						alert(data);
					}
				}
			});
		}
	});
	
	$(document).ready(function(){	
		$('#login_form').on('submit', function(event){
			event.preventDefault();
			if ($('#logUsername').val() == ""){
				alert ("Username is required");
			} else if ($('#logPassword').val() == ""){
				alert ("Password is required");
			} else {
				$.ajax({
					type: "POST",
					url: "includes/login.inc.php",
					data: $('#login_form').serialize(),
					success: function(data){
						if(data == 1){
							$('#login_form')[0].reset();
							window.location.href = "event.php";
						} else {
							alert(data);
						}
					}
				});
			}
		});
	});
});
</script>