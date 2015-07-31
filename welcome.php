<?php 
	session_start();
?>

<!DOCTYPE html>
<html>

<head>
	<title>Welcome to Librarie.com</title>
	<link href="style.css" rel="stylesheet" type="text/css">
</head>

<body>


<div class="blogout2">
	<form action="logout.php">
		<input type="submit" value="Logout"/>
	</form>
</div>

<div style="background-color: light-grey;">
<?php
if (isset($_SESSION['login_user']) && $_SESSION['login_user'] == true) {
    echo "<div class=welcometext>&nbsp;&nbsp;Bine ai venit <b>".$_SESSION['login_user']."</b></div><br><br><div class=ttext>Multumim ca te-ai inregistrat pe librarie.com<br>In scurt timp vei primi un e-email cu datele corespunzatoare contului tau.</div>";
	echo "<br><br><div class=suggestion>Vezi libraria >> <a href=http://lovefairy.com/librariev2/librarie.php>Click Aici</a></div><br><br>";
	
} else {
    echo "Please log in first to see this page.";
}
?>
</div>


</body>
</html>