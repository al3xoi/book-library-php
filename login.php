<?php
session_start(); // Starting Session
$error = ''; // Variable To Store Error Message
if (isset($_POST['submit'])) {
	if (empty($_POST['username']) || empty($_POST['password'])) {
		$error = "Username or Password is invalid";
	} else {

// Define $username and $password
		$username = $_POST['username'];
		$password = $_POST['password'];

// Connecting to database
		$servername = "localhost";
		$u_name = "dani3la_librarie";
		$pass = ".W+ko-;IkbA}";

		$connection = mysqli_connect($servername, $u_name, $pass);

// Check connection
		if (!$connection) {
			die("Connection failed: " . mysqli_connect_error());
		}

// To protect MySQL injection for Security purpose
		$username = stripslashes($username);
		$password = stripslashes($password);
		$username = mysqli_real_escape_string($connection, $username);
		$password = mysqli_real_escape_string($connection, $password);

// Selecting Database
		$db = mysqli_select_db($connection, "dani3la_testing");

// SQL query to fetch information of registerd users and finds user match.
		$query = mysqli_query($connection, "SELECT * FROM login WHERE username='$username' AND password=md5('$password')");
		$rows = mysqli_num_rows($query);

		if ($rows == 1) {
			$_SESSION['login_user'] = $username; // Initializing Session
			header("location: librarie"); // Redirecting To Other Page
		} else {
			$error = "Username or Password is invalid";
		}

		mysqli_close($connection); // Closing Connection
	}
}
?>