<?php

// Create connection
$servername = "localhost";
$u_name = "dani3la_librarie";
$pass = ".W+ko-;IkbA}";

$connection = mysqli_connect($servername, $u_name, $pass);

// Check connection
if (!$connection) {
    die("Connection failed");
}
?>