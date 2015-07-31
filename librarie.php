<?php session_start();?>
<!DOCTYPE html>
<html>
	<head>
		<title>Lista Carti</title>
		<link href="style.css" rel="stylesheet" type="text/css">
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
		<script>

			$(document).ready(function() {
				$("#div1").hide();


				$("button").click(function(){
					$("#div1").slideToggle(100);
				});
			});

		</script>

	</head>

<body>

<?php 

if (isset($_SESSION['login_user']) && $_SESSION['login_user'] == true) {

	include('header_in.php');
	include('search.php');
	include('listacarti.php');


//condition if user is not logged in
} else {

	include('header_out.php');
	include('search.php');
	include('listacarti.php');
}

?>

</body>
</html>