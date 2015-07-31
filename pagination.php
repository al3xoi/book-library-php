<!DOCTYPE html><html>
<head>
<title>PHP Pagination</title>
</head><body><?php
// Establish Connection to the Database
$servername = "localhost";
$u_name = "dani3la_librarie";
$pass = ".W+ko-;IkbA}";

// Create connection
$connection = mysqli_connect($servername, $u_name, $pass);

// Check connection
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// Select db
$db = mysqli_select_db($connection, "dani3la_testing");

$per_page=2;
if (isset($_GET['page'])) {

$page = $_GET['page'];

}

else {

$page=1;

}

// Page will start from 0 and Multiple by Per Page
$start_from = ($page-1) * $per_page;

//Selecting the data from table but with limit

$result = mysqli_query($connection, "SELECT * FROM carti LIMIT $start_from, $per_page");
//$result = mysqli_query ($connection, $query);

?>
<table align="center" border="2" cellpadding="3">
<tr><th>Titlu</th><th>Autor</th><th>Editura</th></tr>
<?php
while ($row = mysqli_fetch_assoc($result)) {
?>
<tr align="center">
<td><?php echo $row['Titlu']; ?></td>
<td><?php echo $row['Autor']; ?></td>
<td><?php echo $row['Editura']; ?></td>
</tr>
<?php
};
?>
</table>

<div>
<?php

//Now select all from table
$result = mysqli_query($connection, "SELECT * FROM carti");

// Count the total records
$total_records = mysqli_num_rows($result);

//Using ceil function to divide the total records on per page
$total_pages = ceil($total_records / $per_page);

//Going to first page
echo "<center><a href=pagination.php?page=1>".'First Page'."</a> ";

for ($i=1; $i<=$total_pages; $i++) {

echo "<a href=pagination.php?page=$i>".$i."</a> ";
};
// Going to last page
echo "<a href=pagination.php?page=$total_pages>".'Last Page'."</a></center> ";
?>

</div>

</body>
</html>