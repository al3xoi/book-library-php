<?php
include('register.php'); // Includes Registration Script


?>
<!DOCTYPE html>
<html>

	<head>
		<title>Library registration form</title>
		<link href="style.css" rel="stylesheet" type="text/css">



		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
		<script>
			$(document).ready(function(){
				$("input.ifields").focus(function(){
					$(this).css("border", "2px solid #0097cf");
				});
				$("input.ifields").blur(function(){
					$(this).css("border", "2px solid #ccc");
				});
			});

			$(document).ready(function() {
				$("#div1").hide();


				$("button").click(function(){
					$("#div1").slideToggle(100);
				});
			});


			function checkPasswordMatch() {
				var password = $("#password1").val();
				var confirmPassword = $("#confpassword1").val();

				if (password != confirmPassword)
					$(".registrationFormAlert").html("Passwords do not match!");
				else
					$(".registrationFormAlert").html("Passwords match.");
			}

			$(document).ready(function () {
				$("#txtConfirmPassword").keyup(checkPasswordMatch);
			});



		</script>
	</head>

<body>

<?php include('header_out.php'); ?>

<div class="registration">
	<div class="regwrap" style="text-align: center;">
		<div class="innerwrap" style="text-align: center; width: 23%; margin: 0 auto;">
		<h2>Register to our online Library</h2>
			<form method="post" action="" id="regForm" name="regForm">
			<table>
			  <tr>
				<td><input class="ifields" placeholder="name *" id="name1" name="name" onblur="validate('name', this.value)" type="text"><br><br></td>
			    <td><div id='name'></div></td>
			  </tr>
			  <tr>
				  <td><input class="ifields" placeholder="email *" id="email1" name="email" onblur="validate('email', this.value)" type="text"><br><br></td>
				  <td><div id='email'></div></td>
			  </tr>
			  <tr>
				<td><input class="ifields" placeholder="username *" id="username1" name="username" onblur="validate('username', this.value)" type="text"><br><br></td>
				<td><div id='username'></div></td>
			  </tr>
			  <tr>
				<td><input class="ifields" placeholder="password *" id="password1" name="password" onblur="validate('password', this.value)" type="password"><br><br></td>
				<td><div id='password'></div></td>
			  </tr>
			  <tr>
				<td><input class="ifields" placeholder="confirm password *" id="confpassword1" name="confpassword" onblur="validate('confpassword', this.value)"  onChange="checkPasswordMatch();" type="password"><br><br></td>
				<td><div id='confpassword'></div><div class="registrationFormAlert"></div></td>
			  </tr>
			</table>

				Fileds marked with * are required!<br><br>
				<input class="buton" name="register" type="submit" value="Submit">&nbsp;&nbsp;
				<input class="buton" name="login" type="button" value="Cancel"  onclick="location.href='/librariev2/login'"><br><br></div>
				<div style="color: red;"><?php echo $error; ?></div>
		  </form>

	</div>
</div>
</div>



</body>
</html>