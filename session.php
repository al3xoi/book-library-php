<?php
// Establishing Connection with Server
$connection = mysqli_connect("localhost", "dani3la_librarie", ".W+ko-;IkbA}");

// Selecting Database
$db = mysqli_select_db("dani3la_testing", $connection);

session_start();// Starting Session

// Storing Session
$user_check=$_SESSION['login_user'];

// SQL Query To Fetch Complete Information Of User
$ses_sql=mysqli_query("SELECT username FROM login WHERE username='$user_check'", $connection);
$row = mysqli_fetch_assoc($ses_sql);
$login_session =$row['username'];

if(!isset($login_session)){
	mysqli_close($connection); // Closing Connection
	header('Location: index.php'); // Redirecting To Home Page
}
?>

