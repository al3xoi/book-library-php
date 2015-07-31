<?php
include('login.php'); // Includes Login Script

	if(isset($_SESSION['login_user'])){
	header("location: librarie");
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Login Form in PHP with Session</title>
		<link href="style.css" rel="stylesheet" type="text/css">

		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
		<script>
			$(document).ready(function(){
				$("input.ifields").focus(function(){
					$(this).css("border", "2px solid #0097cf");
					//$("input[type='text']").addClass("important");
				});

				$("input.ifields").blur(function(){
					$(this).css("border", "2px solid #ccc");
					//$("input[type='text']").addClass("important2");
				});
			});

			$(document).ready(function() {
				$("#div1").hide();


				$("button").click(function(){
					$("#div1").slideToggle(100);
				});
			});




		</script>
	</head>
	
<body>


<?php include('header_out.php'); ?>



<div class="login">
	<div class="loginwrap">
	<h2>Please Log in or Register</h2>
	  <form method="post" action="">

  				<input id="name" name="username" placeholder="username" type="text" class="ifields" class="usrname"><br><br>

				<input id="password" name="password" placeholder="**********" type="password" class="ifields" class="usrpass"><br><br>
				<input class="buton" name="submit" type="submit" value=" Login ">&nbsp;&nbsp;
				<input class="buton" name="register" type="button" value=" Register "  onclick="location.href='/librariev2/register'"><br><br>
				<div style="color: red;"><?php echo $error; ?></div>
		</form>
	</div>
</div>






</body>
</html>