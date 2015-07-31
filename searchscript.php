<?php session_start();?>
<!DOCTYPE html>
<html>
	<head>
		<title>Search Results</title>
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
	include('addbook.php');
	include('search.php');

} else {

	include('header_out.php');
	include('search.php');
}

	$dir = "./uploads/";
	include('connect.php');

// Select db
	$db = mysqli_select_db($connection, "dani3la_testing");


	$searchq = $_GET['search'];


	$searchq = stripslashes($searchq);
	$searchq = mysqli_real_escape_string($connection, $searchq);

	$query = "SELECT * FROM carti2 INNER JOIN autori ON carti2.AutorID=autori.AutorID WHERE Titlu LIKE '%$searchq%' OR NumeAutor LIKE '%$searchq%' OR Editura LIKE '%$searchq%' OR AnulAparitiei LIKE '%$searchq%'";




        /*$terms = explode(" ", $searchq);
        $query = "SELECT * FROM carti WHERE ";

        foreach ($terms as $each) {
			$i++;
			if ($i == 1)
				$query .= "PATINDEX('%$each%',COALESCE(Titlu,'') + '|' + COALESCE(Autor,'') + '|'+ COALESCE(Editura,'')+ '|' + COALESCE(AnulAparitiei,''))>0 ";
			else
				$query .= "AND PATINDEX('%$each%',COALESCE(Titlu,'') + '|' + COALESCE(Autor,'') + '|'+ COALESCE(Editura,'')+ '|' + COALESCE(AnulAparitiei,''))>0";


		}
echo $query; */

	if (($_GET['search']) == null) {
		echo "<div class=seachmessage>Nu ai introdus un termen de cautare</div>";
		echo "<div class=sresult><br><br> <a href=http://lovefairy.com/librariev2/librarie.php>Inapoi la Librarie</a></div>";
	} else {

		$query = mysqli_query($connection, $query) or die("could not search!");
		$count = mysqli_num_rows($query);

		if ($count > 0) {
			echo "<div class=sresult> Rezultatele cautarii dupa termenul <b>" .$searchq. "</b> sunt: </div>";

			echo "<div class=listacarticontainer><table class=listacarti><tr><th>Coperta</th><th>Titlu</th><th>Autor</th><th>Editura</th><th>ISBN</th><th>Anul Aparitiei</th></tr>";

			while ($row = mysqli_fetch_array($query)) {   //Creates a loop to loop through results

				echo "<tr><td><img src='", $dir . $row['BookPhoto'], "' 		width='132' height='200' /></td><td>" . $row['Titlu'] . "</td><td>" . $row['NumeAutor'] . "</td><td>" . $row['Editura'] . "</td><td>" . $row['Isbn'] . "</td><td>" . $row['AnulAparitiei'] . "</td></tr>";
			}
		} else {
			echo "<div class=sresult> Termenul <b>".$searchq."</b> nu a fost gasit in baza de date <br><br> <a href=http://lovefairy.com/librariev2/librarie.php>Inapoi la Librarie</a></div>";

			echo "</div></table>"; //Close the table in HTML

		}
	}


?>
</body>
</html>