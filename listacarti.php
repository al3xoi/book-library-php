<?php

$dir = "./uploads/";

include('connect.php');
// Select db
$db = mysqli_select_db($connection, "dani3la_testing");

// Pagination
$per_page=5;
if (isset($_GET['page'])) {

	$page = $_GET['page'];

} else {

	$page=1;

}

// Page will start from 0 and Multiple by Per Page
$start_from = ($page-1) * $per_page;

// Selecting the data from table but with limit
$query = mysqli_query($connection, "SELECT * FROM carti2 INNER JOIN autori ON carti2.AutorID=autori.AutorID ORDER BY ID DESC LIMIT $start_from, $per_page");


echo "<div class=listacarticontainer><table class=listacarti><tr><th>Coperta</th><th>Titlu</th><th>Autor</th><th>Editura</th><th>ISBN</th><th>Anul Aparitiei</th>";if(isset($_SESSION['login_user'])) { echo "<th>Edit</th>"; }"</tr>";






	while($row = mysqli_fetch_array($query)){   //loop through results

		echo "<tr><td><img src='",$dir.$row['BookPhoto'],"' width='132' height='200' /></td><td>".$row['Titlu']."</td><td>".$row['NumeAutor']."</td><td>".$row['Editura']."</td><td>".$row['Isbn']."</td><td>".$row['AnulAparitiei']."</td>"; if(isset($_SESSION['login_user'])) { echo "<td><form name=editBook action=edit_book.php method=GET>
		<input type=hidden name=bookID value='",$row['ID'],"'><input type=hidden name=edit_book value='",$row['AutorID'],"'><input type=submit name=editBook value=Edit></form>"; }"</td></tr>";

		$bookID = $row["ID"];




	}
	mysqli_free_result($query);
echo "</div></table>"; //Close the table in HTML

// Select all from table
$query = mysqli_query($connection, "SELECT * FROM carti2");

// Count the total records
$total_records = mysqli_num_rows($query);

// Divide the total records on per page
$total_pages = ceil($total_records / $per_page);

// Going to first page
echo "<div class=pnumber><center><a href=librarie.php?page=1>".'Prima Pagina'."</a> ";

for ($i=1; $i<=$total_pages; $i++) {

	echo "<a href=librarie.php?page=$i>".$i."</a>";
}
// Going to last page
echo "<a href=librarie.php?page=$total_pages>".'Ultima Pagina'."</a></center></div> ";

mysqli_close($connection); // Close database connection


?>


